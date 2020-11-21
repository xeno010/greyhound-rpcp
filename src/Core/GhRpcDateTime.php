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
 * Klasse für RPC-Datumsangaben (ISO8601).
 *
 * @package GhRpc
 * @subpackage core
 * @category PHP-RPC-Kernklassen
 *
 * @author digital guru GmbH &amp; Co. KG <develop@greyhound-software.com>
 * @copyright 2011-2016 digital guru GmbH &amp; Co. KG
 * @link greyhound-software.com
 */
class GhRpcDateTime
{
    /**
     * Zeitstempel (Unix-Epoche).
     *
     * @var int
     */
    protected $_timestamp;

    /**
     * Konstruktor.
     *
     * Optional kann der Zeitpunkt (Datum und Uhrzeit) angegeben werden,
     * entweder als Unix-Zeitstempel (Integer Wert) oder als Text (String).
     *
     * @param int|string|null $dateTime Zeitpunkt
     */
    public function __construct($dateTime = null)
    {
        if (is_numeric($dateTime))
            $this->setTimestamp($dateTime);
        else if (is_string($dateTime))
            $this->setDateTime($dateTime);
    }

    /**
     * Setzt Datum und Zeit anhand einer String-Repräsentation.
     *
     * @param string $dateTime String mit Datum und Zeit
     * @return void
     */
    public function setDateTime($dateTime)
    {
        $this->_timestamp = strtotime($dateTime);
    }

    /**
     * Liefert Datum und Zeit als String im ISO8601 Format.
     *
     * @param boolean $allowEmpty true: ein leerer Wert führt zu einer leeren Rückgabe, false: ein leerer Wert liefert 1970-01-01T01:00:00+01:00 (Nullpunkt der Unix Epoche)
     * @return string ISO8601 Zeit-/Datumsangabe
     */
    public function getDateTime($allowEmpty = true)
    {
        if ($allowEmpty && !$this->_timestamp) {
            return null;
        }

        $str = date('c', $this->_timestamp);
        $index = strpos($str, 'T');

        if ($index !== false)
            $str = str_replace('-', '', substr($str, 0, $index)) . substr($str, $index);

        return $str;
    }

    /**
     * Setzt Datum und Zeit anhand eines Unix Zeitstempels.
     *
     * @param int $time Zeitstempel (Unix Epoche)
     */
    public function setTimestamp($time)
    {
        $this->_timestamp = $time;
    }

    /**
     * Liefert Datum und Zeit als Unix Zeitstempel.
     *
     * @return int Zeitstempel (Unix Epoche)
     */
    public function getTimestamp()
    {
        return $this->_timestamp;
    }

    /**
     * Setzt das aktuelle Datum und die aktuelle Zeit.
     */
    public function setNow()
    {
        $this->_timestamp = time();
    }

    /**
     * Liefert Datum und/oder Zeit als formatierten String.
     * Das Format ist das gleiche, welches auch bei der PHP date() Funktion
     * verwendet wird.
     *
     * @param string $format Datums-/Zeit-Format (wie bei der PHP date() Funktion)
     * @param string $language Sprachcode (für Namen von Monaten oder Wochentagen: de, en, es, fr)
     * @return string Datum/Zeit als formatierter String
     */
    public function getFormatted($format = 'Y-m-d H:i:s', $language = 'de')
    {
        return date_format($this->_timestamp, $format);
      //  return GhCoreLocale::date($format, $this->_timestamp, $language);
    }
}