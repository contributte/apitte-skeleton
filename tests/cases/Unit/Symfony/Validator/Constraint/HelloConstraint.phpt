<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Constraint;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Symfony\Component\Validator\Validation;
use Tester\Assert;
use Tests\Cases\Unit\Symfony\Validator\Constraint\Mocks\Foo;

require_once __DIR__ . '/../../../../../bootstrap.php';

AnnotationRegistry::registerUniqueLoader('class_exists');

test(function (): void {
	$foo = new Foo('Felix');

	$validator = Validation::createValidatorBuilder()
		->enableAnnotationMapping()
		->getValidator();

	$violations = $validator->validate($foo);

	Assert::equal('The string Felix is not hello word!', $violations->get(0)->getMessage());
});
