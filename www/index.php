<?php declare(strict_types = 1);

// Uncomment this line if you must temporarily take down your site for maintenance.
//require 'maintenance.php';
//die();

require __DIR__ . '/../vendor/autoload.php';

// Let bootstrap create Dependency Injection container.
$configurator = App\Bootstrap::boot();
$container = $configurator->createContainer();

// Run application.
$container->getByType(Contributte\Middlewares\Application\IApplication::class)->run();
