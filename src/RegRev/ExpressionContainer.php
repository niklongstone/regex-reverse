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
 * Class ExpressionContainer,
 * handles the available regular expressions.
 */
class ExpressionContainer implements \Iterator
{
    private $position = 0;

    private $expressions = array();

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->position = 0;
    }

    /**
     * Sets the expression.
     *
     * @param mixed $expression
     */
    public function set($expression)
    {
        $this->expressions[] = $expression;
    }

    /**
     * Rewinds the container index.
     */
    public function rewind(): void
    {
        $this->position = 0;
    }

    /**
     * Gets the current element.
     *
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->expressions[$this->position];
    }

    /**
     * Returns the current key.
     *
     * @return int
     */
    public function key(): int
    {
        return $this->position;
    }

    /**
     * Increases the current index.
     */
    public function next(): void
    {
        ++$this->position;
    }

    /**
     * Checks if the expression is set.
     *
     * @return bool
     */
    public function valid(): bool
    {
        return isset($this->expressions[$this->position]);
    }
}