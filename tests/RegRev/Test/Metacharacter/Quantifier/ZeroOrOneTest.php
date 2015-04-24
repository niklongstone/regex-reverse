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

use RegRev\Metacharacter\CharType\Generic;
use RegRev\Metacharacter\Quantifier\ZeroOrOne;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class ZeroOrOneTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->regEx = new ZeroOrOne();
        $this->regEx->setPattern('?');

        $successor = new Generic();
        $successor->setReturnValue('1');
        $successor->setPattern('\d');
        $successor->setSuccessor($this->regEx);
    }

    public function testIsValid()
    {
        $pattern = '?';
        $valid = $this->regEx->isValid($pattern);

        $this->assertTrue($valid);
    }

    public function testGeneration()
    {
        $pattern = "\d?";
        $this->regEx->isValid($pattern);
        $result = $this->regEx->generate();

        $this->assertTrue((strlen($result) == 1 || is_null($result)));
    }
}