<?php declare(strict_types = 1);

namespace Tests\Cases\E2E\Database;

use App\Domain\User\User;
use Contributte\Tester\Toolkit;
use DateTime;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\Tools\SchemaTool;
use Tester\Assert;
use Tests\Toolkit\Tests;

require_once __DIR__ . '/../../../bootstrap.php';

// Datetime columns are hydrated by Doctrine as native \DateTime (#248)
Toolkit::test(function (): void {
	$config = ORMSetup::createAttributeMetadataConfig([Tests::APP_PATH . '/Domain'], true);
	$config->enableNativeLazyObjects(true);

	$connection = DriverManager::getConnection(['driver' => 'pdo_sqlite', 'memory' => true], $config);
	$em = new EntityManager($connection, $config);

	$schemaTool = new SchemaTool($em);
	$schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());

	$user = new User('John', 'Doe', 'john@doe.test', 'john', 'hash');
	$user->changeLoggedAt();
	$em->persist($user);
	$em->flush();
	$em->clear();

	$user = $em->find(User::class, $user->getId());

	assert($user instanceof User);

	Assert::type(DateTime::class, $user->getLastLoggedAt());
	Assert::type(DateTime::class, $user->getCreatedAt());
	Assert::null($user->getUpdatedAt());
});
