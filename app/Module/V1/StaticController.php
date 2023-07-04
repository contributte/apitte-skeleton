<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\Http\ApiRequest;

/**
 * @Apitte\Path("/static")
 * @Apitte\Tag("Static")
 */
class StaticController extends BaseV1Controller
{

	private string $text;

	public function __construct(string $text)
	{
		$this->text = $text;
	}

	/**
	 * @Apitte\OpenApi("
	 *   summary: Get static text
	 * ")
	 * @Apitte\Path("/text")
	 * @Apitte\Method("GET")
	 */
	public function text(ApiRequest $request): string
	{
		return $this->text;
	}

}
