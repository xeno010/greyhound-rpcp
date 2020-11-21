<?php
/*
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

namespace GreyhoundRpcp\Core;

/**
 * Basisklasse für RPC-Libraries (Units).
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcLibrary
{
    /**
     * Füllt die Eigenschaften eines RPC Objekts mit leeren Objekten/Arrays.
     *
     * @param GhRpcStruct $object RPC Objekt
     * @return GhRpcStruct
     */
    protected static function _fillProperties(GhRpcStruct $object)
    {
        foreach ($object->getRpcProperties() as $property => $type) {
            if ($type === 'GhRpcDateTime')
                $object->$property = new GhRpcDateTime();
            else if ($type === 'GhRpcInt64')
                $object->$property = new GhRpcInt64();
            else if (substr($type, 0, 5) === 'GhRpc')
                $object->$property = self::_fillProperties(new $type());
            else if (substr($type, 0, 5) === 'array')
                $object->$property = [];
        }

        return $object;
    }
}