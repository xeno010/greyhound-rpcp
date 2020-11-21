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
class GhRpcInfolibRpcQueueStatus extends GhRpcStruct
{
    /**
     * ActionSpamCount
     *
     * @var int
     */
    public $ActionSpamCount;

    /**
     * ActionOcrCount
     *
     * @var int
     */
    public $ActionOcrCount;

    /**
     * ActionHtmlInlineCount
     *
     * @var int
     */
    public $ActionHtmlInlineCount;

    /**
     * ActionWorkflowCount
     *
     * @var int
     */
    public $ActionWorkflowCount;

    /**
     * ActionIndexAddCount
     *
     * @var int
     */
    public $ActionIndexAddCount;

    /**
     * ActionIndexDeleteCount
     *
     * @var int
     */
    public $ActionIndexDeleteCount;

    /**
     * ActionVirusCount
     *
     * @var int
     */
    public $ActionVirusCount;

    /**
     * QueueRules
     *
     * @var array
     */
    public $QueueRules;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'ActionSpamCount' => 'int',
        'ActionOcrCount' => 'int',
        'ActionHtmlInlineCount' => 'int',
        'ActionWorkflowCount' => 'int',
        'ActionIndexAddCount' => 'int',
        'ActionIndexDeleteCount' => 'int',
        'ActionVirusCount' => 'int',
        'QueueRules' => 'array:GhRpcInfolibRpcQueueRule',
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