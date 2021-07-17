<?php declare(strict_types = 1);

namespace Tests\Toolkit\Nette;

use DateTimeInterface;
use Nette\Security\IIdentity;
use Nette\Security\IUserStorage;

final class DummyUserStorage implements IUserStorage
{

	private bool $authenticated = false;

	/** @var IIdentity|NULL */
	private ?IIdentity $identity = null;

	/**
	 * @return static
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public function setAuthenticated(bool $state): static
	{
		$this->authenticated = $state;

		return $this;
	}

	public function isAuthenticated(): bool
	{
		return $this->authenticated;
	}

	public function setIdentity(?IIdentity $identity): self
	{
		$this->identity = $identity;

		return $this;
	}

	public function getIdentity(): ?IIdentity
	{
		return $this->identity;
	}

	/**
	 * @return static
	 */
	public function setExpiration(string|int|DateTimeInterface $time, int $flags = 0): static
	{
		return $this;
	}

	public function getLogoutReason(): ?int
	{
		return null;
	}

	public function setNamespace(string $namespace): self
	{
		return $this;
	}

}
