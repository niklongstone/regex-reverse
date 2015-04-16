<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter;

/**
 * Class CharType
 *
 * @package RegRev\CharType
 */
abstract class CharacterHandler
{
    private $chars = array();
    private $match;

    /**
     * @param string $string
     *
     * @return bool
     */
    public function isValid($string)
    {
        foreach ($this->chars as $char) {
            if (strpos($string, $char) === 0) {
                $this->match = $char;

                return true;
            }
        }

        return false;
    }

    /**
     * Gets a description of a meta char
     *
     * @return string
     */
    public function getName()
    {
        return get_class($this);
    }

    public function setChar($char)
    {
        array_push($this->chars, $char);
    }

    /**
     * Gets a the meta char
     *
     * @return string
     */
    public function getChars()
    {
        return $this->chars;
    }

    /**
     * @return string mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @return string
     */
    abstract public function generate();
}