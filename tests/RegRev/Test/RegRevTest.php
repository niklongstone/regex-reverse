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
            array('a'),
            array('\d'),
            array('\d*'),
            array('\D'),
            array('\w'),
            array('\w*'),
            array('\W'),
            array('\W*'),
            array('\s'),
            array('\s*'),
            array('\S'),
            array('\h'),
            array('(\d)'),
            array('(\d)'),
            array('\w+'),
            array('\w@\d@\w+'),
          //  array('\w+@\w+\.D{2,6}')
        );
    }
}