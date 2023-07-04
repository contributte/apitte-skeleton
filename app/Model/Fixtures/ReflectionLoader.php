<?php declare(strict_types = 1);

namespace App\Model\Fixtures;

use Nelmio\Alice\Loader\NativeLoader;
use Nelmio\Alice\PropertyAccess\ReflectionPropertyAccessor;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

final class ReflectionLoader extends NativeLoader
{

	protected function createPropertyAccessor(): PropertyAccessorInterface
	{
		return new ReflectionPropertyAccessor(
			PropertyAccess::createPropertyAccessorBuilder()
				->enableMagicCall()
				->getPropertyAccessor()
		);
	}

}
