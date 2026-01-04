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

use PHPUnit\Framework\TestCase;
use RegRev\Metacharacter\CharacterHandler;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class CharacterHandlerTest extends TestCase
{
    public function testisValid()
    {
        $charTypeTest = new class extends CharacterHandler
        {
            public function generate(){ return;}
        };
        $charTypeTest->setPattern('\d');

        $this->assertTrue($charTypeTest->isValid('\d'));
    }
}