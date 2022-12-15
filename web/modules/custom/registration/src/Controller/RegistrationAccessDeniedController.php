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
        $registerForm = \Drupal::formBuilder()->getForm($formObject);

        $loginForm = \Drupal::formBuilder()->getForm(\Drupal\user\Form\UserLoginForm::class) ;

        return [
            // Your theme hook name.
            '#theme' => 'register_add_access_denied_hook',
            // Your variables.
            '#register_form' => $registerForm,
            '#login_form' => $loginForm,
        ];
    }
}
