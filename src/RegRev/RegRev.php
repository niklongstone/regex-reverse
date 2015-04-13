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

use RegRev\CharType;

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
        while ($regExp != '') {
            foreach (self::$expressions as $type) {
                if ($type->isValid($regExp)) {
                    self::$typesFound[] = $type;
                    $lengthOfMatch = strlen($type->getMatch());
                    $regExp = substr($regExp, $lengthOfMatch);
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

        $charType = new CharType\Unknown();
        self::$expressions->set($charType);
    }

    static private function outPut()
    {
        $result = null;
        foreach (self::$typesFound as $typeFound) {
            $result .= $typeFound->generate();
        }

        return $result;
    }
}