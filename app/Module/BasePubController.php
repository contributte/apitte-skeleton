<?php declare(strict_types = 1);

namespace App\Module;

use Apitte\Core\Annotation\Controller as Apitte;
use Apitte\Core\UI\Controller\IController;

/**
 * @Apitte\Path("/api/public")
 * @Apitte\Id("api-public")
 */
abstract class BasePubController implements IController
{

}
