<?php

namespace Drupal\registration\Plugin\Validation\Constraint;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEventConstraintValidator extends ConstraintValidator
{
    /**
     * @inheritDoc
     */
    public function validate(mixed $value, Constraint $constraint)
    {
        $foo = 21;
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

        $query = \Drupal::entityQuery('registration')
            ->accessCheck(false)
            ->condition('uid', $submitted_uid)
            ->condition('field_event', $submitted_eid);
        $result = $query->execute();
        if ($result) {
            $this->context->addViolation($constraint->notUnique, ['%value' => 'EVENT_ID']);
        }
    }
}
