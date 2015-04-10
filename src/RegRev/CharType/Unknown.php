<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\CharType;

/**
 * Class Unknown,
 * returns blank space for not supported regex.
 *
 * @package RevReg\Char
 */
class Unknown extends CharType
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return ' ';
    }

    /**
     * {@inheritdoc}
     */
    public function isValid($string)
    {
        return true;
    }

    /**
     * @return string
     */
    public function getMatch()
    {
        return ' ';
    }
}
