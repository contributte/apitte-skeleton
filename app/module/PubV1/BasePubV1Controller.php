<?php declare(strict_types = 1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\Id;
use Apitte\Core\Annotation\Controller\Path;
use App\Module\BasePubController;

/**
 * @Path("/v1")
 * @Id("v1")
 */
abstract class BasePubV1Controller extends BasePubController
{

}
