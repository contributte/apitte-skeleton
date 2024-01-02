<?php declare(strict_types = 1);

namespace Tests\Cases\Symfony\Validator\Constraint\Mocks;

use Tests\Cases\Symfony\Validator\Constraint\Hello;

class Foo
{

	#[Hello]
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
