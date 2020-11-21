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
class GhRpcSchemaslibRpcGenerateOptions extends GhRpcStruct
{
    /**
     * StartField
     *
     * @var int
     */
    public $StartField;

    /**
     * StartOperator
     *
     * @var int
     */
    public $StartOperator;

    /**
     * StartDate
     *
     * @var GhRpcDateTime
     */
    public $StartDate;

    /**
     * EndField
     *
     * @var int
     */
    public $EndField;

    /**
     * EndOperator
     *
     * @var int
     */
    public $EndOperator;

    /**
     * EndDate
     *
     * @var GhRpcDateTime
     */
    public $EndDate;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'StartField' => 'int',
        'StartOperator' => 'int',
        'StartDate' => 'GhRpcDateTime',
        'EndField' => 'int',
        'EndOperator' => 'int',
        'EndDate' => 'GhRpcDateTime',
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