<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait TUpdatedAt
{

	#[ORM\Column(type: 'datetime', nullable: true)]
	protected ?DateTime $updatedAt = null;

	public function getUpdatedAt(): ?DateTime
	{
		return $this->updatedAt;
	}

	#[ORM\PreUpdate]
	public function setUpdatedAt(): void
	{
		$this->updatedAt = new DateTime();
	}

}
