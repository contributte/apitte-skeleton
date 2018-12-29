<?php declare(strict_types = 1);

namespace App\Module;

use Apitte\Core\Annotation\Controller\GroupId;
use Apitte\Core\Annotation\Controller\GroupPath;
use Apitte\Core\UI\Controller\IController;

/**
 * @GroupPath("/api/public")
 * @GroupId("api-public")
 */
abstract class BasePubController implements IController
{

}
