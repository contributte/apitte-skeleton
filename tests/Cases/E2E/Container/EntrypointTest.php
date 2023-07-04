<?php declare(strict_types = 1);

namespace Tests\Cases\E2E\Container;

use App\Bootstrap;
use Contributte\Middlewares\Application\IApplication as ApiApplication;
use Contributte\Utils\FileSystem;
use Nette\DI\Container;
use Symfony\Component\Console\Application as ConsoleApplication;
use Tester\Assert;
use Tester\TestCase;
use Tests\Toolkit\Tests;

require_once __DIR__ . '/../../../bootstrap.php';

final class EntrypointTest extends TestCase
{

	public function setUp(): void
	{
		parent::setUp();

		if (!file_exists(Tests::ROOT_PATH . '/config/local.neon')) {
			FileSystem::copy(
				Tests::ROOT_PATH . '/config/local.neon.example',
				Tests::ROOT_PATH . '/config/local.neon'
			);
		}
	}

	public function testApi(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$container->getByType(ApiApplication::class);

		Assert::type(Container::class, $container);
	}

	public function testCli(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$container->getByType(ConsoleApplication::class);

		Assert::type(Container::class, $container);
	}

	public function testTest(): void
	{
		$container = Bootstrap::boot()->createContainer();
		$container->getByType(Container::class);

		Assert::type(Container::class, $container);
	}

}

(new EntrypointTest())->run();
