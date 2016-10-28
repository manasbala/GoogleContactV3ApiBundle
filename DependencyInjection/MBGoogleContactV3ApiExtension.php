<?php

namespace MB\GoogleContactV3ApiBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class MBGoogleContactV3ApiExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('mb_google_contact_v3_api.client_id', $config['client_id']);
        $container->setParameter('mb_google_contact_v3_api.client_secret', $config['client_secret']);
        $container->setParameter('mb_google_contact_v3_api.redirect_uri', $config['redirect_uri']);
        $container->setParameter('mb_google_contact_v3_api.developer_key', $config['developer_key']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');
    }
}
