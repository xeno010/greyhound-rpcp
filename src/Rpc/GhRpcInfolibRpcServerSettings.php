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
class GhRpcInfolibRpcServerSettings extends GhRpcStruct
{
    /**
     * PhoneAddressItemCountryPrefix
     *
     * @var string
     */
    public $PhoneAddressItemCountryPrefix;

    /**
     * ElementsPerPage
     *
     * @var int
     */
    public $ElementsPerPage;

    /**
     * ElementsPerList
     *
     * @var int
     */
    public $ElementsPerList;

    /**
     * EventsPerPage
     *
     * @var int
     */
    public $EventsPerPage;

    /**
     * EventsPerDay
     *
     * @var int
     */
    public $EventsPerDay;

    /**
     * MaxSearchResults
     *
     * @var int
     */
    public $MaxSearchResults;

    /**
     * UseItemCount
     *
     * @var boolean
     */
    public $UseItemCount;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'PhoneAddressItemCountryPrefix' => 'string',
        'ElementsPerPage' => 'int',
        'ElementsPerList' => 'int',
        'EventsPerPage' => 'int',
        'EventsPerDay' => 'int',
        'MaxSearchResults' => 'int',
        'UseItemCount' => 'boolean',
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