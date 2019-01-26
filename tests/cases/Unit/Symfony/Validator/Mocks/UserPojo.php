<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Mocks;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class UserPojo
{

	/** @var string */
	private $username;

	public function getUsername(): string
	{
		return $this->username;
	}

	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	public static function loadValidatorMetadata(ClassMetadata $metadata): void
	{
		$metadata->addPropertyConstraint('username', new NotBlank());
		$metadata->addPropertyConstraint('username', new Length(['min' => 10, 'max' => 20]));
	}

}
