<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Serializer\Mocks;

use Symfony\Component\Serializer\Annotation\Groups;

class Order
{

	/**
	 * @var int
	 * @Groups({"admin", "user"})
	 */
	private $id;

	public function __construct(int $id)
	{
		$this->id = $id;
	}

	public function getId(): int
	{
		return $this->id;
	}

}
