<?php

namespace Drupal\event\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the event entity edit forms.
 */
class EventForm extends ContentEntityForm
{
  /**
   * {@inheritdoc}
   */
    public function save(array $form, FormStateInterface $form_state)
    {
        $result = parent::save($form, $form_state);

        $entity = $this->getEntity();

        $message_arguments = ['%label' => $entity->toLink()->toString()];
        $logger_arguments = [
            '%label' => $entity->label(),
            'link' => $entity->toLink($this->t('View'))->toString(),
        ];

        switch ($result) {
            case SAVED_NEW:
                $this->messenger()->addStatus($this->t('New event %label has been created.', $message_arguments));
                $this->logger('event')->notice('Created new event %label', $logger_arguments);
                break;

            case SAVED_UPDATED:
                $this->messenger()->addStatus($this->t('The event %label has been updated.', $message_arguments));
                $this->logger('event')->notice('Updated event %label.', $logger_arguments);
                break;
        }

        $form_state->setRedirect('entity.event.canonical', ['event' => $entity->id()]);

        return $result;
    }
}
