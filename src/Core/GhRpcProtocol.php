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

use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;
use GreyhoundRpcp\GhRpcClient;

/**
 * Protokollklasse für die Kommunikation mit dem GREYHOUND-Server.
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
abstract class GhRpcProtocol
{
    /**
     * Diese Methode muss so überladen werden, dass sie eine RPC-Funktion auf dem GREYHOUND-Server aufruft und das Ergebnis zurückliefert.
     *
     * @param GhRpcClient $client Client
     * @param string $rpcFunction RPC-Funktion (in der Regel die RPC-Klasse und Methode durch einen Punkt getrennt)
     * @param array $params Parameter für die RPC-Funktion
     * @param array $methodType Typ-Information über die Parameter und den Rückgabewert
     * @param array|null $requestData Wird hier ein Array übergeben, so werden die Daten der RPC-Anfrage und der Antwort darin gespeichert. Dies kann beispielsweise zum Protokollieren der Daten verwendet werden.
     * @return mixed Ergebnis des RPC-Aufrufs
     * @throws GhRpcConnectionException falls ein Fehler beim Senden der RPC-Daten auftritt
     * @throws GhRpcException falls ein Fehler beim Verarbeiten der RPC-Daten oder der Antwort auftritt
     *
     */
    abstract public function sendRpcRequest(GhRpcClient $client, $rpcFunction, array $params, array $methodType, array &$requestData = null);

    /**
     * Diese Methode muss so überladen werden, dass sie Daten vom GREYHOUND-Server herunterlädt.
     *
     * @param GhRpcClient $client Client
     * @param string $function Download-Funktion/-Aktion
     * @param int $id ID des Objekts, von dem heruntergeladen werden soll
     * @param boolean $outputDownload true: heruntergeladene Daten direkt ausgeben
     * @param array|null $outputHeaders HTTP Header für die direkt ausgegebenen Daten
     * @return string
     */
    abstract public function download(GhRpcClient $client, $function, $id, $outputDownload = false, $outputHeaders = null);

    /**
     * Diese Methode muss so überladen werden, dass sie Daten zum GREYHOUND-Server hochlädt.
     *
     * @param GhRpcClient $client Client
     * @param string $function Upload-Funktion/-Aktion
     * @param int $id ID des Objekts, in das die Daten hochgeladen werden sollen
     * @param string $data Hochzuladene Daten
     * @param string|null $filename Dateiname für die hochzuladenen Daten
     */
    abstract public function upload(GhRpcClient $client, $function, $id, $data, $filename = null);

    /**
     * Liefert den Datentyp oder die Klasse einer Variablen.
     *
     * @param mixed $data Variable
     * @return string Datentyp oder Klasse (falls die Variable ein Objekt ist)
     */
    protected function _getDataType($data)
    {
        if (is_object($data)) {
            return get_class($data);
        } else {
            return gettype($data);
        }
    }

    /**
     * Prüft, ob ein String für textbasierte Kommunikation Base64-codiert werden muss.
     *
     * @param string $data Der zu prüfende String
     * @return boolean true falls der String Base64 codiert werden muss, false falls der String nicht codiert werden muss
     */
    protected function _requiresBase64Encoding($data)
    {
        $data = (string)$data;
        for ($i = 0; $i < strlen($data); $i++) {
            $char = ord($data[$i]);
            if (($char <= 8) || $char == 11 || $char == 12 || ($char >= 14 && $char <= 31)) {
                return true;
            }
        }

        return false;
    }
}