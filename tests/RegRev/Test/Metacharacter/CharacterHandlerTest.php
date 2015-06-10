<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\Metacharacter;

use RegRev\Metacharacter\CharacterHandler;

class TestCharacterHandler extends CharacterHandler
{
    public function generate(){ return;}
}

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class CharacterHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testisValid()
    {
        $charTypeTest = new TestCharacterHandler();
        $charTypeTest->setPattern('\d');

        $this->assertTrue($charTypeTest->isValid('\d'));
    }
}