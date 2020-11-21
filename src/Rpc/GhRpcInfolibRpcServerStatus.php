<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcStruct;

/**
 * RPC-Struct RpcAddOnList.
 *
 * @package GhRpc
 * @subpackage rpc_infolib
 * @category PHP-RPC-Datenklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcInfolibRpcServerStatus extends GhRpcStruct
{
    /**
     * MySqlServer
     *
     * @var int
     */
    public $MySqlServer;

    /**
     * AppServer
     *
     * @var int
     */
    public $AppServer;

    /**
     * QueueServer
     *
     * @var int
     */
    public $QueueServer;

    /**
     * CommServer
     *
     * @var int
     */
    public $CommServer;

    /**
     * GatewayServer
     *
     * @var int
     */
    public $GatewayServer;

    /**
     * AccessServer
     *
     * @var int
     */
    public $AccessServer;

    /**
     * SyncServer
     *
     * @var int
     */
    public $SyncServer;

    /**
     * CommServerLastAction
     *
     * @var string
     */
    public $CommServerLastAction;

    /**
     * QueueServerLastAction
     *
     * @var string
     */
    public $QueueServerLastAction;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'MySqlServer' => 'int',
        'AppServer' => 'int',
        'QueueServer' => 'int',
        'CommServer' => 'int',
        'GatewayServer' => 'int',
        'AccessServer' => 'int',
        'SyncServer' => 'int',
        'CommServerLastAction' => 'string',
        'QueueServerLastAction' => 'string',
    ];


    /**
     * Liefert die Eigenschaften dieses RPC-Structs.
     *
     * @return array
     */
    public function getRpcProperties()
    {
        return self::$_rpcProperties;
    }

    /**
     * Liefert den Typ einer Eigenschaft dieses RPC-Structs.
     *
     * @param string $property Name der Eigenschaft
     * @return string
     */
    public function getRpcPropertyType($property)
    {
        return isset(self::$_rpcProperties[$property]) ? self::$_rpcProperties[$property] : null;
    }
}