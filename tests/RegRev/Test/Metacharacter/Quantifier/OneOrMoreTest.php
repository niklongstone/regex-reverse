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
use RegRev\Metacharacter\Quantifier\OneOrMore;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class OneOrMoreTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->regEx = new OneOrMore();
        $this->regEx->setPattern('+');

        $successor = new Digit();
        $successor->setPattern('\d');
        $successor->setSuccessor($this->regEx);
    }

    public function testIsValid()
    {
        $pattern = '+';
        $valid = $this->regEx->isValid($pattern);

        $this->assertTrue($valid);
    }

    public function testGeneration()
    {
        $pattern = "\d+";
        $this->regEx->isValid($pattern);
        $result = $this->regEx->generate();

        $this->assertTrue(is_numeric($result));
    }
}