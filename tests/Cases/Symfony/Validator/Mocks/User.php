<?php declare(strict_types = 1);

namespace Tests\Cases\Symfony\Validator\Mocks;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class User
{

	#[NotBlank]
	#[Length(min: 10, max: 20)]
	private string $username;

	public function __construct(string $username)
	{
		$this->username = $username;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

}
