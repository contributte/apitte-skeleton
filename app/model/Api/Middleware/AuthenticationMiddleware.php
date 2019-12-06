<?php declare(strict_types = 1);

namespace App\Model\Api\Middleware;

use App\Model\Api\RequestAttributes;
use App\Model\Utils\Strings;
use Contributte\Middlewares\IMiddleware;
use Contributte\Middlewares\Security\IAuthenticator;
use Nette\Utils\Json;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AuthenticationMiddleware implements IMiddleware
{

	private const WHITELIST_PATHS = ['/api/public'];

	/** @var IAuthenticator */
	private $authenticator;

	public function __construct(IAuthenticator $authenticator)
	{
		$this->authenticator = $authenticator;
	}

	/**
	 * Authenticate user from given request
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
	{
		if ($this->isWhitelisted($request)) {
			return $next($request, $response);
		}

		$user = $this->authenticator->authenticate($request);

		// If we have a identity, then go to next middlewares,
		// otherwise stop and return current response
		if (!$user) {
			return $this->denied($request, $response);
		}

		// Add info about current logged user to request attributes
		$request = $request->withAttribute(RequestAttributes::APP_LOGGED_USER, $user);

		// Pass to next middleware
		return $next($request, $response);
	}

	protected function denied(ServerRequestInterface $request, ResponseInterface $response): ResponseInterface
	{
		$response->getBody()->write(Json::encode([
			'status' => 'error',
			'message' => 'Client authentication failed',
			'code' => 401,
		]));

		return $response
			->withHeader('Content-Type', 'application/json')
			->withStatus(401);
	}

	protected function isWhitelisted(ServerRequestInterface $request): bool
	{
		foreach (self::WHITELIST_PATHS as $whitelist) {
			if (Strings::startsWith($request->getUri()->getPath(), $whitelist)) {
				return true;
			}
		}

		return false;
	}

}
