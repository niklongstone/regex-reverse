<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test;

use RegRev\RegRev;

class RegRevTest extends \PHPUnit_Framework_TestCase
{

    public function testSupportedRegex()
    {
        $string = '\d';
        $result = RegRev::generate($string);

        $this->assertTrue(is_numeric($result));
    }

    public function testNotSupportedRegex()
    {
        $string = '#';
        $result = RegRev::generate($string);

        $this->assertEquals(' ',$result);
    }
}