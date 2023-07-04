<?php declare(strict_types = 1);

namespace App\Domain\Api\Response;

use App\Domain\User\User;
use DateTimeInterface;

final class UserResDto
{

	public int $id;

	public string $email;

	public string $name;

	public string $surname;

	public string $fullname;

	public ?DateTimeInterface $lastLoggedAt = null;

	public static function from(User $user): self
	{
		$self = new self();
		$self->id = $user->getId();
		$self->email = $user->getEmail();
		$self->name = $user->getName();
		$self->surname = $user->getSurname();
		$self->fullname = $user->getFullname();
		$self->lastLoggedAt = $user->getLastLoggedAt();

		return $self;
	}

}
