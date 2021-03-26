<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\RequestParameter;
use Apitte\Core\Annotation\Controller\RequestParameters;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Http\ApiRequest;
use App\Domain\Api\Facade\UsersFacade;
use App\Domain\Api\Response\UserResDto;

/**
 * @Path("/users")
 * @Tag("Users")
 */
class UsersController extends BaseV1Controller
{

	/** @var UsersFacade */
	private $usersFacade;

	public function __construct(UsersFacade $usersFacade)
	{
		$this->usersFacade = $usersFacade;
	}

	/**
	 * @OpenApi("
	 *   summary: List users.
	 * ")
	 * @Path("/")
	 * @Method("GET")
	 * @RequestParameters({
	 * 		@RequestParameter(name="limit", type="int", in="query", required=false, description="Data limit"),
	 * 		@RequestParameter(name="offset", type="int", in="query", required=false, description="Data offset")
	 * })
	 * @return UserResDto[]
	 */
	public function index(ApiRequest $request): array
	{
		return $this->usersFacade->findAll(
			intval($request->getParameter('limit', 10)),
			intval($request->getParameter('offset', 0))
		);
	}

}
