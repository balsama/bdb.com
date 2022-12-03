<?php

namespace Drupal\event\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for an event entity type.
 */
class EventSettingsForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
    public function getFormId()
    {
        return 'event_settings';
    }

  /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['settings'] = [
        '#markup' => $this->t('Settings form for an event entity type.'),
        ];

        $form['actions'] = [
        '#type' => 'actions',
        ];

        $form['actions']['submit'] = [
        '#type' => 'submit',
        '#value' => $this->t('Save'),
        ];

        return $form;
    }

  /**
   * {@inheritdoc}
   */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $this->messenger()->addStatus($this->t('The configuration has been updated.'));
    }
}
