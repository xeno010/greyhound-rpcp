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
class GhRpcSchemaslibRpcRow extends GhRpcStruct
{
    /**
     * Period
     *
     * @var int
     */
    public $Period;

    /**
     * TotalCount
     *
     * @var int
     */
    public $TotalCount;

    /**
     * Incoming
     *
     * @var int
     */
    public $Incoming;

    /**
     * Outgoing
     *
     * @var int
     */
    public $Outgoing;

    /**
     * InServiceLevel
     *
     * @var int
     */
    public $InServiceLevel;

    /**
     * OutServiceLevel
     *
     * @var int
     */
    public $OutServiceLevel;

    /**
     * ProcessTime
     *
     * @var int
     */
    public $ProcessTime;

    /**
     * Open
     *
     * @var int
     */
    public $Open;

    /**
     * New
     *
     * @var int
     */
    public $New;

    /**
     * Question
     *
     * @var int
     */
    public $Question;

    /**
     * Answer
     *
     * @var int
     */
    public $Answer;

    /**
     * Done
     *
     * @var int
     */
    public $Done;

    /**
     * Forward
     *
     * @var int
     */
    public $Forward;

    /**
     * Draft
     *
     * @var int
     */
    public $Draft;

    /**
     * Email
     *
     * @var int
     */
    public $Email;

    /**
     * Fax
     *
     * @var int
     */
    public $Fax;

    /**
     * Letter
     *
     * @var int
     */
    public $Letter;

    /**
     * ShortMessage
     *
     * @var int
     */
    public $ShortMessage;

    /**
     * Call
     *
     * @var int
     */
    public $Call;

    /**
     * Appointment
     *
     * @var int
     */
    public $Appointment;

    /**
     * Task
     *
     * @var int
     */
    public $Task;

    /**
     * Note
     *
     * @var int
     */
    public $Note;

    /**
     * Contact
     *
     * @var int
     */
    public $Contact;

    /**
     * Files
     *
     * @var int
     */
    public $Files;

    /**
     * Read
     *
     * @var int
     */
    public $Read;

    /**
     * Deleted
     *
     * @var int
     */
    public $Deleted;

    /**
     * Escalated
     *
     * @var int
     */
    public $Escalated;

    /**
     * Spam
     *
     * @var int
     */
    public $Spam;

    /**
     * Failure
     *
     * @var int
     */
    public $Failure;

    /**
     * Waiting
     *
     * @var int
     */
    public $Waiting;

    /**
     * Unsent
     *
     * @var int
     */
    public $Unsent;

    /**
     * Attachment
     *
     * @var int
     */
    public $Attachment;

    /**
     * Wholeday
     *
     * @var int
     */
    public $Wholeday;

    /**
     * Recurrence
     *
     * @var int
     */
    public $Recurrence;

    /**
     * Unclassifiable
     *
     * @var int
     */
    public $Unclassifiable;

    /**
     * Protocol
     *
     * @var int
     */
    public $Protocol;

    /**
     * Remarks
     *
     * @var int
     */
    public $Remarks;

    /**
     * UseHtml
     *
     * @var int
     */
    public $UseHtml;

    /**
     * Eml
     *
     * @var int
     */
    public $Eml;

    /**
     * DeliveryNotification
     *
     * @var int
     */
    public $DeliveryNotification;

    /**
     * Campaign
     *
     * @var int
     */
    public $Campaign;

    /**
     * GroupPath
     *
     * @var string
     */
    public $GroupPath;

    /**
     * UserName
     *
     * @var string
     */
    public $UserName;

    /**
     * TopicPath
     *
     * @var string
     */
    public $TopicPath;

    /**
     * ColorName
     *
     * @var string
     */
    public $ColorName;

    /**
     * Kind
     *
     * @var int
     */
    public $Kind;

    /**
     * State
     *
     * @var int
     */
    public $State;

    /**
     * Eigenschaften und Typen des RPC-Structs.
     *
     * @var array
     */
    protected static $_rpcProperties = [
        'Period' => 'int',
        'TotalCount' => 'int',
        'Incoming' => 'int',
        'Outgoing' => 'int',
        'InServiceLevel' => 'int',
        'OutServiceLevel' => 'int',
        'ProcessTime' => 'int',
        'Open' => 'int',
        'New' => 'int',
        'Question' => 'int',
        'Answer' => 'int',
        'Done' => 'int',
        'Forward' => 'int',
        'Draft' => 'int',
        'Email' => 'int',
        'Fax' => 'int',
        'Letter' => 'int',
        'ShortMessage' => 'int',
        'Call' => 'int',
        'Appointment' => 'int',
        'Task' => 'int',
        'Note' => 'int',
        'Contact' => 'int',
        'Files' => 'int',
        'Read' => 'int',
        'Deleted' => 'int',
        'Escalated' => 'int',
        'Spam' => 'int',
        'Failure' => 'int',
        'Waiting' => 'int',
        'Unsent' => 'int',
        'Attachment' => 'int',
        'Wholeday' => 'int',
        'Recurrence' => 'int',
        'Unclassifiable' => 'int',
        'Protocol' => 'int',
        'Remarks' => 'int',
        'UseHtml' => 'int',
        'Eml' => 'int',
        'DeliveryNotification' => 'int',
        'Campaign' => 'int',
        'GroupPath' => 'string',
        'UserName' => 'string',
        'TopicPath' => 'string',
        'ColorName' => 'string',
        'Kind' => 'int',
        'State' => 'int',
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