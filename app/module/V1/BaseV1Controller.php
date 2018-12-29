<?php declare(strict_types = 1);

namespace App\Module\V1;

use Apitte\Core\Annotation\Controller\GroupId;
use Apitte\Core\Annotation\Controller\GroupPath;
use App\Module\BaseController;

/**
 * @GroupPath("/v1")
 * @GroupId("v1")
 */
abstract class BaseV1Controller extends BaseController
{

}
