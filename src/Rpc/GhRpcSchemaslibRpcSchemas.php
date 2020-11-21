<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcService;
use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;

/**
 * RPC-Dienst RpcSchemas
 *
 * @package GhRpc
 * @subpackage rpc_schemaslib
 * @category PHP-RPC-Dienste
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcSchemaslibRpcSchemas extends GhRpcService
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
            'return' => 'GhRpcSchemaslibRpcLockData',
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
        'Export' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => 'string',
        ],
        'Import' => [
            'params' => [
                'XmlData' => 'string',
            ],
            'return' => 'int',
        ],
        'Generate' => [
            'params' => [
                'ID' => 'int',
                'ReportRef' => 'int',
                'Options' => 'GhRpcSchemaslibRpcGenerateOptions',
            ],
            'return' => 'GhRpcSchemaslibRpcReportSchema',
        ],
        'SetOrder' => [
            'params' => [
                'ID' => 'int',
                'Order' => 'int',
            ],
            'return' => '',
        ],
        'AddReport' => [
            'params' => [
                'ID' => 'int',
                'ReportRef' => 'int',
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
                'Schema' => 'GhRpcSchemaslibRpcSchema',
            ],
            'return' => '',
        ],
        'New_' => [
            'params' => [
                'Schema' => 'GhRpcSchemaslibRpcSchema',
            ],
            'return' => 'int',
        ],
        'GetList' => [
            'params' => [
                'AdvancedFields' => 'boolean',
            ],
            'return' => 'array:GhRpcSchemaslibRpcSchema',
        ],
        'Get' => [
            'params' => [
                'ID' => 'int',
            ],
            'return' => 'GhRpcSchemaslibRpcSchema',
        ],
    ];


    /**
     * Ruft die RPC-Funktion RpcSchemas.Get auf.
     *
     * @param int $ID
     *
     * @return GhRpcSchemaslibRpcSchema
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function Get($ID)
    {
        return $this->_sendRpcRequest('RpcSchemas.Get', [$ID], self::$_rpcMethods['Get']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.GetList auf.
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
        return $this->_sendRpcRequest('RpcSchemas.GetList', [$AdvancedFields], self::$_rpcMethods['GetList']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.New auf.
     *
     * @param GhRpcSchemaslibRpcSchema $Schema
     *
     * @return int
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function New_(GhRpcSchemaslibRpcSchema $Schema)
    {
        return $this->_sendRpcRequest('RpcSchemas.New', [$Schema], self::$_rpcMethods['New_']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Put auf.
     *
     * @param GhRpcSchemaslibRpcSchema $Schema
     * @return mixed
     * @return mixed
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function Put(GhRpcSchemaslibRpcSchema $Schema)
    {
        return $this->_sendRpcRequest('RpcSchemas.Put', [$Schema], self::$_rpcMethods['Put']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Delete auf.
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
        return $this->_sendRpcRequest('RpcSchemas.Delete', [$ID], self::$_rpcMethods['Delete']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.AddReport auf.
     *
     * @param int $ID
     * @param int $ReportRef
     * @return mixed
     * @return mixed
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function AddReport($ID, $ReportRef)
    {
        return $this->_sendRpcRequest('RpcSchemas.AddReport', [$ID, $ReportRef], self::$_rpcMethods['AddReport']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.SetOrder auf.
     *
     * @param int $ID
     * @param int $Order
     * @return mixed
     * @return mixed
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function SetOrder($ID, $Order)
    {
        return $this->_sendRpcRequest('RpcSchemas.SetOrder', [$ID, $Order], self::$_rpcMethods['SetOrder']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Generate auf.
     *
     * @param int $ID
     * @param int $ReportRef
     * @param GhRpcSchemaslibRpcGenerateOptions $Options
     *
     * @return GhRpcSchemaslibRpcReportSchema
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function Generate($ID, $ReportRef, GhRpcSchemaslibRpcGenerateOptions $Options)
    {
        return $this->_sendRpcRequest('RpcSchemas.Generate', [$ID, $ReportRef, $Options], self::$_rpcMethods['Generate']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Import auf.
     *
     * @param string $XmlData
     *
     * @return int
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function Import($XmlData)
    {
        return $this->_sendRpcRequest('RpcSchemas.Import', [$XmlData], self::$_rpcMethods['Import']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Export auf.
     *
     * @param int $ID
     *
     * @return string
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function Export($ID)
    {
        return $this->_sendRpcRequest('RpcSchemas.Export', [$ID], self::$_rpcMethods['Export']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Lock auf.
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
        return $this->_sendRpcRequest('RpcSchemas.Lock', [$ID], self::$_rpcMethods['Lock']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.Unlock auf.
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
        return $this->_sendRpcRequest('RpcSchemas.Unlock', [$ID], self::$_rpcMethods['Unlock']);
    }

    /**
     * Ruft die RPC-Funktion RpcSchemas.GetLockData auf.
     *
     * @param int $ID
     *
     * @return GhRpcSchemaslibRpcLockData
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetLockData($ID)
    {
        return $this->_sendRpcRequest('RpcSchemas.GetLockData', [$ID], self::$_rpcMethods['GetLockData']);
    }
}