<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Test\Exception;

use PHPUnit\Framework\TestCase;
use RegRev\Exception\RegExpNotValidException;

class RegExpNotValidExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new RegExpNotValidException('');
        $this->assertEquals('The regular expression "" is not valid', $exception->getMessage(), 'A message should be generated');
    }
}