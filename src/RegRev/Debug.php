<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev;

/**
 * Class Debug
 */
class Debug
{
    /** @var  array */
    private static $messages = array();

    /**
     * @param $message
     */
    static public function setMessage($message)
    {
        self::$messages[] = $message;
    }

    /**
     * @return array
     */
    static public function getMessages()
    {
        return self::$messages;
    }

    /**
     * @return array
     */
    static public function clear()
    {
        self::$messages = array();
    }
}