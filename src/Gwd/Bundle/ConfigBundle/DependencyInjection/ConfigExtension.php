<?php

namespace Gwd\Bundle\ConfigBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;

class ConfigExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration(new Configuration(), $configs);

        $container->prependExtensionConfig($this->getAlias(), SettingsBuilder::getSettings($config));
    }

    public function getAlias(): string
    {
        return 'gwd_config';
    }
}