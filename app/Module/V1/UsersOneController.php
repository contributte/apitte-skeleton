<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Exception\Api\ClientErrorException;
use Apitte\Core\Http\ApiRequest;
use App\Domain\Api\Facade\UsersFacade;
use App\Domain\Api\Response\UserResDto;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use App\Model\Utils\Caster;
use Nette\Http\IResponse;

#[Apitte\Path('/users')]
#[Apitte\Tag('Users')]
class UsersOneController extends BaseV1Controller
{

	private UsersFacade $usersFacade;

	public function __construct(UsersFacade $usersFacade)
	{
		$this->usersFacade = $usersFacade;
	}

	#[Apitte\OpenApi('summary: Get user by email.')]
	#[Apitte\Path('/email')]
	#[Apitte\Method('GET')]
	public function byEmail(ApiRequest $request): UserResDto
	{
		try {
			return $this->usersFacade->findOneBy(['email' => $request->getParameter('email')]);
		} catch (EntityNotFoundException $e) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NotFound);
		}
	}

	#[Apitte\OpenApi('summary: Get user by id.')]
	#[Apitte\Path('/{id}')]
	#[Apitte\Method('GET')]
	public function byId(ApiRequest $request): UserResDto
	{
		try {
			return $this->usersFacade->findOne(Caster::toInt($request->getParameter('id')));
		} catch (EntityNotFoundException $e) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NotFound);
		}
	}

}
