<?php
/**
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

namespace GreyhoundRpcp;

use Exception;
use GreyhoundRpcp\Core\GhRpcProtocol;
use GreyhoundRpcp\Core\GhRpcXmlRpcProtocol;
use GreyhoundRpcp\Exception\GhRpcAuthenticationException;
use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;
use GreyhoundRpcp\Exception\GhRpcFaultException;
use GreyhoundRpcp\Exception\GhRpcNotFoundException;
use GreyhoundRpcp\Rpc\RpcInfoLib;

class GhRpcClient
{
    /**
     * GREYHOUND Server Hostname
     *
     * @var string
     */
    protected $_host;

    /**
     * GREYHOUND Server Port
     *
     * @var int
     */
    protected $_port;

    /**
     * Legt fest, ob eine verschlüsselte Verbindung (SSL) verwendet werden soll.
     *
     * @var boolean
     */
    protected $_ssl;

    /**
     * Benutzername für die Authentifikation beim GREYHOUND Server
     *
     * @var string
     */
    protected $_username;

    /**
     * Passwort für die Authentifikation beim GREYHOUND Server
     *
     * @var string
     */
    protected $_password;

    /**
     * Eindeutige Client-ID
     *
     * @var string
     */
    protected $_uniqueClientId;

    /**
     * Name des Cookies, in dem die eindeutige Client-ID gespeichert wird.
     *
     * @var string
     */
    protected $_uniqueClientIdCookie = 'ghclient';

    /**
     * Zeichencodierung der PHP Applikation (Vorgabewert: UTF-8).
     *
     * @var string
     */
    protected $_charset = 'UTF-8';

    /**
     * Timeout für die Serververbindung
     *
     * @var int
     */
    protected $_connectionTimeout = 3;

    /**
     * Dateipfad der RPC Request Protokolldatei.
     * Falls dieser Wert auf true gesetzt wird werden die RPC Anfragen nur im
     * Speicher protokolliert und nicht automatisch in eine Datei geschrieben.
     *
     * @var string|boolean
     */
    protected $_rpcRequestLog;

    /**
     * Dateipfad der RPC Response Protokolldatei.
     * Falls dieser Wert auf true gesetzt wird werden die RPC Antworten nur im
     * Speicher protokolliert und nicht automatisch in eine Datei geschrieben.
     *
     * @var string|boolean
     */
    protected $_rpcResponseLog;

    /**
     * RPC Request und Response Protokolldaten.
     *
     * @var array
     */
    protected $_rpcData;

    /**
     * Transport Protokoll für die Serialisierung der Serververbindung.
     *
     * @var GhRpcProtocol
     */
    protected $_protocol;

    /**
     * Konstruktor.
     *
     * @param string $host GREYHOUND Server Hostname oder IP-Adresse
     * @param int $port GREYHOUND Server Port
     * @param boolean $ssl true: SSL Verbindung, false: kein SSL
     * @param string|null $username Benutzername für die Verbindung zum GREYHOUND Server
     * @param string|null $password Passwort für die Verbindung zum GREYHOUND Server
     * @param GhRpcProtocol|null $protocol Transportprotokoll (Vorgabewert: XMLRPC)
     */
    public function __construct($host = '127.0.0.1', $port = 80, $ssl = false, string $username = null, string $password = null, GhRpcProtocol $protocol = null)
    {
        $this->setHost($host);
        $this->setPort($port);
        $this->setSsl($ssl);

        if ($username !== null)
            $this->setUsername($username);

        if ($password !== null)
            $this->setPassword($password);

        if ($protocol != null)
            $this->setProtocol($protocol);
    }

    /**
     * Setzt den Hostnamen oder die IP-Adresse des GREYHOUND Servers.
     *
     * @param string $host GREYHOUND Server Hostname oder IP-Adresse
     */
    public function setHost($host)
    {
        $this->_host = $host;
    }

    /**
     * Liefert den Hostnamen oder die IP-Adresse des GREYHOUND Servers.
     *
     * @return string
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * Setzt den Port für die Verbindung zum GREYHOUND Server.
     *
     * @param int $port GREYHOUND Server Port
     */
    public function setPort($port)
    {
        $this->_port = $port;
    }

    /**
     * Liefert den Port für die Verbindung zum GREYHOUND Server.
     *
     * @return int
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * Legt fest, ob die Verbindung zum GREYHOUND Server verschlüsselt wird (SSL)
     * oder nicht.
     *
     * @param boolean $ssl true: SSL Verbindung, false: kein SSL
     */
    public function setSsl($ssl)
    {
        $this->_ssl = $ssl;
    }

    /**
     * Liefert die Einstellung, ob die Verbindung zum GREYHOUND Server
     * verschlüsselt wird (SSL).
     *
     * @return boolean
     */
    public function getSsl()
    {
        return $this->_ssl;
    }

    /**
     * Setzt den Benutzernamen für die Verbindung zum GREYHOUND Server.
     * Dies muss ein gültiger Benutzername eines GREYHOUND Benutzers sein.
     *
     * @param string $username Benutzername für die Verbindung zum GREYHOUND Server
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * Liefert den Benutzernamen für die Verbindung zum GREYHOUND Server.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * Liefert die Client-ID für die Verbindung zum GREYHOUND Server.
     * Die Client-ID besteht aus einer eindeutigen ID und dem Benutzernamen,
     * getrennt durch einen Bindestrich.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->getUniqueClientId() . '-' . $this->getUsername();
    }

    /**
     * Setzt die eindeutige ID für diese Client-Instanz.
     * Die eindeutige ID darf sich während der Browser-Session nicht ändern.
     *
     * @param string $uniqueClientId Eindeutige ID für diese Verbindung
     */
    public function setUniqueClientId($uniqueClientId)
    {
        // Die eindeutige Client ID muss 32 Zeichen lang sein:
        if (strlen($uniqueClientId) != 32)
            $uniqueClientId = md5($uniqueClientId);

        $this->_uniqueClientId = $uniqueClientId;
    }

    /**
     * Liefert die eindeutige ID dieser Client-Instanz.
     *
     * @return string
     */
    public function getUniqueClientId()
    {
        if (!$this->_uniqueClientId && $this->_uniqueClientIdCookie) {
            if (isset($_COOKIE[$this->_uniqueClientIdCookie]) && !empty($_COOKIE[$this->_uniqueClientIdCookie]))
                $this->_uniqueClientId = $_COOKIE[$this->_uniqueClientIdCookie];
            else {
                $this->_uniqueClientId = md5((string)time() . (string)rand(1, 0xffffffff));
                setcookie($this->_uniqueClientIdCookie, $this->_uniqueClientId, 0);
            }
        }

        return $this->_uniqueClientId;
    }

    /**
     * Setzt den Namen für den Cookie in dem die eindeutige ID dieser
     * Client-Instanz gespeichert wird.
     *
     * Die ID wird nur in einem Cookie gespeichert, wenn nicht vor dem ersten
     * RPC Funktionsaufruf bereits eine eindeutige ID festgelegt wurde.
     *
     * @param string $cookie Name des Cookies
     */
    public function setUniqueClientIdCookieName($cookie)
    {
        $this->_uniqueClientIdCookie = $cookie;
    }

    /**
     * Liefert den Namen des Cookie, in dem die eindeutige ID dieser
     * Client-Instanz gespeichert wird.
     *
     * @return string
     */
    public function getUniqueClientIdCookieName()
    {
        return $this->_uniqueClientIdCookie;
    }

    /**
     * Setzt das Passwort für die Verbindung zum GREYHOUND Server.
     *
     * @param string $password Passwort für die Verbindung zum GREYHOUND Server
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * Liefert das Passwort für die Verbindung zum GREYHOUND Server.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Setzt das Protokoll, das für die Verbindung zum GREYHOUND Server verwendet
     * werden soll.
     * Falls kein Protokoll festgelegt wurde wird als Vorgabe das XMLRPC
     * Protokoll verwendet.
     *
     * @param GhRpcProtocol $protocol Transport-Protokoll für RPC
     */
    public function setProtocol($protocol)
    {
        $this->_protocol = $protocol;
    }

    /**
     * Liefert das Protokoll für die Verbindung zum GREYHOUND Server.
     *
     * @return GhRpcProtocol
     */
    public function getProtocol()
    {
        return $this->_protocol;
    }

    /**
     * Setzt die Zeichencodierung, die die Client-Applikation verwendet.
     * Daten, die zum Server gesendet werden, werden von dieser Zeichencodierung
     * in die Codierung des Transportprotokolls umgewandelt, und Daten, die vom
     * Server empfangen werden, werden entsprechend in die Zeichencodierung der
     * Client-Applikation umgewandelt.
     *
     * @param string $charset Zeichencodierung (z.B. UTF-8 oder ISO-8859-15)
     * @see getCharset()
     *
     */
    public function setCharset($charset)
    {
        $this->_charset = $charset;
    }

    /**
     * Liefert die Zeichencodierung, die für die Client-Applikation festgelegt
     * wurde.
     *
     * @return string
     * @see setCharset()
     *
     */
    public function getCharset()
    {
        return $this->_charset;
    }

    /**
     * Setzt den Timeout für die Verbindung zum GREYHOUND Server.
     * Diese Zeit wird in Sekunden angegeben. Anfragen an den Server werden
     * nach Ablauf dieser Zeit abgebrochen wenn bis dahin keine Antwort erfolgt
     * ist.
     *
     * @param int $seconds Timeout in Sekunden (0 bedeutet: kein Timeout)
     * @see getTimeout()
     *
     */
    public function setTimeout($seconds)
    {
        $this->_connectionTimeout = $seconds;
    }

    /**
     * Liefert den Timeout für die Verbindung zum GREYHOUND Server.
     *
     * @return int
     * @see setTimeout()
     *
     */
    public function getTimeout()
    {
        return $this->_connectionTimeout;
    }

    /**
     * Prüft, ob eine bestimmte Kombination aus Benutzername und Passwort gültig
     * ist.
     *
     * @param string $username Benutzername
     * @param string $password Passwort
     * @return boolean
     */
    public function checkLogin($username, $password)
    {
        if (!$username && $username !== '0') {
            return false;
        }
        if (!$password && $password !== '0') {
            return false;
        }

        $oldUsername = $this->_username;
        $oldPassword = $this->_password;

        $success = false;
        try {
            $this->_username = $username;
            $this->_password = $password;
            RpcInfoLib::newRpcInfo($this)->GetServerStatus();
            $success = true;
        } catch (Exception $e) {
            var_dump($e);
        }

        $this->_username = $oldUsername;
        $this->_password = $oldPassword;

        return $success;
    }

    /**
     * Legt fest, ob die Anfragen, die zum GREYHOUND Server gesendet werden,
     * protokolliert werden sollen.
     * Wird ein Dateipfad angegeben, so werden die Anfragen an diese Datei
     * angehängt (mit Datum und Uhrzeit).
     * Wird true angegeben, so werden die Anfragen im Speicher protokolliert und
     * können anschließend mit getRpcRequestData() abgerufen werden.
     * Wird false angegeben, so wird die Protokollierung von Anfragen
     * deaktiviert.
     *
     * @param string|boolean $requestFile Dateipfad bzw. Protokolleinstellung
     * @see sendRpcRequest()
     *
     * @see getRpcRequestData()
     */
    public function setLogRpcRequestData($requestFile)
    {
        $this->_rpcRequestLog = $requestFile;
    }

    /**
     * Liefert die Daten der letzten RPC Anfrage, sofern die Protokollierung im
     * Speicher aktiviert war.
     *
     * @return string
     * @see setLogRpcRequestData()
     *
     */
    public function getRpcRequestData()
    {
        if (isset($this->_rpcData['request'])) {
            return $this->_rpcData['request'];
        }

        return null;
    }

    /**
     * Legt fest, ob die Antworten des GREYHOUND Servers protokolliert werden
     * sollen.
     * Wird ein Dateipfad angegeben, so werden die Antworten an diese Datei
     * angehängt (mit Datum und Uhrzeit).
     * Wird true angegeben, so werden die Antworten im Speicher protokolliert und
     * können anschließend mit getRpcResponseData() abgerufen werden.
     * Wird false angegeben, so wird die Protokollierung von Antworten
     * deaktiviert.
     *
     * @param string|boolean $responseFile Dateipfad bzw. Protokolleinstellung
     * @see sendRpcRequest()
     *
     * @see getRpcResponseData()
     */
    public function setLogRpcResponseData($responseFile)
    {
        $this->_rpcResponseLog = $responseFile;
    }

    /**
     * Liefert die Daten der letzten RPC Antwort, sofern die Protokollierung im
     * Speicher aktiviert war.
     *
     * @return string
     * @see setLogRpcResponseData()
     *
     */
    public function getRpcResponseData()
    {
        if (isset($this->_rpcData['response'])) {
            return $this->_rpcData['response'];
        }

        return null;
    }

    /**
     * Sendet eine RPC Anfrage zum GREYHOUND Server.
     *
     * @param string $rpcFunction Name der RPC Funktion (normalerweise
     *   zusammengesetzt aus dem Namen der Unit und der Funktion, durch einen
     *   Punkt getrennt, z.B. 'RpcItems.AddRemark')
     * @param array $params Parameter der RPC Funktion
     * @param array $methodType Typen der RPC Parameter und des Rückgabewerts
     * @return mixed
     * @throws GhRpcConnectionException falls ein Fehler beim Senden der RPC Anfrage auftrat
     * @throws GhRpcException falls ein Fehler beim Serialisieren bzw. Deserialisieren der RPC Daten auftrat
     *
     */
    public function sendRpcRequest($rpcFunction, array $params, array $methodType)
    {
        // Protokollierung vorbereiten:
        if ($this->_rpcRequestLog || $this->_rpcResponseLog)
            $this->_rpcData = [];
        else
            $this->_rpcData = null;

        // Request senden:
        $mResult = $this->_getCreateProtocol()->sendRpcRequest($this, $rpcFunction, $params, $methodType, $this->_rpcData);

        // Protokollierung:
        if (is_array($this->_rpcData)) {
            $blKeepData = false;

            if ($this->_rpcRequestLog === true)
                $blKeepData = true;
            else if ($this->_rpcRequestLog)
                file_put_contents($this->_rpcRequestLog, '[' . date('Y-m-d H:i:s') . '] ' . $rpcFunction . " request:\n" . $this->_rpcData['request'] . "\n\n",
                    FILE_APPEND);

            if (!$blKeepData)
                unset($this->_rpcData['request']); // Speicher freigeben

            $blKeepData = false;

            if ($this->_rpcResponseLog === true)
                $blKeepData = true;
            else if ($this->_rpcResponseLog)
                file_put_contents($this->_rpcResponseLog,
                    '[' . date('Y-m-d H:i:s') . '] ' . $rpcFunction . " response:\n" . $this->_rpcData['response'] . "\n\n", FILE_APPEND);

            if (!$blKeepData)
                unset($this->_rpcData['response']); // Speicher freigeben
        }

        return $mResult;
    }

    /**
     * Lädt den Anhang eines Elements herunter.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $attachmentId ID des Anhangs
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadItemAttachment($attachmentId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('ItemsAttachment', $attachmentId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt den Inhalt der Original-E-Mail eines Elements herunter.
     * Dies ist die ursprüngliche .eml Datei eines E-Mail-Elements, sofern diese
     * nicht bereits serverseitig durch eine Regel entfernt wurde.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadItemOriginalEmail($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('ItemsOrginalEml', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt den E-Mail-Inhalt eines Elements herunter.
     * Dies liefert den .eml Inhalt eines Elements. Diese Methode kann nicht nur
     * auf E-Mails angewendet werden, sondern auch auf andere Element-Typen (für
     * einen Kontakt wird beispielsweise eine .eml mit einem VCard Anhang
     * geliefert).
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadItemCurrentEmail($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('ItemsCurrentEml', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt VCard-Daten eines Elements herunter.
     * Dies ist nicht für alle Element-Typen verfügbar.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadItemVCard($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('ItemsVCard', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt iCal-Daten eines Elements herunter.
     * Dies ist nicht für alle Element-Typen verfügbar.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadItemICal($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('ItemsICal', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt Daten für den Datenaustausch herunter.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadDataExchange($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('DataExchange', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt einen CSV-Report einer Eingangsprüfung herunter.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadCheckingCsv($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('CheckingCsv', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt DIF-Daten einer Eingangsprüfung herunter.
     *
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param int $itemId ID des Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    public function downloadCheckingDif($itemId, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_download('CheckingDif', $itemId, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt einen neuen Anhang zu einem Element hoch.
     *
     * @param int $itemId ID des Elements zu dem der neue Anhang hochgeladen
     *   werden soll
     * @param string $data Binärdaten des Anhangs
     * @param string|null $filename Dateiname des Anhangs
     * @throws GhRpcConnectionException
     * @see uploadItemReplaceAttachment()
     *
     */
    public function uploadItemNewAttachment($itemId, $data, $filename = null)
    {
        $this->_upload('ItemNewAttachment', $itemId, $data, $filename);
    }

    /**
     * Ersetzt einen Anhang eines Elements.
     * Es wird der Anhang mit demselben Namen wie der neue Anhang ersetzt.
     *
     * @param int $itemId ID des Elements, zu dem der Anhang hochgeladen
     *   werden soll
     * @param string $data Binärdaten des Anhangs
     * @param string|null $filename Dateiname des Anhangs
     * @throws GhRpcConnectionException
     * @see uploadItemNewAttachment()
     *
     */
    public function uploadItemReplaceAttachment($itemId, $data, $filename = null)
    {
        $this->_upload('ItemReplaceAttachment', $itemId, $data, $filename);
    }

    /**
     * Lädt Daten für den Datenaustausch hoch.
     *
     * @param int $itemId ID des Elements
     * @param string $data Binärdaten
     * @param string|null $filename Dateiname
     * @throws GhRpcConnectionException
     */
    public function uploadDataExchange($itemId, $data, $filename = null)
    {
        $this->_upload('DataExchange', $itemId, $data, $filename);
    }

    /**
     * Liefert das Transportprotokoll-Objekt und instanziiert das
     * Standardprotokoll falls kein Protokoll festgelegt wurde.
     *
     * @return GhRpcProtocol protocol object
     */
    protected function _getCreateProtocol()
    {
        $oProtocol = $this->getProtocol();
        if (!$oProtocol) {
            $oProtocol = new GhRpcXmlRpcProtocol();
            $this->setProtocol($oProtocol);
        }

        return $oProtocol;
    }

    /**
     * Lädt Daten vom GREYHOUND Server herunter.
     * Die Daten können optional direkt ausgegeben werden. Dadurch muss nicht die
     * gesamte Datei erst in PHP heruntergeladen werden, sondern kann direkt an
     * den Browser durchgereicht werden. Wird diese Option genutzt, so werden die
     * Daten direkt ausgegeben und der Rückgabewert ist true. Zusätzlich kann
     * der Dateiname und die HTTP Header angegeben werden. Wird dies nicht getan,
     * so werden diese aus dem Element auf dem Server ermittelt.
     * Wird die Option für die direkte Ausgabe des Downloads nicht genutzt, so
     * werden die heruntergeladenen Daten als Rückgabewert zurück geliefert.
     *
     * @param string $function Funktion/Aktion
     * @param int $id ID des herunterzuladenen Elements
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     * @throws GhRpcAuthenticationException
     * @throws GhRpcFaultException
     * @throws GhRpcNotFoundException
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    protected function _download($function, $id, $outputDownload = false, $outputHeaders = null)
    {
        return $this->_getCreateProtocol()->download($this, $function, $id, $outputDownload, $outputHeaders);
    }

    /**
     * Lädt Daten zum GREYHOUND Server hoch.
     *
     * @param string $function Funktion/Aktion
     * @param int $id ID des Elements zu dem hochgeladen werden soll
     * @param string $data Binärdaten
     * @param string|null $filename Dateiname
     * @throws GhRpcConnectionException falls der Upload fehlschlug
     *
     */
    protected function _upload($function, $id, $data, $filename = null)
    {
        $this->_getCreateProtocol()->upload($this, $function, $id, $data, $filename);
    }
}