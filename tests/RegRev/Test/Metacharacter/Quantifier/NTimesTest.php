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

use RegRev\Metacharacter\CharType\Generic;
use RegRev\Metacharacter\Quantifier\NTimes;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class NTimesTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->regEx = new NTimes();
        $this->regEx->setPattern('/\{(\d*),?(\d*)?\}/');

        $successor = new Generic();
        $successor->setReturnValue('1');
        $successor->setPattern('\d');
        $successor->setSuccessor($this->regEx);
    }

    public function testIsValid()
    {
        $pattern = '{1}';
        $valid = $this->regEx->isValid($pattern);

        $this->assertTrue($valid);
    }

    /**
     * @dataProvider regExData
     */
    public function testGetMatch($pattern)
    {
        $this->regEx->isValid($pattern);
        $match = $this->regEx->getMatch();

        $this->assertEquals($pattern, $match);
    }

    /**
     * @dataProvider regExData
     */
    public function testGeneration($pattern, $mintimes, $maxtimes)
    {
        $pattern = "\d" . $pattern;
        $this->regEx->isValid($pattern);
        $result = $this->regEx->generate();
        $resultLength = strlen($result);
        $isInRange = ($resultLength >=  $mintimes -1) && ($resultLength <  $maxtimes);

        $this->assertTrue($isInRange, sprintf('The result "%s", is not in range of "(%s,%s)"', $result, $mintimes, $maxtimes));
    }

    public function regExData()
    {
        return array(
            array('{1}', 1, 1),
            array('{1,}', 1, 1),
            array('{2,}', 2, 2),
            array('{100,}', 100, 100),
            array('{0,1}', 0, 1),
            array('{1,10}', 1, 10),
            array('{100,101}', 100, 101)
        );
    }
}