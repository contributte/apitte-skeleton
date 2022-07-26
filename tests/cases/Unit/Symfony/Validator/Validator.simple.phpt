<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Validation;
use Tester\Assert;
use Tests\Cases\Unit\Symfony\Validator\Mocks\User;
use Tests\Cases\Unit\Symfony\Validator\Mocks\UserPojo;

require_once __DIR__ . '/../../../../bootstrap.php';

test(function (): void {
	$validator = Validation::createValidator();
	$violations = $validator->validate('Felix', [
		new Length(['min' => 10]),
		new NotBlank(),
	]);

	Assert::equal('This value is too short. It should have 10 characters or more.', $violations->get(0)->getMessage());
});

test(function (): void {
	$user = new UserPojo();
	$user->setUsername('Felix');

	$validator = Validation::createValidatorBuilder()
		->addMethodMapping('loadValidatorMetadata')
		->getValidator();

	$violations = $validator->validate($user);

	Assert::equal('This value is too short. It should have 10 characters or more.', $violations->get(0)->getMessage());
});

test(function (): void {
	$user = new User('Felix');

	$validator = Validation::createValidatorBuilder()
		->enableAnnotationMapping()
		->addDefaultDoctrineAnnotationReader()
		->getValidator();

	$violations = $validator->validate($user);

	Assert::equal('This value is too short. It should have 10 characters or more.', $violations->get(0)->getMessage());
});
