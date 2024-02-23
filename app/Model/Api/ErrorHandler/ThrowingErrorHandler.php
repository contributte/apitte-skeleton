<?php declare(strict_types = 1);

namespace App\Model\Api\ErrorHandler;

use Apitte\Core\Dispatcher\DispatchError;
use Apitte\Core\ErrorHandler\SimpleErrorHandler;
use Apitte\Core\Http\ApiResponse;

class ThrowingErrorHandler extends SimpleErrorHandler
{

	public function handle(DispatchError $error): ApiResponse
	{
		throw $error->getError();
	}

}
