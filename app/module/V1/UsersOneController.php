<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\RequestParameter;
use Apitte\Core\Annotation\Controller\RequestParameters;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Exception\Api\ClientErrorException;
use Apitte\Core\Http\ApiRequest;
use App\Domain\Api\Facade\UsersFacade;
use App\Domain\Api\Response\UserResDto;
use App\Model\Exception\Runtime\Database\EntityNotFoundException;
use Nette\Http\IResponse;

/**
 * @Path("/users")
 * @Tag("Users")
 */
class UsersOneController extends BaseV1Controller
{

	/** @var UsersFacade */
	private $usersFacade;

	public function __construct(UsersFacade $usersFacade)
	{
		$this->usersFacade = $usersFacade;
	}

	/**
	 * @OpenApi("
	 *   summary: Get user by email.
	 * ")
	 * @Path("/email")
	 * @Method("GET")
	 * @RequestParameters({
	 *      @RequestParameter(name="email", in="query", type="string", description="User e-mail address")
	 * })
	 */
	public function byEmail(ApiRequest $request): UserResDto
	{
		try {
			return $this->usersFacade->findOneBy(['email' => $request->getParameter('email')]);
		} catch (EntityNotFoundException $e) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NOT_FOUND);
		}
	}

	/**
	 * @OpenApi("
	 *   summary: Get user by id.
	 * ")
	 * @Path("/{id}")
	 * @Method("GET")
	 * @RequestParameters({
	 *      @RequestParameter(name="id", in="path", type="int", description="User ID")
	 * })
	 */
	public function byId(ApiRequest $request): UserResDto
	{
		try {
			return $this->usersFacade->findOne(intval($request->getParameter('id')));
		} catch (EntityNotFoundException $e) {
			throw ClientErrorException::create()
				->withMessage('User not found')
				->withCode(IResponse::S404_NOT_FOUND);
		}
	}

}
