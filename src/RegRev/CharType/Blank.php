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
 * Class Number
 *
 * @package RevReg\Char
 */
class Blank extends CharType
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return ' ';
    }
}