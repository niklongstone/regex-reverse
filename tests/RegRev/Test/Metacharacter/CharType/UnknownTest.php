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

use RegRev\Metacharacter\CharType\Unknown;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class UnknownTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->unknown = new Unknown();
    }

    public function testGeneration()
    {
        $pattern = "a";
        $this->unknown->isValid($pattern);

        $this->assertEquals($pattern, $this->unknown->generate());
    }
}