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
 * Basisklasse für RPC-Dienste.
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcService
{
    /**
     * Client Instanz.
     *
     * @var GhRpcClient
     */
    protected $_client;


    /**
     * Konstruktor.
     *
     * @param GhRpcClient $client Client
     */
    public function __construct(GhRpcClient $client)
    {
        $this->_client = $client;
    }

    /**
     * Ruft eine RPC-Funktion auf dem GREYHOUND-Server auf und liefert das
     * Resultat zurück.
     *
     * @param string $rpcFunction RPC-Funktion (in der Regel die RPC-Klasse und Methode, durch einen Punkt getrennt, z.B. 'RpcItems.AddRemark')
     * @param array $params Parameter für die RPC-Funktion
     * @param array $methodType Datentypen (Parameter-Typen und Rückgabetyp)
     * @return mixed Ergebnis des RPC-Aufrufs
     * @throws GhRpcConnectionException
     * @throws GhRpcException
     */
    protected function _sendRpcRequest($rpcFunction, array $params, array $methodType)
    {
        return $this->_client->sendRpcRequest($rpcFunction, $params, $methodType);
    }
}