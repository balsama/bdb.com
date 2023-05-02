<?php

namespace Drupal\registration\Plugin\Validation\Constraint;

use Drupal\event\Entity\Event;
use Drupal\registration\Entity\Registration;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Validates that a user doesn't submit more than one Event Report per event that they're registered for.
 */
class UniqueRegistrationConstraintValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if ($_POST['field_registration'] === '_none') {
            // Handled by other validators.
            return;
        }
        if ($value->getName() !== 'field_registration') {
            return;
        }

        $submitted_rid = $value->getValue()[0]['target_id'];
        $registration = Registration::load($submitted_rid);
        $submitted_registration_event_eid = $registration->get('field_event')->getValue()[0]['target_id'];
        $event = Event::load($submitted_registration_event_eid);
        $event_name = $event->get('label')->getValue()[0]['value'];
        $submitted_registration_uid = $registration->get('uid')->getValue()[0]['target_id'];
        $current_user = \Drupal::currentUser();
        $current_user_uid = $current_user->id();
        $current_user_name = $current_user->getDisplayName();

        $query = \Drupal::entityQuery('node')
            ->accessCheck(false)
            ->condition('type', 'event_report')
            ->condition('field_registration', $submitted_rid);
        $result = $query->execute();

        if ($result) {
            $node = \Drupal::routeMatch()->getParameter('node');
            if ($node) {
                $node_id = \Drupal::routeMatch()->getParameter('node')->id();
                if (in_array($node_id, $result)) {
                    // The user is editing the same node that is listed as belonging to them.
                    return;
                }
            }

            $this->context->addViolation(
                $constraint->notUnique,
                [
                    '%username' => $current_user_name,
                    '%eventname' => $event_name,
                ]
            );
        }

        if ($submitted_registration_uid !== $current_user_uid) {
            $this->context->addViolation(
                $constraint->mismatch,
                [
                    '%username' => $current_user_name,
                ]
            );
        }
    }
}
