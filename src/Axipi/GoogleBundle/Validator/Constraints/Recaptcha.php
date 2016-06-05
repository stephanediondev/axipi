<?php
namespace Axipi\GoogleBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Recaptcha extends Constraint
{
    public $message = 'This value should not be blank.';

    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return 'axipi_google_validator_constraints_recaptcha';
    }
}
