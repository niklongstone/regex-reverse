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

use RegRev\Metacharacter\GroupType\Subpattern;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class SubpatternTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->subpattern = new Subpattern();
        $this->subpattern->setChar('/\(.*\)/');
    }

    public function testGenerate()
    {
        $pattern = "123-_()(())p";
        $vaid = $this->subpattern->isValid($pattern);

        $this->assertTrue($vaid);
    }
}