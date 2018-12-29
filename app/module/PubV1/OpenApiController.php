<?php declare(strict_types = 1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\Controller;
use Apitte\Core\Annotation\Controller\ControllerPath;
use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use Apitte\OpenApi\OpenApiService;
use Contributte\Psr7\Psr7Response;
use Psr\Http\Message\ResponseInterface;

/**
 * @Controller()
 * @ControllerPath("/openapi")
 */
class OpenApiController extends BasePubV1Controller
{

	/** @var OpenApiService */
	private $openApiService;

	public function __construct(OpenApiService $openApiService)
	{
		$this->openApiService = $openApiService;
	}

	/**
	 * @Path("/meta")
	 * @Method("GET")
	 */
	public function meta(ApiRequest $request, ApiResponse $response): ResponseInterface
	{
		/** @var Psr7Response $response */
		return $response
			->withAddedHeader('Access-Control-Allow-Origin', 'https://petstore.swagger.io')
			->writeJsonBody(
				$this->openApiService->createSchema()->toArray()
			);
	}

}
