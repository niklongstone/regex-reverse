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
                    self::$typesFound[] = clone $type;
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

        $charType = new CharType\CharType();
        $charType->setChars('0123456789');
        $charType->setPattern('\d');
        self::$expressions->set($charType);

        //alpha chars
        $charType = new CharType\CharType();
        $charType->setChars('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $charType->setPattern('\D');
        self::$expressions->set($charType);

        //alphanumeric chars
        $charType = new CharType\CharType();
        $charType->setChars('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');
        $charType->setPattern('\w');
        $charType->setPattern('\S');
        $charType->setPattern('.');
        self::$expressions->set($charType);

        //non alphanumeric chars
        $charType = new CharType\CharType();
        $charType->setChars("./\\()\"':,.;<>~!@#$%^&*|+=[]{}`~?-");
        $charType->setPattern('\W');
        self::$expressions->set($charType);

        $charType = new Metacharacter\GroupType\Subpattern();
        $charType->setPattern('/^\(.*\)/');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Quantifier\ZeroOrMore();
        $charType->setPattern('*');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Quantifier\OneOrMore();
        $charType->setPattern('+');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Quantifier\ZeroOrOne();
        $charType->setPattern('?');
        self::$expressions->set($charType);

        $charType = new Metacharacter\Quantifier\NTimes();
        $charType->setPattern('/^\{(\d*),?(\d*)?\}/');
        self::$expressions->set($charType);

        //blank space
        $charType = new CharType\Generic();
        $charType->setPattern('\h');
        $charType->setPattern('\s');
        $charType->setReturnValue(' ');
        self::$expressions->set($charType);

        //escaped dot
        $charType = new CharType\Generic();
        $charType->setPattern('\.');
        $charType->setReturnValue('.');
        self::$expressions->set($charType);

        //left round bracket
        $charType = new CharType\Generic();
        $charType->setPattern('\(');
        $charType->setReturnValue('(');
        self::$expressions->set($charType);

        //right round bracket
        $charType = new CharType\Generic();
        $charType->setPattern('\)');
        $charType->setReturnValue(')');
        self::$expressions->set($charType);

        //slash
        $charType = new CharType\Generic();
        $charType->setPattern('\/');
        $charType->setReturnValue('/');
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