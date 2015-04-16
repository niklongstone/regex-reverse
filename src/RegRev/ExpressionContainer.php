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

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        return $this->expressions[$this->position];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        return isset($this->expressions[$this->position]);
    }
}