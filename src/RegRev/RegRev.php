<?php
/**
 * This file is part of the RegexReverse package.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace RegRev;

use RegRev\Metacharacter\CharType;

/**
 * Class RevReg
 *
 * @package RevReg
 */
class RegRev
{
    private static $typesFound = array();
    private static $expressions;

    /**
     * @param string $regExp
     *
     * @return null|string
     */
    static public function generate($regExp)
    {
        self::setUp();
        self::$typesFound = array();
        while (strlen($regExp) > 0) {
            foreach (self::$expressions as $type) {
                if ($type->isValid($regExp)) {
                    self::$typesFound[] = $type;
                    $lengthOfMatch = strlen($type->getMatch());
                    $regExp = substr($regExp, $lengthOfMatch);
                    echo get_class($type) . ' | ' . $regExp . ' >' . $lengthOfMatch . ' countRegex:' . strlen($regExp); echo PHP_EOL;
                    break;
                }
            }
        }

        return self::outPut();
    }

    static private function setUp()
    {
        self::$expressions = new ExpressionContainer();

        $charType = new CharType\Digit();
        $charType->setChar('\d');
        self::$expressions->set($charType);

        $charType = new CharType\Alpha();
        $charType->setChar('\D');
        self::$expressions->set($charType);

        $charType = new CharType\Blank();
        $charType->setChar('\h');
        $charType->setChar('\s');
        self::$expressions->set($charType);

        $charType = new CharType\Alnum();
        $charType->setChar('\w');
        $charType->setChar('\S');
        self::$expressions->set($charType);

        $charType = new CharType\NonAlnum();
        $charType->setChar('\W');
        self::$expressions->set($charType);

        $charType = new Metacharacter\GroupType\Subpattern();
        $charType->setChar('/\(.*\)/');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Conditional\ZeroOrMore();
        $charType->setChar('*');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Conditional\OneOrMore();
        $charType->setChar('+');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Conditional\ZeroOrOne();
        $charType->setChar('?');
        self::$expressions->set($charType);

        $charType = new CharType\Unknown();
        self::$expressions->set($charType);
    }

    static private function outPut()
    {
        $typeFound = self::$typesFound[0];
        for ($i = 0; $i < count(self::$typesFound) -1; $i++) {
            self::$typesFound[$i]->setSuccessor(self::$typesFound[$i+1]);
        }

        return $typeFound->getResult();
    }
}