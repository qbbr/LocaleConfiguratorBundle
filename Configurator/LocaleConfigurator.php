<?php

declare(strict_types=1);

namespace Qbbr\LocaleConfiguratorBundle\Configurator;

use Qbbr\LocaleConfiguratorBundle\Exception\NotFoundParamException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Yaml\Yaml;

class LocaleConfigurator
{
    private const DEFAULT_CONFIG = '_default';
    private const CONFIG_EXT = 'yaml';

    private string $configDir;
    private bool $raiseNotFoundParamException;

    private string $locale;
    private RequestStack $requestStack;
    private ?array $config = null;

    public function __construct(
        string $configDir,
        bool $raiseNotFoundParamException,
        RequestStack $requestStack
    ) {
        $this->configDir = $configDir;
        $this->raiseNotFoundParamException = $raiseNotFoundParamException;
        $this->requestStack = $requestStack;
    }

    public function get(string $param)
    {
        if (null === $this->config) {
            $this->config = $this->parseConfigs();
        }

        if (isset($this->config[$param])) {
            return $this->config[$param];
        }

        if ($this->raiseNotFoundParamException) {
            throw new NotFoundParamException(sprintf('Config parameter "%s" for locale "%s" not found.', $param, $this->getLocale()));
        }

        return null;
    }

    public function has(string $param): bool
    {
        return isset($this->config[$param]);
    }

    /**
     * For set locale manuality.
     */
    public function setLocale(string $locale): self
    {
        $this->locale = $locale;

        return $this;
    }

    private function getLocale(): string
    {
        return $this->locale ?? $this->requestStack->getMainRequest()->getLocale();
    }

    private function parseConfigs(): array
    {
        return @array_merge(
            Yaml::parseFile($this->configDir.'/'.self::DEFAULT_CONFIG.'.'.self::CONFIG_EXT),
            Yaml::parseFile($this->configDir.'/'.$this->getLocale().'.'.self::CONFIG_EXT)
        );
    }
}
