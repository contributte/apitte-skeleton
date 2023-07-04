<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Constraint\Mocks;

use Tests\Cases\Unit\Symfony\Validator\Constraint as NewAssert;

class Foo
{

	/** @NewAssert\Hello */
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
