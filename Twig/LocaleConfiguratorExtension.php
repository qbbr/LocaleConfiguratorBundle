<?php

namespace Qbbr\LocaleConfiguratorBundle\Twig;

use Qbbr\LocaleConfiguratorBundle\Configurator\LocaleConfigurator;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class LocaleConfiguratorExtension extends AbstractExtension
{
    private LocaleConfigurator $lc;

    public function __construct(
        LocaleConfigurator $lc
    ) {
        $this->lc = $lc;
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('lc_get', [$this, 'get']),
            new TwigFunction('lc_has', [$this, 'has']),
        ];
    }

    public function get(string $param)
    {
        return $this->lc->get($param);
    }

    public function has(string $param): bool
    {
        return $this->lc->has($param);
    }
}
