<?php
// @todo delete.
// This route shouldn't be needed if we add event registration to the account creation/edit page.
namespace Drupal\registration\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Drupal\Core\Render\Markup;
use Drupal\Core\Link;

class PreregisterController extends ControllerBase
{
    public function content()
    {
        //This should all be unnecessary if we show event registration on the account creation page.
        if (!\Drupal::currentUser()->isAnonymous()) {
            $url = Url::fromUri('internal:/registration/add');
            $linkText = $this->t('Event Registration');
            $linkHTMLMarkup = Markup::create($linkText);
            $link = Link::fromTextAndUrl($linkHTMLMarkup, $url);
            $link = $link->toString();
            return [
                '#markup' => $this->t('You\'re already logged in. You can continue to the ' . $link . ' page.'),
            ];
        }
        $url = Url::fromUri('internal:/user/register');
        $linkText = $this->t('Create an Account');
        $linkHTMLMarkup = Markup::create($linkText);
        $link = Link::fromTextAndUrl($linkHTMLMarkup, $url);
        $linkLinkMarkup = $link->toString();
        $build = [
            '#markup' => $this->t('You need to ' . $linkLinkMarkup . ' before you can register for an Event.'),
        ];
        //return $build;


        $entity = \Drupal::entityTypeManager()
            ->getStorage('user')
            ->create(array());

        $formObject = \Drupal::entityTypeManager()
            ->getFormObject('user', 'register')
            ->setEntity($entity);

        $form = \Drupal::formBuilder()->getForm($formObject);

        return $form;
    }

}