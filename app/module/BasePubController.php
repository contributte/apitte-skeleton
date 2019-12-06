<?php declare(strict_types = 1);

namespace App\Module;

use Apitte\Core\Annotation\Controller\Id;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\UI\Controller\IController;

/**
 * @Path("/api/public")
 * @Id("api-public")
 */
abstract class BasePubController implements IController
{

}
