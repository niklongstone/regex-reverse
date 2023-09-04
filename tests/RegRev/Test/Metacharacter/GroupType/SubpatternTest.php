<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\Metacharacter\GroupType;

use PHPUnit\Framework\TestCase;
use RegRev\Metacharacter\GroupType\Subpattern;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class SubpatternTest extends TestCase
{
    protected function setUp(): void
    {
        $this->subpattern = new Subpattern();
        $this->subpattern->setPattern('/\(.*\)/');
    }

    public function testIsValid()
    {
        $pattern = "123-_()(())p";
        $valid = $this->subpattern->isValid($pattern);

        $this->assertTrue($valid);
    }

    public function testGeneration()
    {
        $pattern = "(\d)";
        $this->subpattern->isValid($pattern);

        $this->assertTrue(is_numeric($this->subpattern->generate()));
    }
}