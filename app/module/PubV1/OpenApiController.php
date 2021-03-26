<?php declare(strict_types = 1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Http\ApiRequest;
use Apitte\Core\Http\ApiResponse;
use Apitte\OpenApi\ISchemaBuilder;
use Psr\Http\Message\ResponseInterface;

/**
 * @Path("/openapi")
 * @Tag("OpenApi")
 */
class OpenApiController extends BasePubV1Controller
{

	/** @var ISchemaBuilder */
	private $schemaBuilder;

	public function __construct(ISchemaBuilder $schemaBuilder)
	{
		$this->schemaBuilder = $schemaBuilder;
	}

	/**
	 * @OpenApi("
	 *   summary: Get OpenAPI definition.
	 * ")
	 * @Path("/meta")
	 * @Method("GET")
	 */
	public function meta(ApiRequest $request, ApiResponse $response): ResponseInterface
	{
		return $response
			->withAddedHeader('Access-Control-Allow-Origin', '*')
			->writeJsonBody(
				$this->schemaBuilder->build()->toArray()
			);
	}

}
