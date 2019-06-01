Stringy
==

PHP Stringy object with consistent and predictable API

[![Build Status](https://travis-ci.org/wernerdweight/Stringy.svg?branch=master)](https://travis-ci.org/wernerdweight/Stringy)
[![Latest Stable Version](https://poser.pugx.org/wernerdweight/stringy/v/stable)](https://packagist.org/packages/wernerdweight/stringy)
[![Total Downloads](https://poser.pugx.org/wernerdweight/stringy/downloads)](https://packagist.org/packages/wernerdweight/stringy)
[![License](https://poser.pugx.org/wernerdweight/stringy/license)](https://packagist.org/packages/wernerdweight/stringy)

Instalation
--

1) Download using composer

```bash
composer require wernerdweight/stringy
```

2) Use in your project

```php
use WernerDweight\Stringy\Stringy;

$stringy = new Stringy('This is a string');
echo $string
    ->toLower()    // this is a string
    ->replace(' ', '-')    // this-is-a-string
    ->convertCase(Stringy::KEBAB, Stringy::PASCAL)   // ThisIsAString
    ->reverse();    // gnirtSAsIsihT
```

API
--

TODO:
