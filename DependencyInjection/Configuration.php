<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzSupportToolsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Symfony extension configuration definition for ezplatform_support_tools extension.
 *
 * @internal
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ezplatform_support_tools');

        $rootNode
            ->children()
                ->arrayNode('system_info')
                    ->info('System info configuration, provided by "ez-support-tools" package')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('powered_by')
                            ->info('Control if system should generate a powered by header to promote eZ Platform usage')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('enabled')
                                    ->info('Activate/Deactivate powered by header')
                                    ->defaultValue(true)
                                ->end()
                                ->enumNode('release')
                                    ->info('Sets how much of version info is exposed in powered by. Examples:  minor: "2.5", major: "2", none: ""')
                                    ->values(['major', 'minor', 'none'])
                                    ->defaultValue('minor')
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
