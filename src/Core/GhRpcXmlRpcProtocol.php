<?php
/*
 * GREYHOUND PHP API
 *
 * Copyright (c) 2011-2016 digital guru GmbH & Co. KG
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of the GREYHOUND PHP API and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including without
 * limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to
 * whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace GreyhoundRpcp\Core;

use GreyhoundRpcp\Exception\GhRpcAuthenticationException;
use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;
use GreyhoundRpcp\Exception\GhRpcFaultException;
use GreyhoundRpcp\Exception\GhRpcNotFoundException;
use GreyhoundRpcp\GhRpcClient;
use XMLReader;

/**
 * XML-RPC Protokoll.
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcXmlRpcProtocol extends GhRpcProtocol
{
    /**
     * Ressource für cURL-Verbindungen.
     *
     * @var resource
     */
    protected $_curl;

    /**
     * Fehlerdaten, falls in einem cURL Callback ein Fehler zurückgemeldet wird.
     *
     * @var string
     */
    public static $curlCallbackFault;

    /**
     * Header-Zeilen eines cURL Callbacks.
     *
     * @var array
     */
    public static $curlCallbackHeaders;

    /**
     * Zusätzliche (vorrangige) HTTP Header für die im cURL Callback ausgegebenen Inhalte.
     *
     * @var array
     */
    public static $curlCallbackOverrideHeaders;

    /**
     * Ruft eine RPC-Funktion auf dem GREYHOUND-Server auf und liefert das Resultat zurück.
     *
     * @param GhRpcClient $client Client
     * @param string $rpcFunction RPC-Funktion (in der Regel die RPC-Klasse und Methode durch einen Punkt getrennt)
     * @param array $params Parameter für die RPC-Funktion
     * @param array $methodType Typ-Information über die Parameter und den Rückgabewert
     * @param array|null $requestData Wird hier ein Array übergeben, so werden die Daten der RPC-Anfrage und der Antwort darin gespeichert. Dies kann beispielsweise zum Protokollieren der Daten verwendet werden.
     * @return mixed Ergebnis des RPC-Aufrufs
     * @throws GhRpcAuthenticationException
     * @throws GhRpcConnectionException falls ein Fehler beim Senden der RPC-Daten auftritt
     * @throws GhRpcException falls ein Fehler beim Verarbeiten der RPC-Daten oder der Antwort auftritt
     * @throws GhRpcFaultException
     * @throws GhRpcNotFoundException
     */
    public function sendRpcRequest(GhRpcClient $client, $rpcFunction, array $params, array $methodType, array &$requestData = null)
    {
        // prepare logging:
        if (is_array($requestData)) {
            $requestData['request'] = null;
            $requestData['response'] = null;
        }

        // prepare xml request:
        $requestDataXml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
        $requestDataXml .= "<methodCall><methodName>" . $rpcFunction . "</methodName><params>";

        $paramTypes = array_values($methodType['params']);
        foreach ($params as $paramKey => $paramValue) {
            $paramType = $paramTypes[$paramKey];
            $requestDataXml .= '<param><value>' . $this->_serializeData($client, $paramValue, $paramType, false) . '</value></param>';
        }

        $requestDataXml .= "</params></methodCall>";

        // log request:
        if (is_array($requestData))
            $requestData['request'] = $requestDataXml;

        // send request:
        $xmlResult = $this->_sendRequestData($client, $requestDataXml);

        // log response:
        if (is_array($requestData))
            $requestData['response'] = $xmlResult;

        // unserialize response:
        return $this->_unserializeData($client, $xmlResult, $methodType['return']);
    }

    /**
     * Lädt Daten vom GREYHOUND-Server herunter.
     *
     * @param GhRpcClient $client Client
     * @param string $function Download-Funktion/-Aktion
     * @param int $id ID des Objekts, von dem heruntergeladen werden soll
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param null|array $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcAuthenticationException
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     * @throws GhRpcFaultException
     * @throws GhRpcNotFoundException
     */
    public function download(GhRpcClient $client, $function, $id, $outputDownload = false, $outputHeaders = null)
    {
        if ($outputDownload) {
            $curlOptions = [
                CURLOPT_WRITEFUNCTION => 'GhRpcXmlRpcProtocol::downloadCurlWriteCallback',
                CURLOPT_HEADERFUNCTION => 'GhRpcXmlRpcProtocol::downloadCurlHeaderCallback',
            ];
            self::$curlCallbackHeaders = [];

            if (is_array($outputHeaders)) {
                foreach ($outputHeaders as $header) {
                    $index = strpos($header, ':');
                    $key = strtolower(trim(substr($header, 0, $index)));
                    self::$curlCallbackHeaders[$key] = trim($header);
                }
            }
        } else
            $curlOptions = null;

        self::$curlCallbackFault = null;

        $xmlResult = $this->_sendRequestData($client, '', null, '/' . $function . $id, true, $curlOptions);

        // Falls die Antwort den Content-Type "text/xml" hatte, wurde ein Fehler zurückgegeben:
        if ($outputDownload)
            $xmlResult = null;
        else if (curl_getinfo($this->_getCurlHandle(), CURLINFO_CONTENT_TYPE) == 'text/xml')
            self::$curlCallbackFault = $xmlResult;

        // Falls ein Fehler zurückgegeben wurde wird eine Exception geworfen:
        if (self::$curlCallbackFault) {
            throw $this->_unserializeData($client, self::$curlCallbackFault, '');
        }

        return $xmlResult;
    }

    /**
     * Lädt Daten in den GREYHOUND-Server hoch.
     *
     * @param GhRpcClient $client Client
     * @param string $function Upload-Funktion/-Aktion
     * @param int $id ID des Objekts, in das die Daten hochgeladen werden sollen
     * @param string $data Hochzuladene Daten
     * @param null $filename Dateiname für die hochzuladenen Daten
     * @throws GhRpcAuthenticationException
     * @throws GhRpcConnectionException falls die Verbindung zum Server fehlschlägt
     * @throws GhRpcNotFoundException
     */
    public function upload(GhRpcClient $client, $function, $id, $data, $filename = null)
    {
        $headers = [
            'Content-Type: application/octet-stream' . (empty($filename)
                ? ''
                : '; name="' . str_replace('"', '', $filename) . '"'),
        ];

        $xmlResult = $this->_sendRequestData($client, $data, $headers, '/' . $function . $id);

        // errors are reported as xml rpc respones, so we need to try to unserialize the result so that an exception is thrown if a fault is encountered:
        if (is_string($xmlResult) && substr($xmlResult, 0, 5) == '<?xml') {
            try {
                $this->_unserializeData($client, $xmlResult, '');
            } catch (GhRpcException $exception) {
                // re-throw fault exceptions as connection exceptions, ignore all other exceptions (e.g. unexpected tags):
                if ($exception instanceof GhRpcFaultException)
                    throw new GhRpcConnectionException($exception->getMessage(), $exception->getCode());
            }
        }
    }

    /**
     * Liefert eine cURL-Ressource zurück, über die HTTP-Requests gesendet werden können.
     * Die Verbindung wird per keep-alive aufrecht erhalten, die Ressource wird also nur einmal
     * erstellt und dann über mehrere Aufrufe wieder verwendet.
     *
     * @return resource cURL-Ressource
     */
    protected function _getCurlHandle()
    {
        if (!$this->_curl) {
            $this->_curl = curl_init();
            curl_setopt($this->_curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        }

        return $this->_curl;
    }

    /**
     * Sendet eine Anfrage an den GREYHOUND-Server und gibt das Ergebnis zurück.
     *
     * @param GhRpcClient $client Client
     * @param string $requestData Daten für die Anfrage
     * @param array|null $headers HTTP-Header (wird in der Regel nur bei Binary-Requests benötigt)
     * @param null $path Host-Pfad (wird in der Regel nur bei Binary-Requests benötigt)
     * @param boolean $get true falls statt einem POST-Request ein GET-Request gesendet werden soll
     * @param null $curlOptions zusätzliche cURL Optionen
     * @return string Ergebnis
     * @throws GhRpcAuthenticationException falls ein Fehler beim Senden der Anfrage auftritt, oder falls das Ergebnis leer ist
     * @throws GhRpcConnectionException falls ein Fehler beim Senden der Anfrage auftritt, oder falls das Ergebnis leer ist
     * @throws GhRpcNotFoundException falls ein Fehler beim Senden der Anfrage auftritt, oder falls das Ergebnis leer ist
     */
    protected function _sendRequestData(GhRpcClient $client, $requestData, array $headers = null, $path = null, $get = false, $curlOptions = null)
    {
        $url = $client->getHost();

        if (!$url)
            throw new GhRpcConnectionException('Empty host/ip (if running as a client extension, then check the public host/ip setting of the server)');

        if ($client->getSsl())
            $url = 'https://' . $url;
        else
            $url = 'http://' . $url;

        $url .= '/xmlrpc';

        if ($path !== null)
            $url .= $path;

        if (!$headers)
            $headers = ['Content-Type: text/xml; charset=' . $client->getCharset()];

        $headers[] = 'Connection: keep-alive';

        $curl = $this->_getCurlHandle();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_PORT, $client->getPort());
        curl_setopt($curl, CURLOPT_USERAGENT, 'Greyhound PHP Client');
        curl_setopt($curl, CURLOPT_POST, !$get);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // id#2369 Basic Auth muss in windows-1252 Codierung übertragen werden, sonst funktionieren Passwörter mit manchen Sonderzeichen nicht:
        curl_setopt($curl, CURLOPT_USERPWD, iconv('UTF-8', 'windows-1252//IGNORE//TRANSLIT', $client->getClientId() . ':' . $client->getPassword()));
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $client->getTimeout());

        if (is_array($curlOptions))
            curl_setopt_array($curl, $curlOptions);

        if (!$get)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $requestData);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode == 404)
            $exception = new GhRpcNotFoundException('Not found' . ($path ? ': ' . $path : ''), $httpCode);
        else if ($httpCode == 401 || $httpCode == 403)
            $exception = new GhRpcAuthenticationException('Server returned an authentication error code ' . $httpCode, $httpCode);
        else if ($httpCode >= 400)
            $exception = new GhRpcConnectionException('Server returned an error code ' . $httpCode, $httpCode);
        else if ($response === false)
            $exception = new GhRpcConnectionException('Rpc request failed with error "' . curl_error($curl) . '"', $httpCode);

        if (isset($exception))
            throw $exception;

        return $response;
    }

    /**
     * Serialisiert RPC-Daten ins XML-RPC Format.
     *
     * @param GhRpcClient $client Client
     * @param mixed $data RPC-Daten
     * @param string $type Datentyp der RPC-Daten
     * @param boolean $allowEmpty true: es dürfen leere Daten weggelassen werden, false: leere Daten müssen als leeres Element (oder Element mit Wert 0) serialisiert werden
     * @return string Serialisiertes XML
     * @throws GhRpcException falls beim Serialisieren der Daten ein Fehler auftritt (z.B. weil ungültige Daten oder falsche Datentypen auftreten)
     *
     */
    protected function _serializeData(GhRpcClient $client, $data, $type, $allowEmpty = true)
    {
        if ($allowEmpty && $data === null)
            return '';

        if ($type == 'int') {
            if ($allowEmpty && !$data)
                return '';

            return '<i4>' . (int)$data . '</i4>';
        } else if ($type == 'double') {
            if ($allowEmpty && !$data)
                return '';

            return '<double>' . (double)$data . '</double>';
        } else if ($type == 'string') {
            if ($allowEmpty && strlen($data) == 0)
                return '';

            $data = str_replace(['&', '<', '>', '"', "'"], ['&amp;', '&lt;', '&gt;', '&quot;', '&apos;'], $data);

            $clientCharset = $client->getCharset();

            if ($clientCharset && strtoupper($clientCharset) != 'UTF-8')
                $data = iconv($clientCharset, 'UTF-8//IGNORE//TRANSLIT', $data);

            return (string)$data;
        } else if ($type == 'binary')
            return '<base64>' . base64_encode($data) . '</base64>';
        else if ($type == 'boolean') {
            if ($allowEmpty && !$data)
                return '';

            return '<boolean>' . (int)$data . '</boolean>';
        } else if ($type == 'GhRpcInt64') {
            if (!($data instanceof GhRpcInt64))
                throw new GhRpcException('Invalid param type "' . $this->_getDataType($data) . '", expected GhRpcInt64');

            $value = $data->toString();

            if ($allowEmpty && (strlen($value) == 0 || $value === '0'))
                return '';

            return '<i8>' . $value . '</i8>';
        } else if ($type == 'GhRpcDateTime') {
            if (!($data instanceof GhRpcDateTime))
                throw new GhRpcException('Invalid param type "' . $this->_getDataType($data) . '", expected GhRpcDateTime');

            if ($allowEmpty && !$data->getTimestamp())
                return '';

            return '<dateTime.iso8601>' . $data->getDateTime(false) . '</dateTime.iso8601>';
        } else if (substr($type, 0, 6) == 'array:') {
            if (!is_array($data))
                throw new GhRpcException('Invalid param type "' . $this->_getDataType($data) . '", expected array');

            $serialized = '';

            foreach ($data as $entry) {
                $entryValue = $this->_serializeData($client, $entry, substr($type, 6), false);

                if (!empty($entryValue))
                    $serialized .= '<value>' . $entryValue . '</value>';
            }

            if (strlen($serialized) == 0) {
                if ($allowEmpty)
                    return '';
                else
                    return '<array/>';
            }

            $serialized = '<array><data>' . $serialized . '</data></array>';

            return $serialized;
        } else if (is_subclass_of('GreyhoundRpcp\Rpc\\' . $type, GhRpcStruct::class)) {
            if (!($data instanceof GhRpcStruct))
                throw new GhRpcException('Invalid param type "' . $this->_getDataType($data) . '", expected ' . $type);

            $serialized = '';

            foreach ($data->getRpcProperties() as $propertyName => $propertyType) {
                $propertyValue = $this->_serializeData($client, $data->$propertyName, $propertyType);

                if ($propertyValue !== null && strlen($propertyValue) > 0)
                    $serialized .= '<member><name>' . $propertyName . '</name><value>' . $propertyValue . '</value></member>';
            }

            if (strlen($serialized) == 0) {
                if ($allowEmpty)
                    return '';
                else
                    return '<struct/>';
            }

            $serialized = '<struct>' . $serialized . '</struct>';

            return $serialized;
        } else
            throw new GhRpcException('Unexpected param of type "' . $this->_getDataType($data) . '"');
    }

    /**
     * Deserialisiert Daten aus einem XML-RPC String.
     *
     * @param GhRpcClient $client Client
     * @param string $xmlResult XML
     * @param string $returnType Datentyp
     * @return mixed Deserialisierte Daten
     * @throws GhRpcException falls ein Fehler beim Deserialisieren auftritt (z.B. ungültige Daten oder unerwartete Datentypen)
     * @throws GhRpcFaultException falls ein Fehler vom Server gemeldet wird
     *
     */
    protected function _unserializeData(GhRpcClient $client, $xmlResult, $returnType)
    {
        if (empty($xmlResult) && empty($returnType))
            return null;

        // id#2035: Ungültige Zeichen im XML durch Fragezeichen ersetzen:
        for ($i = 0, $n = strlen($xmlResult); $i < $n; $i++) {
            $ord = ord($xmlResult[$i]);

            if ($ord < 32 && $ord != 9 && $ord != 10 && $ord != 13)
                $xmlResult[$i] = '?';
        }

        $xml = new XMLReader();

        if (!$xml->xml($xmlResult, 'UTF-8', LIBXML_PARSEHUGE))
            throw new GhRpcException('Could not parse rpc response xml');

        $clientCharset = $client->getCharset();
        $clientCharset = $clientCharset ? strtoupper($clientCharset) : 'UTF-8';

        $result = null;
        $resultStack = [];
        $expectedType = $returnType;

        while ($xml->read()) {

            if (!empty($resultStack) && isset($resultStack[count($resultStack) - 1]['expect']))
                $expectedType = $resultStack[count($resultStack) - 1]['expect'];

            if ($xml->nodeType == XMLReader::ELEMENT) {
                switch ($xml->name) {
                    case 'fault':
                        $newResult = ['type' => 'fault', 'value' => null, 'expect' => GhRpcFault::class];
                        $resultStack[] = $newResult;
                        break;
                    case 'param':
                        $newResult = ['type' => 'param', 'value' => null, 'expect' => $expectedType];
                        $resultStack[] = $newResult;
                        break;
                    case 'i4':
                        $newResult = ['type' => 'int', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'i8':
                        $newResult = ['type' => 'GhRpcInt64', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'double':
                        $newResult = ['type' => 'double', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'boolean':
                        $newResult = ['type' => 'boolean', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'string':
                        $newResult = ['type' => 'string', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'dateTime.iso8601':
                        $newResult = ['type' => 'GhRpcDateTime', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'base64':
                        $newResult = ['type' => 'base64', 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'array':
                        $newResult = ['type' => 'array', 'value' => [], 'expect' => null];

                        if (substr($expectedType, 0, 6) == 'array:')
                            $newResult['expect'] = substr($expectedType, 6);

                        $resultStack[] = $newResult;
                        break;
                    case 'struct':
                        if (!is_subclass_of($expectedType, GhRpcStruct::class)) {
                            if (is_subclass_of('GreyhoundRpcp\Rpc\\' . $expectedType, GhRpcStruct::class)) {
                                $expectedType = 'GreyhoundRpcp\Rpc\\' . $expectedType;
                            } else if (is_subclass_of('GreyhoundRpcp\Core\\' . $expectedType, GhRpcStruct::class)) {
                                $expectedType = 'GreyhoundRpcp\Core\\' . $expectedType;
                            } else {
                                throw new GhRpcException('Unexpected struct in rpc xml response, expected "' . $expectedType . '"');
                            }
                        }

                        $newResult = ['value' => new $expectedType(), 'type' => 'struct', 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'member':
                        $newResult = ['type' => 'member', 'name' => null, 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                    case 'name':
                        $propertyName = $xml->readString();
                        $resultStack[count($resultStack) - 1]['name'] = $propertyName;

                        if ($resultStack[count($resultStack) - 2]['value'] instanceof GhRpcStruct)
                            $resultStack[count($resultStack) - 1]['expect'] = $resultStack[count($resultStack) - 2]['value']->getRpcPropertyType($propertyName);

                        break;
                    case 'value':
                        $newResult = ['type' => 'value', 'name' => null, 'value' => null, 'expect' => null];
                        $resultStack[] = $newResult;
                        break;
                }
            } else if ($xml->nodeType == XMLReader::END_ELEMENT) {
                switch ($xml->name) {
                    case 'fault':
                        $value = array_pop($resultStack);
                        throw new GhRpcFaultException($value['value']->faultString, $value['value']->faultCode);
                    case 'param':
                        $value = array_pop($resultStack);
                        $result = $value['value'];
                        break;
                    case 'i4':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = (int)$value['value'];
                        break;
                    case 'i8':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = new GhRpcInt64($value['value']);
                        break;
                    case 'double':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = (double)$value['value'];
                        break;
                    case 'boolean':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = $value['value'] ? true : false;
                        break;
                    case 'string':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = (string)$value['value'];
                        break;
                    case 'dateTime.iso8601':
                        $value = array_pop($resultStack);
                        $dateTime = new GhRpcDateTime();
                        $dateTime->setDateTime($value['value']);
                        $resultStack[count($resultStack) - 1]['value'] = $dateTime;
                        break;
                    case 'base64':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = base64_decode($value['value']);
                        break;
                    case 'member':
                        $aMember = array_pop($resultStack);
                        $propertyName = $aMember['name'];
                        $resultStack[count($resultStack) - 1]['value']->$propertyName = $aMember['value'];
                        break;
                    case 'array':
                        $value = array_pop($resultStack);
                        $values = $value['value'];

                        // empty array tags might have their value overwritten by an empty string, so reset them as empty arrays:
                        if (!is_array($values))
                            $values = [];

                        $resultStack[count($resultStack) - 1]['value'] = $values;
                        break;
                    case 'struct':
                        $value = array_pop($resultStack);
                        $resultStack[count($resultStack) - 1]['value'] = $value['value'];
                        break;
                    case 'value':
                        $value = array_pop($resultStack);

                        if (is_array($resultStack[count($resultStack) - 1]['value']))
                            $resultStack[count($resultStack) - 1]['value'][] = $value['value'];
                        else
                            $resultStack[count($resultStack) - 1]['value'] = $value['value'];

                        break;
                }
            } else if ($xml->nodeType == XMLReader::TEXT) {
                $value = $xml->readString();

                if ($clientCharset != 'UTF-8')
                    $value = iconv('UTF-8', $clientCharset . '//IGNORE//TRANSLIT', $value);

                $resultStack[count($resultStack) - 1]['value'] = $value;
            }
        }

        $xml->close();

        return $result;
    }

    /**
     * Gibt die Antwort-Daten einer cURL Abfrage direkt aus.
     * Die Methode liefert die Länge der cURL-Daten zurück.
     *
     * @param resource $curl cURL-Handle
     * @param string $content Inhalt
     * @return int
     */
    public static function downloadCurlWriteCallback($curl, $content)
    {
        // Wenn der erste Inhaltsblock ausgegeben werden soll wird zunächst auf einen zurückgemeldeten Fehler geprüft (Typ: text/xml):
        if (self::$curlCallbackFault === null) {
            self::$curlCallbackFault = false;

            if (is_array(self::$curlCallbackHeaders))
                foreach (self::$curlCallbackHeaders as $header) {
                    if (trim($header) == 'Content-Type: text/xml')
                        self::$curlCallbackFault = $content;
                }
        }

        // Nur wenn kein Fehler festgestellt wurde werden Header und Inhalt ausgegeben:
        if (!self::$curlCallbackFault) {
            // Vor dem ersten Inhaltsblock werden die Header durchgeleitet, sofern kein Fehler zurückgemeldet wurde:
            if (is_array(self::$curlCallbackHeaders)) {
                foreach (self::$curlCallbackHeaders as $header) {
                    header($header);
                }

                // Header leeren, damit weitere Inhaltsblöcke nicht erneut Header ausgeben:
                self::$curlCallbackHeaders = null;
            }

            // Inhalt ausgeben:
            echo $content;
        }

        return strlen($content);
    }

    /**
     * Leitet einen Header aus der Antwort einer cURL Abfrage direkt durch.
     *
     * @param resource $curl cURL-Handle
     * @param string $header Header-Zeile
     * @return int
     */
    public static function downloadCurlHeaderCallback($curl, $header)
    {
        if (is_array(self::$curlCallbackHeaders)) {
            $index = strpos($header, ':');

            if ($index !== false) {
                $key = strtolower(trim(substr($header, 0, $index)));

                if (!isset(self::$curlCallbackHeaders[$key]))
                    self::$curlCallbackHeaders[$key] = trim($header);
            }
        }

        return strlen($header);
    }
}