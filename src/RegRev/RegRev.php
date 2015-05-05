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
use RegRev\Exception\RegExpNotValidException;

/**
 * Class RevReg
 */
class RegRev
{
    private static $typesFound = array();
    private static $expressions;

    /**
     * Generates the regular expression result.
     *
     * @param $regExp
     *
     * @return mixed
     * @throws Exception\RegExpNotValidException
     */
    static public function generate($regExp)
    {
        if (@preg_match('/'.$regExp.'/', '') === false) {
            throw new RegExpNotValidException($regExp);
        }
        self::setUp();
        self::$typesFound = array();
        while (strlen($regExp) > 0) {
            foreach (self::$expressions as $type) {
                if ($type->isValid($regExp)) {
                    Debug::setMessage($type->getName() . ' ' . $type->getMatch());
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
        $totalTypesFound = count(self::$typesFound) -1;
        for ($i = 0; $i < $totalTypesFound; $i++) {
            self::$typesFound[$i]->setSuccessor(self::$typesFound[$i+1]);
        }

        return $typeFound->getResult();
    }

    /**
     * Returns the classes name,
     * used for debug.
     *
     * @return array
     */
    static public function debug()
    {
        return Debug::getMessages();
    }

    static private function buildCharType($param)
    {
        $charTypeClass = 'RegRev\\Metacharacter\\' .  $param['type'];
        $charType = new $charTypeClass;
        self::paramSetBuilder($charType, 'chars', $param);
        self::paramSetBuilder($charType, 'returnValue', $param);
        self::paramSetBuilder($charType, 'name', $param);
        if (array_key_exists('pattern', $param)) {
            foreach ($param['pattern'] as $pat) {
                $charType->setPattern($pat);
            }
        }

        return $charType;
    }

    static private function paramSetBuilder($type, $key, $params)
    {
        if (array_key_exists($key, $params)) {
            $setter = 'set' .  ucfirst($key);
            $type->$setter($params[$key]);
        }

    }
}
