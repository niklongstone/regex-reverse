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

class ExpressionContainer implements \Iterator {
    private $position = 0;

    private $expressions = array();

    public function __construct() {
        $this->position = 0;
    }

    public function set($expression)
    {
        $this->expressions[] = $expression;
    }

    function rewind() {
        $this->position = 0;
    }

    function current() {
        return $this->expressions[$this->position];
    }

    function key() {
        return $this->position;
    }

    function next() {
        ++$this->position;
    }

    function valid() {
        return isset($this->expressions[$this->position]);
    }
}