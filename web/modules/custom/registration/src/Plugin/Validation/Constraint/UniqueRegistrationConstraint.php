<?php

namespace Drupal\registration\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Checks that the submitted event recap has not already been submitted with the same registration.
 *
 * @Constraint(
 *   id = "UniqueRegistration",
 *   label = @Translation("Unique Registration", context = "Validation"),
 *   type = "string"
 * )
 */
class UniqueRegistrationConstraint extends Constraint
{
    public $mismatch = 'User %username doesn\'t match the submitted Event Registration.';
    public $notUnique = 'User %username has already created an Event Report for the %eventname Event. You can find a link to the existing report on your account page under the "This user\'s content" section';
    public $notAuthenticated = <<<EOF
You must be logged in to create an Event report for an Event.<br>
<a href="/user/login">Log in</a> or <a href="/user/register">Create an Account</a>.
EOF;
}
