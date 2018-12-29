<?php declare(strict_types = 1);

namespace App\Module\PubV1;

use Apitte\Core\Annotation\Controller\GroupId;
use Apitte\Core\Annotation\Controller\GroupPath;
use App\Module\BasePubController;

/**
 * @GroupPath("/v1")
 * @GroupId("v1")
 */
abstract class BasePubV1Controller extends BasePubController
{

}
