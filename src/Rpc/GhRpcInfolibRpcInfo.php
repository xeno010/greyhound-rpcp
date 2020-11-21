<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcDateTime;
use GreyhoundRpcp\Core\GhRpcService;
use GreyhoundRpcp\Exception\GhRpcConnectionException;
use GreyhoundRpcp\Exception\GhRpcException;

/**
 * RPC-Dienst RpcInfo
 *
 * @package GhRpc
 * @subpackage rpc_infolib
 * @category PHP-RPC-Dienste
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcInfolibRpcInfo extends GhRpcService
{
    /**
     * RPC-Methoden mit Parametern und Ergebnistypen.
     *
     * @var array
     */
    protected static $_rpcMethods = [
        'TrainSpamFilter' => [
            'params' => [
            ],
            'return' => '',
        ],
        'GetAddOnList' => [
            'params' => [
            ],
            'return' => 'array:GhRpcInfolibRpcAddOn',
        ],
        'GetAddOn' => [
            'params' => [
                'Name' => 'string',
            ],
            'return' => 'binary',
        ],
        'UpdateAddOns' => [
            'params' => [
            ],
            'return' => '',
        ],
        'GetServerSettings' => [
            'params' => [
            ],
            'return' => 'GhRpcInfolibRpcServerSettings',
        ],
        'GetQueueStatus' => [
            'params' => [
            ],
            'return' => 'GhRpcInfolibRpcQueueStatus',
        ],
        'GetServerStatus' => [
            'params' => [
            ],
            'return' => 'GhRpcInfolibRpcServerStatus',
        ],
        'GetItemCount' => [
            'params' => [
                'TotalCountUniqueID' => 'string',
                'ReadCountUniqueID' => 'string',
                'MinModified' => 'GhRpcDateTime',
            ],
            'return' => 'GhRpcInfolibRpcItemCount',
        ],
        'SendAndReceiveNow' => [
            'params' => [
            ],
            'return' => '',
        ],
        'ReindexAllItems' => [
            'params' => [
            ],
            'return' => '',
        ],
        'InvalidateAllCaches' => [
            'params' => [
            ],
            'return' => '',
        ],
        'CountCul' => [
            'params' => [
            ],
            'return' => '',
        ],
        'GetRightList' => [
            'params' => [
            ],
            'return' => 'array:GhRpcInfolibRpcRight',
        ],
        'GetVariables' => [
            'params' => [
            ],
            'return' => 'array:string',
        ],
        'GetServerInfo' => [
            'params' => [
                'AdvancedFields' => 'boolean',
            ],
            'return' => 'GhRpcInfolibRpcServerInfo',
        ],
    ];


    /**
     * Ruft die RPC-Funktion RpcInfo.GetServerInfo auf.
     *
     * @param boolean $AdvancedFields
     *
     * @return GhRpcInfolibRpcServerInfo
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetServerInfo($AdvancedFields)
    {
        return $this->_sendRpcRequest('RpcInfo.GetServerInfo', [$AdvancedFields], self::$_rpcMethods['GetServerInfo']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetVariables auf.
     *
     * @return array
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetVariables()
    {
        return $this->_sendRpcRequest('RpcInfo.GetVariables', [], self::$_rpcMethods['GetVariables']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetRightList auf.
     *
     * @return array
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetRightList()
    {
        return $this->_sendRpcRequest('RpcInfo.GetRightList', [], self::$_rpcMethods['GetRightList']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.CountCul auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function CountCul()
    {
        return $this->_sendRpcRequest('RpcInfo.CountCul', [], self::$_rpcMethods['CountCul']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.InvalidateAllCaches auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function InvalidateAllCaches()
    {
        return $this->_sendRpcRequest('RpcInfo.InvalidateAllCaches', [], self::$_rpcMethods['InvalidateAllCaches']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.ReindexAllItems auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function ReindexAllItems()
    {
        return $this->_sendRpcRequest('RpcInfo.ReindexAllItems', [], self::$_rpcMethods['ReindexAllItems']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.SendAndReceiveNow auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function SendAndReceiveNow()
    {
        return $this->_sendRpcRequest('RpcInfo.SendAndReceiveNow', [], self::$_rpcMethods['SendAndReceiveNow']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetItemCount auf.
     *
     * @param string $TotalCountUniqueID
     * @param string $ReadCountUniqueID
     * @param GhRpcDateTime $MinModified
     *
     * @return GhRpcInfolibRpcItemCount
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetItemCount($TotalCountUniqueID, $ReadCountUniqueID, GhRpcDateTime $MinModified)
    {
        return $this->_sendRpcRequest('RpcInfo.GetItemCount', [$TotalCountUniqueID, $ReadCountUniqueID, $MinModified], self::$_rpcMethods['GetItemCount']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetServerStatus auf.
     *
     * @return GhRpcInfolibRpcServerStatus
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetServerStatus()
    {
        return $this->_sendRpcRequest('RpcInfo.GetServerStatus', [], self::$_rpcMethods['GetServerStatus']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetQueueStatus auf.
     *
     * @return GhRpcInfolibRpcQueueStatus
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetQueueStatus()
    {
        return $this->_sendRpcRequest('RpcInfo.GetQueueStatus', [], self::$_rpcMethods['GetQueueStatus']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetServerSettings auf.
     *
     * @return GhRpcInfolibRpcServerSettings
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetServerSettings()
    {
        return $this->_sendRpcRequest('RpcInfo.GetServerSettings', [], self::$_rpcMethods['GetServerSettings']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.UpdateAddOns auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function UpdateAddOns()
    {
        return $this->_sendRpcRequest('RpcInfo.UpdateAddOns', [], self::$_rpcMethods['UpdateAddOns']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetAddOn auf.
     *
     * @param string $Name
     *
     * @return string
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     */
    public function GetAddOn($Name)
    {
        return $this->_sendRpcRequest('RpcInfo.GetAddOn', [$Name], self::$_rpcMethods['GetAddOn']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.GetAddOnList auf.
     *
     * @return array
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     */
    public function GetAddOnList()
    {
        return $this->_sendRpcRequest('RpcInfo.GetAddOnList', [], self::$_rpcMethods['GetAddOnList']);
    }

    /**
     * Ruft die RPC-Funktion RpcInfo.TrainSpamFilter auf.
     *
     * @throws GhRpcConnectionException falls beim Senden der RPC-Anfrage ein Fehler auftrat
     * @throws GhRpcException falls beim Verarbeiten der RPC-Daten oder des Ergebnisses ein Fehler auftrat
     */
    public function TrainSpamFilter()
    {
        return $this->_sendRpcRequest('RpcInfo.TrainSpamFilter', [], self::$_rpcMethods['TrainSpamFilter']);
    }
}