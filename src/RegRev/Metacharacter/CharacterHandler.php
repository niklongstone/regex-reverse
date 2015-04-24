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
 * Class CharacterHandler
 */
abstract class CharacterHandler
{
    private $patterns = array();
    private $match;
    private $successor;
    private $previous;

    /**
     * @param string $string
     *
     * @return bool
     */
    public function isValid($string)
    {
        foreach ($this->getPatterns() as $pattern) {
            if (strpos($string, $pattern) === 0) {
                $this->match = substr($string, 0, strlen($pattern));

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

    /**
     * Sets a string that identify the regular expression.
     *
     * @param string $pattern
     */
    public function setPattern($pattern)
    {
        array_push($this->patterns, $pattern);
    }

    /**
     * Gets a the meta char
     *
     * @return string
     */
    public function getPatterns()
    {
        return $this->patterns;
    }

    /**
     * @return string mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

   /**
     * @param string $match
     *
     * @return string mixed
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }

    /**
     * @return string
     */
    abstract public function generate();

    /**
     * @param CharacterHandler $handler
     */
    final public function setSuccessor(CharacterHandler $handler)
    {
        $this->successor = $handler;
        $this->successor->setPrevious($this);
    }

    /**
     * @param CharacterHandler $handler
     */
    final public function setPrevious(CharacterHandler $handler)
    {
        $this->previous = $handler;
    }

    /**
     * @return CharacterHandler
     */
    final public function getPrevious()
    {
        return $this->previous;
    }

    /**
     * @param string $result
     *
     * @return string
     */
    final public function getResult($result = '')
    {
        $result.= $this->generate();
        if ($this->successor !== null) {
            return $this->successor->getResult($result);
        }

        return $result;
    }
}
