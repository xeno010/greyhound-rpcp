<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcDateTime;
use GreyhoundRpcp\Core\GhRpcStruct;

/**
 * RPC-Struct RpcReportList.
 *
 * @package GhRpc
 * @subpackage rpc_reportslib
 * @category PHP-RPC-Datenklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcReportslibRpcReport extends GhRpcStruct
{
    /**
     * ID
     *
     * @var int
     */
    public $ID;

    /**
     * FilterRef
     *
     * @var int
     */
    public $FilterRef;

    /**
     * SchemaRefs
     *
     * @var array
     */
    public $SchemaRefs;

    /**
     * Name
     *
     * @var string
     */
    public $Name;

    /**
     * ServiceLevel
     *
     * @var int
     */
    public $ServiceLevel;

    /**
     * LockData
     *
     * @var GhRpcReportslibRpcLockData
     */
    public $LockData;

    /**
     * Created
     *
     * @var GhRpcDateTime
     */
    public $Created;

    /**
     * Modified
     *
     * @var GhRpcDateTime
     */
    public $Modified;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'ID' => 'int',
        'FilterRef' => 'int',
        'SchemaRefs' => 'array:int',
        'Name' => 'string',
        'ServiceLevel' => 'int',
        'LockData' => 'GhRpcReportslibRpcLockData',
        'Created' => 'GhRpcDateTime',
        'Modified' => 'GhRpcDateTime',
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