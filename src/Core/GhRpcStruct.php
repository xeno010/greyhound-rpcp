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
 * Basisklasse für RPC-Struct Objekte.
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
abstract class GhRpcStruct
{
    /**
     * Diese Methode muss so überladen werden, dass sie einen Array mit
     * Objekt-Eigenschaften (als Schlüssel) und Datentypen (als Werte)
     * zurückgibt.
     *
     * Beispiel:
     * <code>
     * return array( 'ID' => 'int', 'Kind' => 'GhRpcItemslibItemKind' );
     * </code>
     *
     * @return array
     */
    abstract public function getRpcProperties();

    /**
     * Diese Methode muss so überladen werden, dass sie den Datentyp einer
     * Objekteigenschaft zurückliefert.
     *
     * @param string $property Objekteigenschaft (ohne $-Zeichen)
     * @return string Datentyp
     */
    abstract public function getRpcPropertyType($property);
}