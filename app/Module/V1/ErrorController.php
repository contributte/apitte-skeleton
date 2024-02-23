<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;

/**
 * @Apitte\Path("/error")
 * @Apitte\Tag("Error")
 */
class ErrorController extends BaseV1Controller
{

	/**
	 * @Apitte\Path("/exception")
	 * @Apitte\Method("GET")
	 */
	public function exception(ApiRequest $request): string
	{
		throw new \RuntimeException('This is example');
	}

}
