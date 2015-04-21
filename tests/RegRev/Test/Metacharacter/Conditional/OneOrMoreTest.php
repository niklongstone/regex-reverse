<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\Metacharacter\CharType;

use RegRev\Metacharacter\CharType\Digit;
use RegRev\Metacharacter\Conditional\OneOrMore;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class OneOrMoreTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->subpattern = new OneOrMore();
        $this->subpattern->setChar('+');

        $successor = new Digit();
        $successor->setChar('\d');
        $successor->setSuccessor($this->subpattern);
    }

    public function testIsValid()
    {
        $pattern = '+';
        $valid = $this->subpattern->isValid($pattern);

        $this->assertTrue($valid);
    }

    public function testGeneration()
    {
        $pattern = "\d+";
        $this->subpattern->isValid($pattern);
        $result = $this->subpattern->generate();

        $this->assertTrue(is_numeric($result));
    }
}