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
 * RPC-Klasse für 64-Bit Integer.
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcInt64
{
    /**
     * String-Repräsentation des 64-Bit Integer Wertes.
     * Der Wert wird als String gespeichert, um die Kompatiblität mit 32-Bit Systeme zu gewährleisten.
     *
     * @var string
     */
    protected $_value;


    /**
     * Konstruktor.
     *
     * @param string|null $value String-Repräsentation eines 64-Bit Integers
     */
    public function __construct(string $value = null)
    {
        if ($value !== null) {
            $this->fromString($value);
        }
    }

    /**
     * Setzt den Wert aus einer String-Repräsentation eines 64-Bit Integers.
     *
     * @param string $value String
     */
    public function fromString($value)
    {
        $this->_value = (string)$value;
    }

    /**
     * Liefert den Wert als String-Repräsentation.
     *
     * @return string String-Repräsentation des 64-Bit Wertes
     */
    public function toString()
    {
        if ($this->_value === null) {
            return '0';
        } else {
            return (string)$this->_value;
        }
    }

    /**
     * Setzt den Wert aus einem Integer-Wert.
     * Je nach dem zugrunde liegenden System kann dies ein 32-Bit oder ein 64-Bit
     * Integer sein.
     *
     * @param int $value Integer-Wert
     */
    public function fromInt($value)
    {
        $this->_value = (string)$value;
    }

    /**
     * Liefert den Wert als Integer.
     * Bei 32-Bit-Systemen wird der Wert dabei möglicherweise abgeschnitten.
     *
     * @return int Integer-Wert
     */
    public function toInt()
    {
        return (int)$this->_value;
    }
}