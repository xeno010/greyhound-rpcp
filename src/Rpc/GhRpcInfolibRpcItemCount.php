<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcDateTime;
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
class GhRpcInfolibRpcItemCount extends GhRpcStruct
{
    /**
     * TotalCount
     *
     * @var string
     */
    public $TotalCount;

    /**
     * TotalCountUniqueID
     *
     * @var string
     */
    public $TotalCountUniqueID;

    /**
     * TotalCountReset
     *
     * @var boolean
     */
    public $TotalCountReset;

    /**
     * ReadCount
     *
     * @var string
     */
    public $ReadCount;

    /**
     * ReadCountUniqueID
     *
     * @var string
     */
    public $ReadCountUniqueID;

    /**
     * ReadCountReset
     *
     * @var boolean
     */
    public $ReadCountReset;

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
        'TotalCount' => 'binary',
        'TotalCountUniqueID' => 'string',
        'TotalCountReset' => 'boolean',
        'ReadCount' => 'binary',
        'ReadCountUniqueID' => 'string',
        'ReadCountReset' => 'boolean',
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