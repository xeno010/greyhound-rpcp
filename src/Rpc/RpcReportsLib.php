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
 * RPC-Unit rpc_reportslib.
 *
 * @package GhRpc
 * @subpackage rpc_reportslib
 * @category PHP-RPC-Units
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class RpcReportsLib extends GhRpcLibrary
{
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
     * Erzeugt eine Instanz des RPC-Dienstes RpcReports.
     *
     * @param GhRpcClient $client Client Instanz
     *
     * @return GhRpcReportslibRpcReports
     */
    public static function newRpcReports(GhRpcClient $client)
    {
        return new GhRpcReportslibRpcReports($client);
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcLockData.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcReportslibRpcLockData
     */
    public static function newRpcLockData($fillProperties = false)
    {
        $object = new GhRpcReportslibRpcLockData();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcReport.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcReportslibRpcReport
     */
    public static function newRpcReport($fillProperties = false)
    {
        $object = new GhRpcReportslibRpcReport();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }
}
