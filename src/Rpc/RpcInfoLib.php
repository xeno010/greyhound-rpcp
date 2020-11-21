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
 * RPC-Unit rpc_infolib.
 *
 * @package GhRpc
 * @subpackage rpc_infolib
 * @category PHP-RPC-Units
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class RpcInfoLib extends GhRpcLibrary
{
    // RpcItemCountKind Konstanten:

    /**
     * ickTotal Konstante (gehört zum Enum: RpcItemCountKind).
     */
    public const ickTotal = 0;
    /**
     * ickRead Konstante (gehört zum Enum: RpcItemCountKind).
     */
    public const ickRead = 1;

    // RpcStatusFlag Konstanten:

    /**
     * sfRunning Konstante (gehört zum Enum: RpcStatusFlag).
     */
    public const sfRunning = 0;
    /**
     * sfStopped Konstante (gehört zum Enum: RpcStatusFlag).
     */
    public const sfStopped = 1;
    /**
     * sfFailure Konstante (gehört zum Enum: RpcStatusFlag).
     */
    public const sfFailure = 2;

    // RpcWorkSpace Konstanten:

    /**
     * wsSystem Konstante (gehört zum Enum: RpcWorkSpace).
     */
    public const wsSystem = 0;
    /**
     * wsPersonal Konstante (gehört zum Enum: RpcWorkSpace).
     */
    public const wsPersonal = 1;

    /**
     * Hilfskonstante, die ein Set darstellt, in dem alle Enums gesetzt sind.
     *
     * @var int
     */
    public const SET_ALL = -1;


    /**
     * Erzeugt eine Instanz des RPC-Dienstes RpcInfo.
     *
     * @param GhRpcClient $client Client Instanz
     *
     * @return GhRpcInfolibRpcInfo
     */
    public static function newRpcInfo(GhRpcClient $client)
    {
        return new GhRpcInfolibRpcInfo($client);
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcAddOn.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcAddOn
     */
    public static function newRpcAddOn($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcAddOn();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcServerSettings.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcServerSettings
     */
    public static function newRpcServerSettings($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcServerSettings();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcQueueRule.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcQueueRule
     */
    public static function newRpcQueueRule($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcQueueRule();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcQueueStatus.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcQueueStatus
     */
    public static function newRpcQueueStatus($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcQueueStatus();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcServerStatus.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcServerStatus
     */
    public static function newRpcServerStatus($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcServerStatus();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcItemCount.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcItemCount
     */
    public static function newRpcItemCount($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcItemCount();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcRight.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcRight
     */
    public static function newRpcRight($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcRight();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }

    /**
     * Erzeugt eine Instanz des RPC-Structs RpcServerInfo.
     *
     * @param boolean $fillProperties true: Objekt-Eigenschaften mit leeren Objekten / Arrays vorbefüllen
     * @return GhRpcInfolibRpcServerInfo
     */
    public static function newRpcServerInfo($fillProperties = false)
    {
        $object = new GhRpcInfolibRpcServerInfo();

        if ($fillProperties)
            $object = self::_fillProperties($object);

        return $object;
    }
}
