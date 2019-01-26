<?php declare(strict_types = 1);

namespace Tests\Cases\Unit\Symfony\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class HelloValidator extends ConstraintValidator
{

	/**
	 * @param mixed $value
	 * @param Hello $constraint
	 */
	public function validate($value, Constraint $constraint): void
	{
		if ($value !== 'hello') {
			$this->context->buildViolation($constraint->message)
				->setParameter('{{ string }}', $value)
				->addViolation();
		}
	}

}
