<?php declare(strict_types = 1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller as Apitte;
use App\Module\BasePubController;

/**
 * @Apitte\Path("/v1")
 * @Apitte\Id("v1")
 */
abstract class BasePubV1Controller extends BasePubController
{

}
