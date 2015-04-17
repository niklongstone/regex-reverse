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
/*
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

        $this->assertEquals($string, $result);
    }
*/
    /**
     * @dataProvider regExData
     */
    public function testAdvancedSupportedRegex($expression)
    {
        $result = RegRev::generate($expression);
        $this->assertTrue(
            (boolean)preg_match('/' . $expression . '/i', $result),
            sprintf('The result "%s", do not match the regex "/%s/"', $result, $expression)
        );
    }

    public function regExData()
    {
        return array(
            array('\w@\w@\w+')

//email            array('\w+@\w+\.D{2,6}')
        );
    }
}