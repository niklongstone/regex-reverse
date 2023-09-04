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

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class GenericTest extends TestCase
{
    protected function setUp(): void
    {
        $this->blank = new Generic();
        $this->blank->setReturnValue(' ');
    }

    public function testGenerate()
    {
        $this->assertEquals(' ', $this->blank->generate());
    }
}