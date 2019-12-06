<?php declare(strict_types = 1);

namespace App\Model\Api\Security;

use App\Model\Database\Entity\User;
use App\Model\Database\EntityManager;
use Psr\Http\Message\ServerRequestInterface;

class TokenAuthenticator extends AbstractAuthenticator
{

	private const HEADER_TOKEN = 'X-Token';
	private const QUERY_TOKEN = '_access_token';

	/** @var EntityManager */
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	public function authenticate(ServerRequestInterface $request): ?User
	{
		// Parse from request header
		$token = $this->tryHeader($request);

		// Try from URL
		if (!$token) {
			$token = $this->tryQuery($request);
		}

		if (!$token) {
			return null;
		}

		// Lookup user in DB
		$user = $this->em->getUserRepository()->findOneBy(['apikey' => $token]);

		// User not found
		if (!$user) {
			return null;
		}

		return $user;
	}

	private function tryHeader(ServerRequestInterface $request): ?string
	{
		return $request->hasHeader(self::HEADER_TOKEN) ?
			$request->getHeaderLine(self::HEADER_TOKEN)
			: null;
	}

	private function tryQuery(ServerRequestInterface $request): ?string
	{
		return $request->getQueryParams()[self::QUERY_TOKEN] ?? null;
	}

}
