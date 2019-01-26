<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Serializer\Mocks;

class Order
{

	/** @var int */
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
