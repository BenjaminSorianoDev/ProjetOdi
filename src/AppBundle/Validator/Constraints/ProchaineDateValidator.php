<?php
	
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
* @Annotation
*/
class ProchaineDateValidator extends Constraintvalidator {

	public function validate($value, Constraint $constraint) {

		$dateDuJour = new \DateTime();

		if ($value < $dateDuJour) {

			$this->context->buildViolation($constraint->message)
				 ->setParameter('%string%', $value->format('d/m/Y'))
				 ->addViolation();
		}
	}
}