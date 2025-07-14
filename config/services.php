<?php

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function(ContainerConfigurator $configurator) {
    $services = $configurator->services()
        ->defaults()
            ->autowire()
            ->autoconfigure()
    ;

    $services->set(CartServices::class)
        // redundant thanks to defaults, but value is overridable on each service
        ->autowire();

    $services->set(OrderService::class)
    // redundant thanks to defaults, but value is overridable on each service
        ->autowire();

    
};