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

## Tests

```bash
./vendor/bin/phpunit Tests/ -v --testdox
```
