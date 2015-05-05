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
        self::bootstrap();
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
     * Configures with default values,
     * if custom values are not present.
     */
    static private function bootstrap()
    {
        if (self::$expressions === null) {
            $configuration = new Configuration();
            $parameters = $configuration->getConfig();
            self::$expressions = $configuration->setUp($parameters);
        }
    }

    /**
     * SetUp a custom configuration
     *
     * @param array $parameters
     */
    static public function setUp($parameters)
    {
        $configuration = new Configuration();
        self::$expressions = $configuration->setUp($parameters);
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
}