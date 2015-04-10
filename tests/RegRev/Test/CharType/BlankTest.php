<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\Char;

use RegRev\CharType\Blank;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class BlankTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->blank = new Blank();
    }

    public function testGenerate()
    {
        $this->assertEquals(' ', $this->blank->generate());
    }
}