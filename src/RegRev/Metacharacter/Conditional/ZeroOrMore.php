<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter\Conditional;

use RegRev\Metacharacter\CharacterHandler;

/**
 * Class Number
 *
 * @package RevReg\Char
 */
class ZeroOrMore extends CharacterHandler
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $quantity = rand(0, 10);

        $result = null;
        for($i = 0; $i < $quantity; $i ++) {
            if ($this->getPrevious()) {
                get_class($this->getPrevious());
                $result .= $this->getPrevious()->generate();
            }
        }

        return $result;
    }
}