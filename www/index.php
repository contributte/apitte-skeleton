<?php declare(strict_types = 1);

require __DIR__ . '/../vendor/autoload.php';

// Let bootstrap create Dependency Injection container.
$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();

// Run application.
$container->getByType(Contributte\Middlewares\Application\IApplication::class)->run();
