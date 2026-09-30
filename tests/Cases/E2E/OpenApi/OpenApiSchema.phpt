<?php declare(strict_types = 1);

use Apitte\OpenApi\ISchemaBuilder;
use App\Bootstrap;
use Contributte\Tester\Toolkit;
use Contributte\Utils\FileSystem;
use Tester\Assert;
use Tests\Toolkit\Tests;

require_once __DIR__ . '/../../../bootstrap.php';

// Every operation must declare at least one response (OpenAPI 3.0 requires a non-empty responses object)
Toolkit::test(function (): void {
	if (!file_exists(Tests::ROOT_PATH . '/config/local.neon')) {
		FileSystem::copy(
			Tests::ROOT_PATH . '/config/local.neon.example',
			Tests::ROOT_PATH . '/config/local.neon'
		);
	}

	$container = Bootstrap::boot()->createContainer();
	$schema = $container->getByType(ISchemaBuilder::class)->build()->toArray();

	Assert::notSame([], $schema['paths']);

	foreach ($schema['paths'] as $path => $operations) {
		foreach ($operations as $method => $operation) {
			Assert::notSame([], $operation['responses'], sprintf('%s %s has no responses', $method, $path));
			Assert::match('{%A%}', (string) json_encode($operation['responses']));
		}
	}
});
