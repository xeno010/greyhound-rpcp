<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcStruct;

/**
 * RPC-Struct RpcTable.
 *
 * @package GhRpc
 * @subpackage rpc_schemaslib
 * @category PHP-RPC-Datenklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcSchemaslibRpcLockData extends GhRpcStruct
{
    /**
     * LockState
     *
     * @var int
     */
    public $LockState;

    /**
     * UserRef
     *
     * @var int
     */
    public $UserRef;

    /**
     * UserName
     *
     * @var string
     */
    public $UserName;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'LockState' => 'int',
        'UserRef' => 'int',
        'UserName' => 'string',
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