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
    public $notUnique = 'A Registration already exists for the submitted user and event.';
}