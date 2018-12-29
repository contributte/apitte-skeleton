<?php declare(strict_types = 1);

namespace App\Domain\Api\Facade;

use App\Domain\Api\Dto\UserDto;
use App\Model\Database\EntityManager;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;

final class UsersFacade
{

	/** @var EntityManager */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	/**
	 * @param mixed[] $criteria
	 * @param string[] $orderBy
	 * @return UserDto[]
	 */
	public function findBy(array $criteria = [], array $orderBy = ['id' => 'ASC'], int $limit = 10, int $offset = 0): array
	{
		$entities = $this->em->getUserRepository()->findBy($criteria, $orderBy, $limit, $offset);
		$result = [];

		foreach ($entities as $entity) {
			$result[] = UserDto::from($entity);
		}

		return $result;
	}

	/**
	 * @return UserDto[]
	 */
	public function findAll(int $limit = 10, int $offset = 0): array
	{
		return $this->findBy([], ['id' => 'ASC'], $limit, $offset);
	}

	/**
	 * @param mixed[] $criteria
	 * @param string[] $orderBy
	 */
	public function findOneBy(array $criteria, ?array $orderBy = null): UserDto
	{
		$entity = $this->em->getUserRepository()->findOneBy($criteria, $orderBy);

		if (!$entity) throw new EntityNotFoundException();

		return UserDto::from($entity);
	}

	public function findOne(int $id): UserDto
	{
		return $this->findOneBy(['id' => $id]);
	}

}
