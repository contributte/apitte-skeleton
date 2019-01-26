<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Serializer\Mocks;

class User
{

	/** @var Order[] */
	private $orders = [];

	public function addOrder(Order $order): void
	{
		$this->orders[] = $order;
	}

	/**
	 * @return Order[]
	 */
	public function getOrders(): array
	{
		return $this->orders;
	}

}
