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

    /**
     * Setup the configuration.
     */
    static private function setUp()
    {
        self::$expressions = new ExpressionContainer();
        $configuration = new Configuration();
        $parameters = $configuration->getConfig();
        foreach ($parameters as $param) {
            $charType = self::buildCharType($param);
            self::$expressions->set($charType);
        }
    }

    static private function outPut()
    {
        $typeFound = self::$typesFound[0];
        for ($i = 0; $i < count(self::$typesFound) -1; $i++) {
            self::$typesFound[$i]->setSuccessor(self::$typesFound[$i+1]);
        }

        return $typeFound->getResult();
    }

    static private function buildCharType($param)
    {
        $charTypeClass = 'RegRev\\Metacharacter\\' .  $param['type'];
        $charType = new $charTypeClass;
        if (array_key_exists('chars', $param)) {
            $charType->setChars($param['chars']);
        }
        if (array_key_exists('pattern', $param)) {
            foreach ($param['pattern'] as $pat) {
                $charType->setPattern($pat);
            }
        }
        if (array_key_exists('returnValue', $param)) {
            $charType->setReturnValue($param['returnValue']);
        }

        return $charType;
    }
}