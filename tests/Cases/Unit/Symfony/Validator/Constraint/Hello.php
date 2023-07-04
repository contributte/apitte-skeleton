<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Hello extends Constraint
{

	public string $message = 'The string {{ string }} is not hello word!';

}
