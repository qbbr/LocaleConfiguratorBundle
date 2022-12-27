<?php

declare(strict_types=1);

namespace Qbbr\LocaleConfiguratorBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class LocaleConfiguratorExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        if (!$container->hasParameter('qbbr.locale_configurator.config_dir')) {
            $container->setParameter('qbbr.locale_configurator.config_dir', '%kernel.project_dir%/config/locale_configurator');
        }

        if (!$container->hasParameter('qbbr.locale_configurator.raise_not_found_param_exception')) {
            $container->setParameter('qbbr.locale_configurator.raise_not_found_param_exception', false);
        }

        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yaml');
    }
}
