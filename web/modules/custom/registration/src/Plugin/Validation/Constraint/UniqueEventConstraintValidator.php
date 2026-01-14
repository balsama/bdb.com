<?php

namespace Drupal\registration\Plugin\Validation\Constraint;

use Drupal\event\Entity\Event;
use Drupal\user\Entity\User;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEventConstraintValidator extends ConstraintValidator
{
    private const CLOSED_EVENTS = [
        'Big Day Boston 2023',
        'Big Day Boston 2024',
        'Big Day Boston 2025',
    ];

    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        if ($_POST['field_event'] === '_none') {
            // Handled by other validators.
            return;
        }
        $submitted_uid = null;
        $submitted_eid = null;
        foreach ($value as $item) {
            switch ($item->getName()) {
                case 'uid':
                    $submitted_uid = $item->getValue()[0]['target_id'];
                    break;
                case 'field_event':
                    $submitted_eid = $item->getValue()[0]['target_id'];
                    break;
            }
        }

        $event = Event::load($submitted_eid);
        $eventname = $event->get('label')->getValue()[0]['value'];

        if (in_array($eventname, self::CLOSED_EVENTS)) {
            $this->context->addViolation(
                $constraint->registrationClosed,
                [
                    '%eventname' => $eventname
                ]
            );
        }

        if ($submitted_uid === 0) {
            $this->context->addViolation(
                $constraint->notAuthenticated,
            );
        }

        $query = \Drupal::entityQuery('registration')
            ->accessCheck(false)
            ->condition('uid', $submitted_uid)
            ->condition('field_event', $submitted_eid);
        $result = $query->execute();
        if ($result) {
            $username = User::load($submitted_uid)->getDisplayName();
            $this->context->addViolation(
                $constraint->notUnique,
                [
                    '%username' => $username,
                    '%eventname' => $eventname
                ]
            );
        }
    }
}
