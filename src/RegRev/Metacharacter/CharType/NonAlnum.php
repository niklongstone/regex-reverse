<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter\CharType;

use RegRev\Metacharacter\CharacterHandler;

/**
 * Class NonAlnum,
 * handles non alphanumeric characters.
 */
class NonAlnum extends CharacterHandler
{
    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $characters = "./\\()\"':,.;<>~!@#$%^&*|+=[]{}`~?-";
        $randomIndex = rand(0, strlen($characters) -1);

        return $characters[$randomIndex];
    }
}


