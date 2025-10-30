<?php

namespace MrcMorales\MetaPixelApiBundle\DependencyInjection;

use MrcMorales\MetaPixelApiBundle\Service\MetaPixelInterface;
use MrcMorales\MetaPixelApiBundle\Service\MetaPixelManager;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class MetaPixelApiExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yaml');

        $definition = $container->register(MetaPixelManager::class, MetaPixelManager::class);
        $definition
            ->setArguments([
                $config['pixel_id'],
                $config['access_token'],
                new Reference('messenger.default_bus', ContainerBuilder::IGNORE_ON_INVALID_REFERENCE),
                new Reference('monolog.logger.meta_pixel', ContainerBuilder::IGNORE_ON_INVALID_REFERENCE),
            ])
            ->setPublic(false);

        $container->setAlias(MetaPixelInterface::class, MetaPixelManager::class)
            ->setPublic(true);
    }
}