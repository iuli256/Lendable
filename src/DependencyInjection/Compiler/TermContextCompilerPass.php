<?php

declare(strict_types=1);

namespace App\DependencyInjection\Compiler;

use App\Service\Strategy\TermContext;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class TermContextCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $service = $container->findDefinition(TermContext::class);

        $strategyServiceIds = array_keys($container->findTaggedServiceIds('strategy_term'));

        foreach ($strategyServiceIds as $strategyServiceId) {
            $service->addMethodCall('addStrategy', [new Reference($strategyServiceId)]);
        }
    }
}