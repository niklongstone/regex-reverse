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

use RegRev\Metacharacter\CharType\NonAlnum;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class NonAlnumTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->nonAlnum = new NonAlnum();
    }

    public function testGenerate()
    {
        $this->assertFalse(ctype_alnum($this->nonAlnum->generate()));
    }
}