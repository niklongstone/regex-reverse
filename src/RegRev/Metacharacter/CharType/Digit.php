<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter\CharType;

use RegRev\Metacharacter\CharacterHandler;

/**
 * Class Digit,
 * handles digit characters.
 */
class Digit extends CharacterHandler
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        return rand(0, 9);
    }
}