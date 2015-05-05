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
}