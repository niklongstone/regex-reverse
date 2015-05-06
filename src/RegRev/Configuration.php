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
class Configuration
{
    private $config;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->config = array(
            array(
                'name' => 'Digit',
                'type' => 'CharType\\CharType',
                'chars' => '0123456789',
                'pattern' => array('\d')
            ),
            array(
                'name' => 'Non Digit',
                'type' => 'CharType\\CharType',
                'chars' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'pattern' => array('\D')
            ),
            array(
                'name' => 'Alphanumeric',
                'type' => 'CharType\\CharType',
                'chars' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY',
                'pattern' => array('\w','\S','.')
            ),
            array(
                'name' => 'Non Alphanumeric',
                'type' => 'CharType\\CharType',
                'chars' => './\\()"\':,.;<>~!@#$%^&*|+=[]{}`~?-',
                'pattern' => array('\W')
            ),
            array(
                'name' => 'Subpattern',
                'type' => 'GroupType\Subpattern',
                'pattern' => array('/^(\(((?>[^()]+)|(?-2))*\))/')
            ),
            array(
                'name' => 'Range',
                'type' => 'Range\Range',
                'pattern' => array('/^\[[^\]]*\]/')
            ),
            array(
                'type' => 'Quantifier\ZeroOrMore',
                'pattern' => array('*')
            ),
            array(
                'type' => 'Quantifier\OneOrMore',
                'pattern' => array('+')
            ),
            array(
                'type' => 'Quantifier\ZeroOrOne',
                'pattern' => array('?')
            ),
            array(
                'type' => 'Quantifier\NTimes',
                'pattern' => array('/^\{(\d*),?(\d*)?\}/')
            ),
            array(
                'name' => 'Blank space',
                'type' => 'CharType\Generic',
                'pattern' => array('\h','\s'),
                'returnValue' => ' '
            ),
            array(
                'name' => 'Escaped dot',
                'type' => 'CharType\Generic',
                'pattern' => array('\.'),
                'returnValue' => '.'
            ),
            array(
                'name' => 'Left Round bracket (',
                'type' => 'CharType\Generic',
                'pattern' => array('\('),
                'returnValue' => '('
            ),
            array(
                'name' => 'Right Round bracket )',
                'type' => 'CharType\Generic',
                'pattern' => array('\)'),
                'returnValue' => ')'
            ),
            array(
                'name' => 'Escaped Slash',
                'type' => 'CharType\Generic',
                'pattern' => array('\/'),
                'returnValue' => '/'
            ),
            array(
                'name' => 'Character Unknown',
                'type' => 'CharType\Unknown',
            ),
        );
    }

    /**
     * Gets the configuration.
     *
     * @return array
     */
    public function getConfig()
    {
       return $this->config;
    }

    /**
     * Sets the configuration.
     *
     * @param $config
     */
    public function setConfig(array $config)
    {
        $this->config = $config;
    }

    /**
     * Setup the configuration.
     */
    public function setUp($parameters)
    {
        $expressions = new ExpressionContainer();
        foreach ($parameters as $param) {
            $charType = $this->buildCharType($param);
            $expressions->set($charType);
        }

        return $expressions;
    }

    private function buildCharType($param)
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