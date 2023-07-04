<?php declare(strict_types = 1);

namespace App\Model\Api\Security;

use App\Domain\User\User;
use App\Model\Database\EntityManagerDecorator;
use Psr\Http\Message\ServerRequestInterface;

class TokenAuthenticator extends AbstractAuthenticator
{

	private const HEADER_TOKEN = 'X-Token';
	private const QUERY_TOKEN = '_access_token';

	public function __construct(private EntityManagerDecorator $em)
	{
	}

	public function authenticate(ServerRequestInterface $request): ?User
	{
		// Parse from request header
		$token = $this->tryHeader($request);

		// Try from URL
		if ($token === null || $token === '') {
			$token = $this->tryQuery($request);
		}

		if ($token === null || $token === '') {
			return null;
		}

		// Lookup user in DB
		return $this->em->getRepository(User::class)->findOneBy(['apikey' => $token]);
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
