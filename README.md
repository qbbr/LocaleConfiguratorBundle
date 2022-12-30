# LocaleConfiguratorBundle

Simple configuration on locale.

[![Tests](https://github.com/qbbr/LocaleConfiguratorBundle/workflows/Tests/badge.svg)](https://github.com/qbbr/LocaleConfiguratorBundle/actions)
[![Latest Stable Version](https://poser.pugx.org/qbbr/locale-configurator-bundle/v/stable)](https://packagist.org/packages/qbbr/locale-configurator-bundle)
[![Total Downloads](https://poser.pugx.org/qbbr/locale-configurator-bundle/downloads)](https://packagist.org/packages/qbbr/locale-configurator-bundle)
[![License](https://poser.pugx.org/qbbr/locale-configurator-bundle/license)](https://packagist.org/packages/qbbr/locale-configurator-bundle)
[![PHP Version Require](http://poser.pugx.org/qbbr/locale-configurator-bundle/require/php)](https://packagist.org/packages/qbbr/locale-configurator-bundle)

## Installation

### Step 1: Download the Bundle

```bash
composer require qbbr/locale-configurator-bundle
```

### Step 2: Enable the Bundle

```php
// config/bundles.php

return [
    // ...
    Qbbr\LocaleConfiguratorBundle\LocaleConfiguratorBundle::class => ['all' => true],
];
```

## Configuration

#### Config structure

```
config/locale_configurator/
├── _default.yaml
├── en.yaml
├── ru.yaml
└── ...
```

logic: `config = merge(_default.yaml, locale.yaml)`

#### Parameters by default

u can override it.

```yaml
parameters:
    qbbr.locale_configurator.config_dir: '%kernel.project_dir%/config/locale_configurator'
    qbbr.locale_configurator.raise_not_found_param_exception: false
```

## Usage

### PHP

```php
use Qbbr\LocaleConfiguratorBundle\Configurator\LocaleConfigurator;

class SomeService
{
    private LocaleConfigurator $lc;

    public function __construct(
        LocaleConfigurator $lc
    ) {
        $this->lc = $lc;
    }

    public function something()
    {
        // $this->lc->setLocale('ru');
        $param1 = $this->lc->get('param1');
    }
}
```

### Twig

has `lc_has`/`lc_get` fn.

```jinja
{% if lc_has('param1') %}
    ...
{% endif %}

{% set param1 = lc_get('param1') %}
```

## Tests

```bash
./vendor/bin/phpunit Tests/ -v --testdox
```
