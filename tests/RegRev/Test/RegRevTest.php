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

use RegRev\Configuration;
use RegRev\Debug;
use RegRev\RegRev;

class RegRevTest extends \PHPUnit_Framework_TestCase
{
    public function testCustomConfiguration()
    {
        $customPattern = '\x';
        $config =  array(
                        array(
                            'type' => 'CharType\\CharType',
                            'chars' => '0123456789',
                            'pattern' => array($customPattern)
                        ),
                    array(
                        'type' => 'CharType\Unknown',
                        )
                    );
        RegRev::setUp($config);
        $result = RegRev::generate($customPattern);

        $this->assertTrue(is_numeric($result));
        $this->resetConfig();
    }

    public function testSupportedRegex()
    {
        $string = '\d';
        $result = RegRev::generate($string);

        $this->assertTrue(is_numeric($result));
    }

    /**
     * @expectedException RegRev\Exception\RegExpNotValidException
     */
    public function testNotValidRegex()
    {
        $string = '/\d/';
        RegRev::generate($string);
    }

    public function testNotSupportedRegex()
    {
        $string = '#';
        $result = RegRev::generate($string);

        $this->assertEquals($string, $result);
    }

    public function testDebug()
    {
        Debug::clear();
        $string = '#';
        RegRev::generate($string);
        $debug = RegRev::debug();

        $this->assertContains('Unknown', $debug[0]);
    }

    /**
     * @dataProvider regExData
     */
    public function testAdvancedSupportedRegex($expression)
    {
        $matchedExpression = null;
        $result = RegRev::generate($expression);
        preg_match('#' . $expression . '#', $result, $match);
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
            array('&quot;([^&quot;](\\.|[^\\&quot;]*)*)&quot'),
            array('[-a-zA-Z0-9]'),
            array('a{1,3}'),
            array('\d'),
            array('\d*\D\w\W\W*'),
            array('\h\S\s*\s'),
            array('(\d)'),
            array('\w+'),
            array('\w@\d@\w+'),
            array('(a+b*)+'),
            array('\.com'),
            array('\(\d{3}\)\s\d{7}'),
            array('\w+@\w+\.\D{2,3}'),
            array('13[0-9][a-z]'),
            array('13(t(t)est)(test2)[0-9][a-z]'),
            array('((hello world))'),
            array('([)(])'),
            array('([)])'),
            array('\(\[\)\]\)\?\.\*\+\{\}'),
            array('a|b|c|d'),
            array('^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$'),
            array('^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$'),
            array('^(http|https|ftp):\/\/[-a-zA-Z0-9\.]+\.[a-zA-Z]{2,3}(:[0-9]*)?\/?(\w)*$'),
            array('(^\d*\.?\d*[0-9]+\d*$)|(^[0-9]+\d*\.\d*$)'),
            array('^\$?([0-9]{1,3},([0-9]{3},)*[0-9]{3}|[0-9]+)(.[0-9][0-9])?$'),
            array('(^(\+?\-? *[0-9]+)([,0-9 ]*)([0-9 ])*$)|(^ *$)'),
            array('[^01234567abcdAbcd]'),
            array('^ISBN\s([-0-9xX ]{13})([0-9]+[- ]){3}[0-9]*[xX0-9]$'),
            array('^(1\s*[-\/\.]?)?(\((\d{3})\)|(\d{3}))\s*[-\/\.]?\s*(\d{3})\s*[-\/\.]?\s*(\d{4})\s*(([xX]|[eE][xX][tT])\.?\s*(\d+))*$'),
            array('^\(\d{3}\) ?\d{3}( |-)?\d{4}|^\d{3}( |-)?\d{3}( |-)?\d{4}'),
            array('[-\/\.]'),
            array('&lt;[^&gt;]*\n?.*=(&quot;|\')?(.*\.jpg)(&quot;|\')?.*\n?[^&lt;]*&gt'),
            array('<[a-zA-Z][^>]*\son\w+=(\w+|\'[^\']*\'|"[^"]*")[^>]*>')
        );
    }

    private function resetConfig()
    {
        $configuration = new Configuration();
        $parameters = $configuration->getConfig();
        RegRev::setUp($parameters);
    }
}