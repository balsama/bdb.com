<?php

namespace Drupal\registration\Controller;

use Drupal\Core\Controller\ControllerBase;

class RegistrationAccessDeniedController extends ControllerBase
{
    public function content()
    {
        $entity = \Drupal::entityTypeManager()->getStorage('user')->create(array());
        $formObject = \Drupal::entityTypeManager()
            ->getFormObject('user', 'register')
            ->setEntity($entity);
        $userRegisterForm = \Drupal::formBuilder()->getForm($formObject);
        $loginForm = \Drupal::formBuilder()->getForm(\Drupal\user\Form\UserLoginForm::class);
        //$eventRegistrationForm = \Drupal::formBuilder()->getForm(\Drupal\registration\Form\RegistrationForm::class);

        $entity = \Drupal::entityTypeManager()->getStorage('registration')->create(array());
        $formObject = \Drupal::entityTypeManager()
            ->getFormObject('registration', 'add')
            ->setEntity($entity);
        $eventRegistrationForm = \Drupal::formBuilder()->getForm($formObject);

        return [
            '#theme' => 'register_add_access_denied_hook',
            '#user_register_form' => $userRegisterForm,
            '#login_form' => $loginForm,
            '#event_registration_form' => $eventRegistrationForm,
        ];
    }
}
