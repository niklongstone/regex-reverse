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

        $this->assertEquals($string, $result);
    }

    /**
     * @dataProvider regExData
     */
    public function testAdvancedSupportedRegex($expression)
    {
        $matchedExpression = null;
        $result = RegRev::generate($expression);
        preg_match('/(' . $expression . ')$/i', $result, $match);
        if (isset($match[0])) {
            $matchedExpression = $match[0];
        }

        $this->assertEquals($matchedExpression, $result,
            sprintf('The result "%s", do not match the regex "/%s/"', $result, $expression)
        );
    }

    public function regExData()
    {
        return array(
            array('a{1,3}'),
            array('\d'),
            array('\d*'),
            array('\D'),
            array('\w'),
            array('\w*'),
            array('\W'),
            array('\W*'),
            array('\h\S\s*\s'),
            array('(\d)'),
            array('\w+'),
            array('\w@\d@\w+'),
            array('(a+b*)+'),
            array('\.com'),
            array('\(\d{3}\)\s\d{7}'),
            array('\w+@\w+\.\D{2,3}'),
            array('13[0-9][a-z]'),
            array('13(test)(test2)[0-9][a-z]')
        );
    }
}