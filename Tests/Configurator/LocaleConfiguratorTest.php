<?php

namespace Qbbr\LocaleConfiguratorBundle\Tests\Configurator;

use PHPUnit\Framework\TestCase;
use Qbbr\LocaleConfiguratorBundle\Configurator\LocaleConfigurator;
use Qbbr\LocaleConfiguratorBundle\Exception\NotFoundParamException;
use Symfony\Component\HttpFoundation\RequestStack;

class LocaleConfiguratorTest extends TestCase
{
    private const CONFIG_DIR = __DIR__.'/../Resources/config/locale_configurator';

    public function testEnConfig()
    {
        $lc = new LocaleConfigurator(
            self::CONFIG_DIR,
            false,
            new RequestStack()
        );

        $lc->setLocale('en');
        $this->assertFalse($lc->get('param1'));
        $this->assertSame('test str', $lc->get('param2_str'));
    }

    public function testRuConfig()
    {
        $lc = new LocaleConfigurator(
            self::CONFIG_DIR,
            false,
            new RequestStack()
        );

        $lc->setLocale('ru');
        $this->assertTrue($lc->get('param1'));
        $this->assertSame('test str', $lc->get('param2_str'));
        $this->assertSame(42, $lc->get('param3'));
    }

    public function testRaiseNotFoundParamException()
    {
        $lc = new LocaleConfigurator(
            self::CONFIG_DIR,
            true,
            new RequestStack()
        );

        $lc->setLocale('en');
        $this->expectException(NotFoundParamException::class);
        $lc->get('not_found_param');
    }
}
