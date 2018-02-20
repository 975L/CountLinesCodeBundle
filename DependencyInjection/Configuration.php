<?php
/*
 * (c) 2017: 975L <contact@975l.com>
 * (c) 2017: Laurent Marquet <laurent.marquet@laposte.net>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace c975L\CountLinesCodeBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('c975_l_count_lines_code');

        $rootNode
            ->children()
                ->arrayNode('extensions')
                    ->prototype('scalar')->end()
                    ->defaultValue(array(
                        'php',
                    ))
                ->end()
                ->arrayNode('folders')
                    ->prototype('scalar')->end()
                    ->defaultValue(array(
                        'src',
                    ))
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
