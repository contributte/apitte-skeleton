<?php declare(strict_types = 1);

namespace App\Model\Api\Dispatcher;

use Apitte\Core\Dispatcher\JsonDispatcher as ApitteJsonDispatcher;
use Apitte\Core\Exception\Api\ClientErrorException;
use Apitte\Core\Exception\Api\ServerErrorException;
use Apitte\Core\Exception\Api\ValidationException;
use Apitte\Core\Handler\IHandler;
use Apitte\Core\Http\RequestAttributes;
use Apitte\Core\Router\IRouter;
use Apitte\Core\Schema\Endpoint;
use App\Model\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class JsonDispatcher extends ApitteJsonDispatcher
{

	/** @var SerializerInterface */
	protected $serializer;

	/** @var ValidatorInterface */
	protected $validator;

	public function __construct(IRouter $router, IHandler $handler, SerializerInterface $serializer, ValidatorInterface $validator)
	{
		parent::__construct($router, $handler);
		$this->serializer = $serializer;
		$this->validator = $validator;
	}

	protected function handle(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		try {
			$request = $this->transformRequest($request);
			$result = $this->handler->handle($request, $response);

			// Except ResponseInterface convert all to json
			if (!($result instanceof ResponseInterface)) {
				$response = $this->transformResponse($result, $response);
			} else {
				$response = $result;
			}
		} catch (ClientErrorException | ServerErrorException $e) {
			$data = [];

			if ($e->getMessage()) {
				$data['message'] = $e->getMessage();
			}
			if ($e->getContext()) {
				$data['context'] = $e->getContext();
			}
			if ($e->getCode()) {
				$data['code'] = $e->getCode();
			}

			$response = $response->withStatus($e->getCode() ?: 500)
				->withHeader('Content-Type', 'application/json');
			$response->getBody()->write(Json::encode($data));
		} catch (RuntimeException $e) {
			$response = $response->withStatus($e->getCode() ?: 500)
				->withHeader('Content-Type', 'application/json');
			$response->getBody()->write(Json::encode([
				'message' => $e->getMessage() ?: 'Application encountered an internal error. Please try again later.',
			]));
		}

		return $response;
	}

	/**
	 * Transform incoming request to request DTO, if needed.
	 */
	protected function transformRequest(ServerRequestInterface $request): ServerRequestInterface
	{
		// If Apitte endpoint is not provided, skip transforming.
		/** @var Endpoint $endpoint */
		if (!($endpoint = $request->getAttribute(RequestAttributes::ATTR_ENDPOINT))) return $request;

		// Get incoming request entity class, if defined. Otherwise, skip transforming.
		if (!($entity = $endpoint->getTag('request.dto'))) return $request;

		try {
			// Create request DTO from incoming request, using serializer.
			$dto = $this->serializer->deserialize(
				$request->getBody()->getContents(),
				$entity,
				'json',
				['allow_extra_attributes' => false]
			);

			$request = $request->withParsedBody($dto);
		} catch (ExtraAttributesException $e) {
			throw ValidationException::create()
				->withMessage($e->getMessage());
		}

		// Try to validate entity only if its enabled
		$violations = $this->validator->validate($dto);

		if (count($violations) > 0) {
			$fields = [];
			foreach ($violations as $violation) {
				$fields[$violation->getPropertyPath()][] = $violation->getMessage();
			}

			throw ValidationException::create()
				->withMessage('Invalid request data')
				->withFields($fields);
		}

		return $request;
	}

	/**
	 * Transform outgoing response data to JSON, if needed.
	 *
	 * @param mixed $data
	 */
	protected function transformResponse($data, ResponseInterface $response): ResponseInterface
	{
		$response = $response->withStatus(200)
			->withHeader('Content-Type', 'application/json');

		// Serialize entity with symfony/serializer to JSON
		$serialized = $this->serializer->serialize($data, 'json');

		$response->getBody()->write($serialized);

		return $response;
	}

}
