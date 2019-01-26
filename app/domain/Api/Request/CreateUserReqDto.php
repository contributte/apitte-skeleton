<?php declare(strict_types = 1);

namespace App\Domain\Api\Request;

use Symfony\Component\Validator\Constraints as Assert;

final class CreateUserReqDto
{

	/**
	 * @var string
	 * @Assert\NotBlank
	 * @Assert\Email
	 */
	public $email;

	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	public $name;

	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	public $surname;

	/**
	 * @var string
	 * @Assert\NotBlank
	 */
	public $username;

	/** @var string|null */
	public $password;

}
