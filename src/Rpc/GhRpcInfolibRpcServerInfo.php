<?php

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcDateTime;
use GreyhoundRpcp\Core\GhRpcInt64;
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
class GhRpcInfolibRpcServerInfo extends GhRpcStruct
{
    /**
     * OnlineSince
     *
     * @var GhRpcDateTime
     */
    public $OnlineSince;

    /**
     * ServerTime
     *
     * @var GhRpcDateTime
     */
    public $ServerTime;

    /**
     * Version
     *
     * @var string
     */
    public $Version;

    /**
     * Connections
     *
     * @var int
     */
    public $Connections;

    /**
     * MaxConnections
     *
     * @var int
     */
    public $MaxConnections;

    /**
     * HttpPort
     *
     * @var int
     */
    public $HttpPort;

    /**
     * RpcpPort
     *
     * @var int
     */
    public $RpcpPort;

    /**
     * KeepAlive
     *
     * @var boolean
     */
    public $KeepAlive;

    /**
     * Compress
     *
     * @var boolean
     */
    public $Compress;

    /**
     * UseRpcps
     *
     * @var boolean
     */
    public $UseRpcps;

    /**
     * UseSSL
     *
     * @var boolean
     */
    public $UseSSL;

    /**
     * MethodCount
     *
     * @var int
     */
    public $MethodCount;

    /**
     * Win32ClientVersion
     *
     * @var string
     */
    public $Win32ClientVersion;

    /**
     * CPU
     *
     * @var string
     */
    public $CPU;

    /**
     * CPUUsage
     *
     * @var int
     */
    public $CPUUsage;

    /**
     * OS
     *
     * @var string
     */
    public $OS;

    /**
     * TotalPhysicalMemory
     *
     * @var GhRpcInt64
     */
    public $TotalPhysicalMemory;

    /**
     * AvailablePhysicalMemory
     *
     * @var GhRpcInt64
     */
    public $AvailablePhysicalMemory;

    /**
     * TotalVirtualMemory
     *
     * @var GhRpcInt64
     */
    public $TotalVirtualMemory;

    /**
     * AvailableVirtualMemory
     *
     * @var GhRpcInt64
     */
    public $AvailableVirtualMemory;

    /**
     * DatabaseSize
     *
     * @var GhRpcInt64
     */
    public $DatabaseSize;

    /**
     * Hostname
     *
     * @var string
     */
    public $Hostname;

    /**
     * IPAddress
     *
     * @var string
     */
    public $IPAddress;

    /**
     * DiskSize
     *
     * @var GhRpcInt64
     */
    public $DiskSize;

    /**
     * DiskFree
     *
     * @var GhRpcInt64
     */
    public $DiskFree;

    /**
     * ServerTimeZone
     *
     * @var string
     */
    public $ServerTimeZone;

    /**
     * BiggestDatabaseTableSize
     *
     * @var GhRpcInt64
     */
    public $BiggestDatabaseTableSize;

    /**
     * Edition
     *
     * @var int
     */
    public $Edition;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'OnlineSince' => 'GhRpcDateTime',
        'ServerTime' => 'GhRpcDateTime',
        'Version' => 'string',
        'Connections' => 'int',
        'MaxConnections' => 'int',
        'HttpPort' => 'int',
        'RpcpPort' => 'int',
        'KeepAlive' => 'boolean',
        'Compress' => 'boolean',
        'UseRpcps' => 'boolean',
        'UseSSL' => 'boolean',
        'MethodCount' => 'int',
        'Win32ClientVersion' => 'string',
        'CPU' => 'string',
        'CPUUsage' => 'int',
        'OS' => 'string',
        'TotalPhysicalMemory' => 'GhRpcInt64',
        'AvailablePhysicalMemory' => 'GhRpcInt64',
        'TotalVirtualMemory' => 'GhRpcInt64',
        'AvailableVirtualMemory' => 'GhRpcInt64',
        'DatabaseSize' => 'GhRpcInt64',
        'Hostname' => 'string',
        'IPAddress' => 'string',
        'DiskSize' => 'GhRpcInt64',
        'DiskFree' => 'GhRpcInt64',
        'ServerTimeZone' => 'string',
        'BiggestDatabaseTableSize' => 'GhRpcInt64',
        'Edition' => 'int',
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