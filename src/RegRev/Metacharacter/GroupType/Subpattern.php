<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter\GroupType;

use RegRev\Metacharacter\CharacterHandler;

/**
 * Class CharType
 *
 * @package RegRev\CharType
 */
class Subpattern extends CharacterHandler
{
    private $chars = array();
    private $match;

    /**
     * {@inheritdoc}
     */
    public function isValid($string)
    {
        foreach ($this->getChars() as $char) {
            if (preg_match($char, $string)) {
                $this->match = $char;

                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function generate()
    {
        return true;
    }
}
