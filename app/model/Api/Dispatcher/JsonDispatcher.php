<?php declare(strict_types = 1);

namespace App\Model\Api\Dispatcher;

use Apitte\Core\Dispatcher\JsonDispatcher as ApitteJsonDispatcher;
use Apitte\Core\Exception\Api\ClientErrorException;
use Apitte\Core\Exception\Api\ServerErrorException;
use App\Model\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class JsonDispatcher extends ApitteJsonDispatcher
{

	protected function handle(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		try {
			$result = $this->handler->handle($request, $response);

			// Except ResponseInterface convert all to json
			if (!($result instanceof ResponseInterface)) {
				$response = $response->withStatus(200)
					->withHeader('Content-Type', 'application/json');
				$response->getBody()->write(Json::encode($result));
			} else {
				$response = $result;
			}
		} catch (ClientErrorException | ServerErrorException $e) {
			$data = [
				'exception' => $e->getMessage() ?: 'Application encountered an internal error. Please try again later.',
			];
			if ($e->getContext()) {
				$data['context'] = $e->getContext();
			}
			if ($e->getCode()) {
				$data['code'] = $e->getCode();
			}

			$response = $response->withStatus($e->getCode())
				->withHeader('Content-Type', 'application/json');
			$response->getBody()->write(Json::encode($data));
		}

		return $response;
	}

}
