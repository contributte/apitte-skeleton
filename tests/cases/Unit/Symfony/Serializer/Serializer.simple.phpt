<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Tester\Assert;
use Tests\Cases\Unit\Symfony\Serializer\Mocks\Order;

require_once __DIR__ . '/../../../../bootstrap.php';

test(function (): void {
	$serializer = new Serializer(
		[new ObjectNormalizer()],
		[new JsonEncoder()]
	);

	$order = new Order(1);

	$json = $serializer->serialize($order, 'json');
	Assert::equal('{"id":1}', $json);
});
