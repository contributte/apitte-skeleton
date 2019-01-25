<?php declare(strict_types = 1);

namespace App\Domain\Api\Response;

use App\Model\Database\Entity\User;
use DateTimeInterface;

final class UserResDto
{

	/** @var int */
	public $id;

	/** @var string */
	public $email;

	/** @var string */
	public $name;

	/** @var string */
	public $surname;

	/** @var string */
	public $fullname;

	/** @var DateTimeInterface|null */
	public $lastLoggedAt;

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
