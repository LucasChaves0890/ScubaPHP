<?php

use DI\ContainerBuilder;
use League\Plates\Engine;

$builder = new ContainerBuilder();
$builder->addDefinitions([
    Engine::class => function () {
        $templatePath = __DIR__ . '/../views';
        return new Engine($templatePath);
    }
]);

/** @var \Psr\Container\ContainerInterface $container */
$container = $builder->build();

return $container;
