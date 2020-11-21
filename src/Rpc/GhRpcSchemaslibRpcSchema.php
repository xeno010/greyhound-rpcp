<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcDateTime;
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
class GhRpcSchemaslibRpcSchema extends GhRpcStruct
{
    /**
     * ID
     *
     * @var int
     */
    public $ID;

    /**
     * ReportRefs
     *
     * @var array
     */
    public $ReportRefs;

    /**
     * Order
     *
     * @var int
     */
    public $Order;

    /**
     * Name
     *
     * @var string
     */
    public $Name;

    /**
     * Layout
     *
     * @var int
     */
    public $Layout;

    /**
     * States
     *
     * @var int
     */
    public $States;

    /**
     * Kinds
     *
     * @var int
     */
    public $Kinds;

    /**
     * Flags
     *
     * @var int
     */
    public $Flags;

    /**
     * Specials
     *
     * @var int
     */
    public $Specials;

    /**
     * GroupBys
     *
     * @var int
     */
    public $GroupBys;

    /**
     * PeriodField
     *
     * @var int
     */
    public $PeriodField;

    /**
     * ChartKind
     *
     * @var int
     */
    public $ChartKind;

    /**
     * ChartSort
     *
     * @var int
     */
    public $ChartSort;

    /**
     * ChartRowCount
     *
     * @var int
     */
    public $ChartRowCount;

    /**
     * LockData
     *
     * @var GhRpcSchemaslibRpcLockData
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
        'ReportRefs' => 'array:int',
        'Order' => 'int',
        'Name' => 'string',
        'Layout' => 'int',
        'States' => 'int',
        'Kinds' => 'int',
        'Flags' => 'int',
        'Specials' => 'int',
        'GroupBys' => 'int',
        'PeriodField' => 'int',
        'ChartKind' => 'int',
        'ChartSort' => 'int',
        'ChartRowCount' => 'int',
        'LockData' => 'GhRpcSchemaslibRpcLockData',
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