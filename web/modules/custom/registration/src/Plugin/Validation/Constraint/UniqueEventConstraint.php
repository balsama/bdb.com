<?php

namespace Drupal\registration\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted registration does not already exist.
 *
 * @Constraint(
 *   id = "UniqueEvent",
 *   label = @Translation("Unique Event", context = "Validation"),
 *   type = "string"
 * )
 */
class UniqueEventConstraint extends Constraint
{
    public $notUnique = 'User %username is already registered for the %eventname Event.';
}
