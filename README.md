# Common Types for  Doctrine

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE)

Provides Doctrine types for "mediagone/common-types" package.


## Installation
This package requires **PHP 7.4+** and Doctrine **DBAL 2.7+**

Add it as Composer dependency:
```sh
$ composer require mediagone/common-types-doctrine
```

### With Symfony
If you're using this package in a Symfony project, register utilized custom types in `doctrine.yaml`:
```yaml
doctrine:
    dbal:
        types:
            app_slug: Mediagone\Doctrine\Common\Types\Text\SlugType
            ...
```
_Note: `app_slug` being the type name you'll use in your Entity mappings, you can pick whatever name you wish._


### As standalone
Custom types can also be used separately, but need to be registered in Doctrine DBAL like this:
```php
use Doctrine\DBAL\Types\Type;
use Mediagone\Doctrine\Common\Types\Text\SlugType;

Type::addType(SlugType::NAME, SlugType::class);
// or, with a custom name:
Type::addType('app_slug', SlugType::class);
```



## License

_Common Types for Doctrine_ is licensed under MIT license. See LICENSE file.



[ico-version]: https://img.shields.io/packagist/v/mediagone/common-types-doctrine.svg
[ico-downloads]: https://img.shields.io/packagist/dt/mediagone/common-types-doctrine.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg

[link-packagist]: https://packagist.org/packages/mediagone/common-types-doctrine
[link-downloads]: https://packagist.org/packages/mediagone/common-types-doctrine
