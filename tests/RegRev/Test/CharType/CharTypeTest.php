<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\CharType;

use RegRev\CharType\CharType;

class TestCharType extends CharType
{
    public function generate(){ return null;}
}


/**
 * Class Number
 *
 * @package RevReg\Char
 */
class CharTypetest extends \PHPUnit_Framework_TestCase
{
    public function testisValid()
    {
        $charTypeTest = new TestCharType();
        $charTypeTest->setChar('\d');

        $this->assertTrue($charTypeTest->isValid('\d'));
    }
}