# Regex reverse

[![Latest Version](https://img.shields.io/github/release/niklongstone/regex-reverse.svg?style=flat-square)](https://github.com/niklongstone/regex-reverse/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/niklongstone/regex-reverse/master.svg?style=flat-square)](https://travis-ci.org/niklongstone/regex-reverse)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/niklongstone/regex-reverse.svg?style=flat-square)](https://scrutinizer-ci.com/g/niklongstone/regex-reverse/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/niklongstone/regex-reverse.svg?style=flat-square)](https://scrutinizer-ci.com/g/niklongstone/regex-reverse)


Regular expression reverter, given a regular expression will output a string that will match it

## Install

Via Composer

``` bash
$ composer require niklongstone/regex-reverse
```

## Usage

``` php
require ('regex-reverse/vendor/autoload.php');
use RegRev\RegRev;

echo RegRev::generate('\d'); //ouput a random number
```

## Supported expressions

| Expression | Description | Result                  |
|------------|-------------|-------------------------|
|    \d      |    digit    |      a number           |
|    \D      |  non digit  |    an alpha char        |
|    \w      |    word     | a alphanumeric char     |
|    \W      |    word     | a non alphanumeric char |
|    \s      |    space    |    a blank space        |
|    \S      |    space    |    a non blank space    |

## Conditional and subgroup
| Expression | Description    | Example   |  Result     |
|------------|----------------|-----------|-------------|
|    ()      |  subgroup      | (\d\w)+@  | 97a987Ss@   |
|    *       |  zero or more  |   \d*     |  123502     |
|    +       |  one or more   |   \d+     |   32133     |
|    ?       |  zero or one   |   \d?     |     3       |

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Nicola Pietroluongo](https://github.com/niklongstone)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
