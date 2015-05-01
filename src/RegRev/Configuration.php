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
            //digit
            array(
                'type' => 'CharType\\CharType',
                'chars' => '0123456789',
                'pattern' => array('\d')
            ),
            //non digit
            array(
                'type' => 'CharType\\CharType',
                'chars' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                'pattern' => array('\D')
            ),
            //alphanumeric
            array(
                'type' => 'CharType\\CharType',
                'chars' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXY',
                'pattern' => array('\w','\S','.')
            ),
            //non alphanumeric
            array(
                'type' => 'CharType\\CharType',
                'chars' => './\\()"\':,.;<>~!@#$%^&*|+=[]{}`~?-',
                'pattern' => array('\W')
            ),
            //subpattern
            array(
                'type' => 'GroupType\Subpattern',
                'pattern' => array('/^(\(((?>[^()]+)|(?-2))*\))/')
            ),
            //range
            array(
                'type' => 'Range\Range',
                'pattern' => array('/^\[[^\]]*\]/')
            ),
            //zero or more
            array(
                'type' => 'Quantifier\ZeroOrMore',
                'pattern' => array('*')
            ),
            //one or more
            array(
                'type' => 'Quantifier\OneOrMore',
                'pattern' => array('+')
            ),
            //zero or one
            array(
                'type' => 'Quantifier\ZeroOrOne',
                'pattern' => array('?')
            ),
            //n times
            array(
                'type' => 'Quantifier\NTimes',
                'pattern' => array('/^\{(\d*),?(\d*)?\}/')
            ),
            //blank space
            array(
                'type' => 'CharType\Generic',
                'pattern' => array('\h','\s'),
                'returnValue' => ' '
            ),
            //escaped dot
            array(
                'type' => 'CharType\Generic',
                'pattern' => array('\.'),
                'returnValue' => '.'
            ),
            //left round bracket
            array(
                'type' => 'CharType\Generic',
                'pattern' => array('\('),
                'returnValue' => '('
            ),
            //right round bracket
            array(
                'type' => 'CharType\Generic',
                'pattern' => array('\)'),
                'returnValue' => ')'
            ),
            //escaped slash
            array(
                'type' => 'CharType\Generic',
                'pattern' => array('\/'),
                'returnValue' => '/'
            ),
            //unknown charachter
            array(
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
