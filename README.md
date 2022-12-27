# LocaleConfiguratorBundle

Simple configuration on locale.

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

## Usage

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

## Configuration

parameters by default, u can overide it:

```yaml
parameters:
    qbbr.locale_configurator.config_dir: '%kernel.project_dir%/config/locale_configurator'
    qbbr.locale_configurator.raise_not_found_param_exception: false
```

## Tests

```bash
./vendor/bin/phpunit Tests/ -v --testdox
```
