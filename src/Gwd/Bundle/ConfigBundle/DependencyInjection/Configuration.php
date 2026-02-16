<?php

namespace Gwd\Bundle\ConfigBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Oro\Bundle\ConfigBundle\DependencyInjection\SettingsBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('gwd_config');
        $rootNode = $treeBuilder->getRootNode();

        SettingsBuilder::append(
            $rootNode,
            [
                'contact_page_title' => ['value' => '', 'type' => 'scalar'],
                'site_email' => ['value' => '', 'type' => 'scalar'],
                'contact_page_to_email' => ['value'=>'', 'type'=>'scalar']
            ]
        );

        return $treeBuilder;
    }
}