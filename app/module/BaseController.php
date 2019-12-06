<?php declare(strict_types = 1);

namespace App\Module;

use Apitte\Core\Annotation\Controller\Id;
use Apitte\Core\Annotation\Controller\Path;
use Apitte\Core\UI\Controller\IController;

/**
 * @Path("/api")
 * @Id("api")
 */
abstract class BaseController implements IController
{

}
