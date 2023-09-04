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

use PHPUnit\Framework\TestCase;
use RegRev\Metacharacter\CharType\Generic;
use RegRev\Metacharacter\Quantifier\ZeroOrMore;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class ZeroOrMoreTest extends TestCase
{
    protected function setUp(): void
    {
        $this->regEx = new ZeroOrMore();
        $this->regEx->setPattern('*');

        $successor = new Generic();
        $successor->setReturnValue('1');
        $successor->setPattern('\d');
        $successor->setSuccessor($this->regEx);
    }

    public function testIsValid()
    {
        $pattern = '*';
        $valid = $this->regEx->isValid($pattern);

        $this->assertTrue($valid);
    }

    public function testGeneration()
    {
        $pattern = "\d*";
        $this->regEx->isValid($pattern);
        $result = $this->regEx->generate();

        $this->assertTrue((is_numeric($result) || is_null($result)));
    }
}