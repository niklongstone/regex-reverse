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
use RegRev\Metacharacter\Range\Range;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class RangeTest extends TestCase
{
    protected function setUp(): void
    {
        $this->subpattern = new Range();
        $this->subpattern->setPattern('/^\[[^\]]*\]/');
        $this->chars = '01ab';
        $this->subpattern->setChars($this->chars);
    }

    /**
     * @dataProvider validData
     */
    public function testIsValid($pattern)
    {
        $valid = $this->subpattern->isValid($pattern);

        $this->assertTrue($valid);
    }

    /**
     * @dataProvider validData
     */
    public function testGeneration($pattern, $possibleResults)
    {
        $this->subpattern->isValid($pattern);
        $result = $this->subpattern->generate();

        $this->assertTrue(in_array($result, $possibleResults), sprintf('The result %s, is not one of the possible results', $result));
    }

    public function validData()
    {
        return array(
            array('[a-cA-C0-2_\-\.]', array('a', 'b', 'c', 'A', 'B', 'C', '0', '1', '2', '_', '-', '.')),
        /*
            array('[0]', array('0')),
            array('[02]', array('0','2')),
            array('[a-c8-9]', array('a','b','c','8','9')),
            array('[1-2a]', array('1','2','a')),
            array('[a-c]', array('a','b','c')),
            array('[0-2-]', array('0','1','2','-')),
            array('[\.-]', array('.','-')),
            array('[^a-b0]', array('1'))*/
        );
    }
}