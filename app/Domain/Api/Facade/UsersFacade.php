<?php declare(strict_types = 1);

namespace App\Domain\Api\Facade;

use App\Domain\Api\Request\CreateUserReqDto;
use App\Domain\Api\Response\UserResDto;
use App\Domain\User\User;
use App\Model\Database\EntityManagerDecorator;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Security\Passwords;

final class UsersFacade
{

	public function __construct(private EntityManagerDecorator $em)
	{
	}

	/**
	 * @param mixed[] $criteria
	 * @param string[] $orderBy
	 * @return UserResDto[]
	 */
	public function findBy(array $criteria = [], array $orderBy = ['id' => 'ASC'], int $limit = 10, int $offset = 0): array
	{
		$entities = $this->em->getRepository(User::class)->findBy($criteria, $orderBy, $limit, $offset);
		$result = [];

		foreach ($entities as $entity) {
			$result[] = UserResDto::from($entity);
		}

		return $result;
	}

	/**
	 * @return UserResDto[]
	 */
	public function findAll(int $limit = 10, int $offset = 0): array
	{
		return $this->findBy([], ['id' => 'ASC'], $limit, $offset);
	}

	/**
	 * @param mixed[] $criteria
	 * @param string[] $orderBy
	 */
	public function findOneBy(array $criteria, ?array $orderBy = null): UserResDto
	{
		$entity = $this->em->getRepository(User::class)->findOneBy($criteria, $orderBy);

		if ($entity === null) {
			throw new EntityNotFoundException();
		}

		return UserResDto::from($entity);
	}

	public function findOne(int $id): UserResDto
	{
		return $this->findOneBy(['id' => $id]);
	}

	public function create(CreateUserReqDto $dto): User
	{
		$user = new User(
			$dto->name,
			$dto->surname,
			$dto->email,
			$dto->username,
			Passwords::create()->hash($dto->password ?? md5(microtime()))
		);

		$this->em->persist($user);
		$this->em->flush($user);

		return $user;
	}

}
