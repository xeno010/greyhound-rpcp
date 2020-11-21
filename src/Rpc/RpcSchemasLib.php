<?php
/**
 * GREYHOUND PHP API
 *
 * Copyright (c) 2011-2016 digital guru GmbH & Co. KG
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of the GREYHOUND PHP API and associated documentation files (the
 * "Software"), to deal in the Software without restriction, including without
 * limitation the rights to use, copy, modify, merge, publish, distribute,
 * sublicense, and/or sell copies of the Software, and to permit persons to
 * whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace GreyhoundRpcp\Rpc;

use GreyhoundRpcp\Core\GhRpcLibrary;
use GreyhoundRpcp\GhRpcClient;

/**
 * RPC-Unit rpc_schemaslib.
 *
 * @package GhRpc
 * @subpackage rpc_schemaslib
 * @category PHP-RPC-Units
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class RpcSchemasLib extends GhRpcLibrary
{
    // RpcDateOperator Konstanten:

    /**
     * doLessEqual Konstante (gehört zum Enum: RpcDateOperator).
     */
    public const doLessEqual = 0;
    /**
     * doLess Konstante (gehört zum Enum: RpcDateOperator).
     */
    public const doLess = 1;
    /**
     * doEqual Konstante (gehört zum Enum: RpcDateOperator).
     */
    public const doEqual = 2;
    /**
     * doGreater Konstante (gehört zum Enum: RpcDateOperator).
     */
    public const doGreater = 3;
    /**
     * doGreaterEqual Konstante (gehört zum Enum: RpcDateOperator).
     */
    public const doGreaterEqual = 4;

    // RpcDateField Konstanten:

    /**
     * dfStartDate Konstante (gehört zum Enum: RpcDateField).
     */
    public const dfStartDate = 0;
    /**
     * dfEndDate Konstante (gehört zum Enum: RpcDateField).
     */
    public const dfEndDate = 1;
    /**
     * dfCreated Konstante (gehört zum Enum: RpcDateField).
     */
    public const dfCreated = 2;
    /**
     * dfModified Konstante (gehört zum Enum: RpcDateField).
     */
    public const dfModified = 3;

    // RpcChartSort Konstanten:

    /**
     * csNone Konstante (gehört zum Enum: RpcChartSort).
     */
    public const csNone = 0;
    /**
     * csAscending Konstante (gehört zum Enum: RpcChartSort).
     */
    public const csAscending = 1;
    /**
     * csDescending Konstante (gehört zum Enum: RpcChartSort).
     */
    public const csDescending = 2;

    // RpcSpecial Konstanten:

    /**
     * sTotalCount Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sTotalCount = 0;
    /**
     * sIncoming Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sIncoming = 1;
    /**
     * sOutgoing Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sOutgoing = 2;
    /**
     * sInServiceLevel Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sInServiceLevel = 3;
    /**
     * sOutServiceLevel Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sOutServiceLevel = 4;
    /**
     * sProcessTime Konstante (gehört zum Enum: RpcSpecial).
     */
    public const sProcessTime = 5;

    // RpcFlag Konstanten:

    /**
     * fRead Konstante (gehört zum Enum: RpcFlag).
     */
    public const fRead = 0;
    /**
     * fDeleted Konstante (gehört zum Enum: RpcFlag).
     */
    public const fDeleted = 1;
    /**
     * fEscalated Konstante (gehört zum Enum: RpcFlag).
     */
    public const fEscalated = 2;
    /**
     * fSpam Konstante (gehört zum Enum: RpcFlag).
     */
    public const fSpam = 3;
    /**
     * fFailure Konstante (gehört zum Enum: RpcFlag).
     */
    public const fFailure = 4;
    /**
     * fWaiting Konstante (gehört zum Enum: RpcFlag).
     */
    public const fWaiting = 5;
    /**
     * fUnsent Konstante (gehört zum Enum: RpcFlag).
     */
    public const fUnsent = 6;
    /**
     * fAttachment Konstante (gehört zum Enum: RpcFlag).
     */
    public const fAttachment = 7;
    /**
     * fWholeDay Konstante (gehört zum Enum: RpcFlag).
     */
    public const fWholeDay = 8;
    /**
     * fRecurrence Konstante (gehört zum Enum: RpcFlag).
     */
    public const fRecurrence = 9;
    /**
     * fUnclassifiable Konstante (gehört zum Enum: RpcFlag).
     */
    public const fUnclassifiable = 10;
    /**
     * fProtocol Konstante (gehört zum Enum: RpcFlag).
     */
    public const fProtocol = 11;
    /**
     * fRemarks Konstante (gehört zum Enum: RpcFlag).
     */
    public const fRemarks = 12;
    /**
     * fUseHtml Konstante (gehört zum Enum: RpcFlag).
     */
    public const fUseHtml = 13;
    /**
     * fEml Konstante (gehört zum Enum: RpcFlag).
     */
    public const fEml = 14;
    /**
     * fDeliveryNotification Konstante (gehört zum Enum: RpcFlag).
     */
    public const fDeliveryNotification = 15;
    /**
     * fCampaign Konstante (gehört zum Enum: RpcFlag).
     */
    public const fCampaign = 16;

    // RpcKind Konstanten:

    /**
     * kEmail Konstante (gehört zum Enum: RpcKind).
     */
    public const kEmail = 0;
    /**
     * kFax Konstante (gehört zum Enum: RpcKind).
     */
    public const kFax = 1;
    /**
     * kLetter Konstante (gehört zum Enum: RpcKind).
     */
    public const kLetter = 2;
    /**
     * kShortMessage Konstante (gehört zum Enum: RpcKind).
     */
    public const kShortMessage = 3;
    /**
     * kCall Konstante (gehört zum Enum: RpcKind).
     */
    public const kCall = 4;
    /**
     * kAppointment Konstante (gehört zum Enum: RpcKind).
     */
    public const kAppointment = 5;
    /**
     * kTask Konstante (gehört zum Enum: RpcKind).
     */
    public const kTask = 6;
    /**
     * kNote Konstante (gehört zum Enum: RpcKind).
     */
    public const kNote = 7;
    /**
     * kContact Konstante (gehört zum Enum: RpcKind).
     */
    public const kContact = 8;
    /**
     * kFile Konstante (gehört zum Enum: RpcKind).
     */
    public const kFile = 9;

    // RpcChartKind Konstanten:

    /**
     * ckNone Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckNone = 0;
    /**
     * ckPie Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckPie = 1;
    /**
     * ckPie3D Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckPie3D = 2;
    /**
     * ckVBar Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckVBar = 3;
    /**
     * ckHBar Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckHBar = 4;
    /**
     * ckLine Konstante (gehört zum Enum: RpcChartKind).
     */
    public const ckLine = 5;

    // RpcPeriodField Konstanten:

    /**
     * pfCreated Konstante (gehört zum Enum: RpcPeriodField).
     */
    public const pfCreated = 0;
    /**
     * pfModified Konstante (gehört zum Enum: RpcPeriodField).
     */
    public const pfModified = 1;
    /**
     * pfStartDate Konstante (gehört zum Enum: RpcPeriodField).
     */
    public const pfStartDate = 2;
    /**
     * pfEndDate Konstante (gehört zum Enum: RpcPeriodField).
     */
    public const pfEndDate = 3;

    // RpcGroupBy Konstanten:

    /**
     * gbPeriod Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbPeriod = 0;
    /**
     * gbGroup Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbGroup = 1;
    /**
     * gbUser Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbUser = 2;
    /**
     * gbTopic Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbTopic = 3;
    /**
     * gbColor Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbColor = 4;
    /**
     * gbKind Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbKind = 5;
    /**
     * gbState Konstante (gehört zum Enum: RpcGroupBy).
     */
    public const gbState = 6;

    // RpcState Konstanten:

    /**
     * sOpen Konstante (gehört zum Enum: RpcState).
     */
    public const sOpen = 0;
    /**
     * sNew Konstante (gehört zum Enum: RpcState).
     */
    public const sNew = 1;
    /**
     * sQuestion Konstante (gehört zum Enum: RpcState).
     */
    public const sQuestion = 2;
    /**
     * sAnswer Konstante (gehört zum Enum: RpcState).
     */
    public const sAnswer = 3;
    /**
     * sDone Konstante (gehört zum Enum: RpcState).
     */
    public const sDone = 4;
    /**
     * sForward Konstante (gehört zum Enum: RpcState).
     */
    public const sForward = 5;
    /**
     * sDraft Konstante (gehört zum Enum: RpcState).
     */
    public const sDraft = 6;

    // RpcLayout Konstanten:

    /**
     * lHourly Konstante (gehört zum Enum: RpcLayout).
     */
    public const lHourly = 0;
    /**
     * lDaily Konstante (gehört zum Enum: RpcLayout).
     */
    public const lDaily = 1;
    /**
     * lDayOfWeek Konstante (gehört zum Enum: RpcLayout).
     */
    public const lDayOfWeek = 2;
    /**
     * lDayOfMonth Konstante (gehört zum Enum: RpcLayout).
     */
    public const lDayOfMonth = 3;
    /**
     * lDayOfYear Konstante (gehört zum Enum: RpcLayout).
     */
    public const lDayOfYear = 4;
    /**
     * lWeekly Konstante (gehört zum Enum: RpcLayout).
     */
    public const lWeekly = 5;
    /**
     * lWeekOfYear Konstante (gehört zum Enum: RpcLayout).
     */
    public const lWeekOfYear = 6;
    /**
     * lMonthly Konstante (gehört zum Enum: RpcLayout).
     */
    public const lMonthly = 7;
    /**
     * lMonthOfYear Konstante (gehört zum Enum: RpcLayout).
     */
    public const lMonthOfYear = 8;
    /**
     * lYearly Konstante (gehört zum Enum: RpcLayout).
     */
    public const lYearly = 9;

    // RpcLockState Konstanten:

    /**
     * lsUnlocked Konstante (gehört zum Enum: RpcLockState).
     */
    public const lsUnlocked = 0;
    /**
     * lsModified Konstante (gehört zum Enum: RpcLockState).
     */
    public const lsModified = 1;
    /**
     * lsLocked Konstante (gehört zum Enum: RpcLockState).
     */
    public const lsLocked = 2;

    /**
     * Hilfskonstante, die ein Set darstellt, in dem alle Enums gesetzt sind.
     *
     * @var int
     */
    public const SET_ALL = -1;


    /**
     * Erzeugt eine Instanz des RPC-Dienstes RpcSchemas.
     *
     * @param GhRpcClient $client Client Instanz
     *
     * @return GhRpcSchemaslibRpcSchemas
     */
    public static function newRpcSchemas(GhRpcClient $client)
    {
        return new GhRpcSchemaslibRpcSchemas($client);
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcGenerateOptions.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcSchemaslibRpcGenerateOptions
     */
    public static function newRpcGenerateOptions($fillProperties = false)
    {
        $object = new GhRpcSchemaslibRpcGenerateOptions();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcRow.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcSchemaslibRpcRow
     */
    public static function newRpcRow($fillProperties = false)
    {
        $object = new GhRpcSchemaslibRpcRow();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcReportSchema.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcSchemaslibRpcReportSchema
     */
    public static function newRpcReportSchema($fillProperties = false)
    {
        $object = new GhRpcSchemaslibRpcReportSchema();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcLockData.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcSchemaslibRpcLockData
     */
    public static function newRpcLockData($fillProperties = false)
    {
        $object = new GhRpcSchemaslibRpcLockData();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcSchema.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcSchemaslibRpcSchema
     */
    public static function newRpcSchema($fillProperties = false)
    {
        $object = new GhRpcSchemaslibRpcSchema();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }
}
