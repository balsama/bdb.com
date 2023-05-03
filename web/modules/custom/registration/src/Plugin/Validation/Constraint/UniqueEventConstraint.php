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
    public $notAuthenticated = <<<EOF
You must be logged in to register for an Event.<br>
<a href="/user/login">Log in</a> or <a href="/user/register">Create an Account</a>.
EOF;
    public $registrationClosed = 'We\'re sorry, but registration for %eventname is now closed.';
}
