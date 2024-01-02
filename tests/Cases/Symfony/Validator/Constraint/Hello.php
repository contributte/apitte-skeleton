<?php declare(strict_types = 1);

namespace Tests\Cases\Symfony\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class Hello extends Constraint
{

	public string $message = 'The string {{ string }} is not hello word!';

}
