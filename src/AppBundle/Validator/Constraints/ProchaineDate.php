<?php
	
namespace AppBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ProchaineDate extends Constraint {

	public $message = 'La date "%string%" doit être supérieure à la date du jour.';
}