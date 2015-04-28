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

use RegRev\Metacharacter\CharType\CharType;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class CharTypeTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->digit = new CharType();
        $this->digit->setChars('01');
    }
    public function testGenerate()
    {
        $this->assertTrue(is_numeric($this->digit->generate()));
    }
}