<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Constraint;

use Contributte\Tester\Toolkit;
use Symfony\Component\Validator\Validation;
use Tester\Assert;
use Tests\Cases\Unit\Symfony\Validator\Constraint\Mocks\Foo;

require_once __DIR__ . '/../../../../../bootstrap.php';

Toolkit::test(function (): void {
	$foo = new Foo('Felix');

	$validator = Validation::createValidatorBuilder()
		->enableAnnotationMapping()
		->addDefaultDoctrineAnnotationReader()
		->getValidator();

	$violations = $validator->validate($foo);

	Assert::equal('The string Felix is not hello word!', $violations->get(0)->getMessage());
});
