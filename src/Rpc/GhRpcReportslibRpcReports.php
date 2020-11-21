<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcService;
use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;

/**
 * RPC-Dienst RpcReports
 *
 * @package GhRpc
 * @subpackage rpc_reportslib
 * @category PHP-RPC-Dienste
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcReportslibRpcReports extends GhRpcService
{
    /**
     * RPC-Methoden mit Parametern und Ergebnistypen.
     *
     * @var array
     */
    protected static $_rpcMethods = [
        'GetLockData' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => 'GhRpcReportslibRpcLockData',
        ],
        'Unlock' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => '',
        ],
        'Lock' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => '',
        ],
        'AddSchema' => [
            'params' => [
                'ID' => 'int',
                'SchemaRef' => 'int',
            ],
            'return' => '',
        ],
        'Delete' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => '',
        ],
        'Put' => [
            'params' => [
                'Report' => 'GhRpcReportslibRpcReport',
            ],
            'return' => '',
        ],
        'New_' => [
            'params' => [
                'Report' => 'GhRpcReportslibRpcReport',
            ],
            'return' => 'int',
        ],
        'GetList' => [
            'params' => [
                'AdvancedFields' => 'boolean',
            ],
            'return' => 'array:GhRpcReportslibRpcReport',
        ],
        'Get' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => 'GhRpcReportslibRpcReport',
        ],
    ];


    /**
     * Ruft die RPC-Funktion RpcReports.Get auf.
     *
     * @param int $ID
     *
     * @return GhRpcReportslibRpcReport
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function Get($ID)
    {
        return $this->_sendRpcRequest('RpcReports.Get', [$ID], self::$_rpcMethods['Get']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.GetList auf.
     *
     * @param boolean $AdvancedFields
     *
     * @return array
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetList($AdvancedFields)
    {
        return $this->_sendRpcRequest('RpcReports.GetList', [$AdvancedFields], self::$_rpcMethods['GetList']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.New auf.
     *
     * @param GhRpcReportslibRpcReport $Report
     *
     * @return int
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function New_(GhRpcReportslibRpcReport $Report)
    {
        return $this->_sendRpcRequest('RpcReports.New', [$Report], self::$_rpcMethods['New_']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.Put auf.
     *
     * @param GhRpcReportslibRpcReport $Report
     * @return mixed
     * @return mixed
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function Put(GhRpcReportslibRpcReport $Report)
    {
        return $this->_sendRpcRequest('RpcReports.Put', [$Report], self::$_rpcMethods['Put']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.Delete auf.
     *
     * @param int $ID
     * @return mixed
     * @return mixed
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function Delete($ID)
    {
        return $this->_sendRpcRequest('RpcReports.Delete', [$ID], self::$_rpcMethods['Delete']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.AddSchema auf.
     *
     * @param int $ID
     * @param int $SchemaRef
     * @return mixed
     * @return mixed
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function AddSchema($ID, $SchemaRef)
    {
        return $this->_sendRpcRequest('RpcReports.AddSchema', [$ID, $SchemaRef], self::$_rpcMethods['AddSchema']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.Lock auf.
     *
     * @param int $ID
     * @return mixed
     * @return mixed
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function Lock($ID)
    {
        return $this->_sendRpcRequest('RpcReports.Lock', [$ID], self::$_rpcMethods['Lock']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.Unlock auf.
     *
     * @param int $ID
     * @return mixed
     * @return mixed
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function Unlock($ID)
    {
        return $this->_sendRpcRequest('RpcReports.Unlock', [$ID], self::$_rpcMethods['Unlock']);
    }

    /**
     * Ruft die RPC-Funktion RpcReports.GetLockData auf.
     *
     * @param int $ID
     *
     * @return GhRpcReportslibRpcLockData
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetLockData($ID)
    {
        return $this->_sendRpcRequest('RpcReports.GetLockData', [$ID], self::$_rpcMethods['GetLockData']);
    }
}