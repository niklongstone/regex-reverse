<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev\Metacharacter\Range;

use RegRev\Metacharacter\CharacterHandler;

/**
 * Class Range,
 * handles the range match.
 */
class Range extends CharacterHandler
{
    /**
     * {@inheritdoc}
     */
    public function isValid($string)
    {
            foreach ($this->getPatterns() as $pattern) {
            if (preg_match($pattern, $string, $match)) {
                $this->setMatch($match[0]);

                return true;
            }
        }

        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function generate()
    {
        $match = substr($this->getMatch(), 1, -1);
        $resultRange = '';
        $matchLength = strlen($match);
        for ($i = 0; $i < $matchLength; $i++) {
            if ($match[$i] != '-') {
                $resultRange.= $match[$i];
            } else {
                $rangeStart = $match[$i-1];
                $resultRange = substr($resultRange, 0, -1);
                $rangeEnd = $match[$i+1];
                $resultRange.= $this->createRange($rangeStart, $rangeEnd);
                $i++;
            }
        }
        $randomIndex = rand(0, strlen($resultRange) -1);

        return $resultRange[$randomIndex];
    }

    private function createRange($rangeStart, $rangeEnd)
    {
        return implode('', range($rangeStart, $rangeEnd));
    }
}