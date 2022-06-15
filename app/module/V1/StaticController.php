<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller\Method;
use Apitte\Core\Annotation\Controller\OpenApi;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\Annotation\Controller\Tag;
use Apitte\Core\Http\ApiRequest;

/**
 * @Path("/static")
 * @Tag("Static")
 */
class StaticController extends BaseV1Controller
{

	private string $text;

	public function __construct(string $text)
	{
		$this->text = $text;
	}

	/**
	 * @OpenApi("
	 *   summary: Get static text
	 * ")
	 * @Path("/text")
	 * @Method("GET")
	 */
	public function text(ApiRequest $request): string
	{
		return $this->text;
	}

}
