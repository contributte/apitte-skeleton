<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Serializer;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\Serializer\NameConverter\MetadataAwareNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Tester\Assert;
use Tests\Cases\Unit\Symfony\Serializer\Mocks\Order;
use Tests\Cases\Unit\Symfony\Serializer\Mocks\SuperUser;
use Tests\Cases\Unit\Symfony\Serializer\Mocks\User;

require_once __DIR__ . '/../../../../bootstrap.php';

AnnotationRegistry::registerUniqueLoader('class_exists');

test(function (): void {
	$serializer = new Serializer(
		[new PropertyNormalizer()],
		[new JsonEncoder()]
	);

	$order = new Order(1);

	$json = $serializer->serialize($order, 'json');
	Assert::equal('{"id":1}', $json);

	/** @var Order $obj */
	$obj = $serializer->deserialize($json, Order::class, 'json');
	Assert::equal($order->getId(), $obj->getId());
});

test(function (): void {
	$serializer = new Serializer(
		[new PropertyNormalizer()],
		[new JsonEncoder()]
	);

	$user = new User();
	$user->addOrder(new Order(1));
	$user->addOrder(new Order(2));

	$json = $serializer->serialize($user, 'json');
	Assert::equal('{"orders":[{"id":1},{"id":2}]}', $json);

	/** @var User $obj */
	$obj = $serializer->deserialize($json, User::class, 'json');
	Assert::equal(count($user->getOrders()), count($obj->getOrders()));
});

test(function (): void {
	$classMetadataFactory = new ClassMetadataFactory(new AnnotationLoader(new AnnotationReader()));
	$metadataAwareNameConverter = new MetadataAwareNameConverter($classMetadataFactory);

	$serializer = new Serializer(
		[new ObjectNormalizer($classMetadataFactory, $metadataAwareNameConverter, null, new ReflectionExtractor())],
		[new JsonEncoder()]
	);

	$user = new SuperUser();
	$user->addUserOrder(new Order(1));
	$user->addUserOrder(new Order(2));

	$user->addAdminOrder(new Order(99));

	$json = $serializer->serialize($user, 'json');
	Assert::equal('{"orders1":[{"id":1},{"id":2}],"orders2":[{"id":99}]}', $json);

	$json = $serializer->serialize($user, 'json', ['groups' => 'user']);
	Assert::equal('{"orders1":[{"id":1},{"id":2}]}', $json);

	$json = $serializer->serialize($user, 'json', ['groups' => 'admin']);
	Assert::equal('{"orders2":[{"id":99}]}', $json);

	$json = $serializer->serialize($user, 'json', ['groups' => 'fake']);
	Assert::equal('[]', $json);
});
