<?php

namespace Drupal\registration\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\registration\RegistrationInterface;
use Drupal\user\Entity\User;
use Drupal\user\EntityOwnerTrait;

/**
 * Defines the registration entity class.
 *
 * @ContentEntityType(
 *   id = "registration",
 *   label = @Translation("Registration"),
 *   label_collection = @Translation("Registrations"),
 *   label_singular = @Translation("registration"),
 *   label_plural = @Translation("registrations"),
 *   label_count = @PluralTranslation(
 *     singular = "@count registrations",
 *     plural = "@count registrations",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\registration\RegistrationListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "access" = "Drupal\registration\RegistrationAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\registration\Form\RegistrationForm",
 *       "edit" = "Drupal\registration\Form\RegistrationForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\registration\Routing\RegistrationHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "registration",
 *   admin_permission = "administer registration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/registration",
 *     "add-form" = "/registration/add",
 *     "canonical" = "/registration/{registration}",
 *     "edit-form" = "/registration/{registration}",
 *     "delete-form" = "/registration/{registration}/delete",
 *   },
 *   field_ui_base_route = "entity.registration.settings",
 * )
 */
class Registration extends ContentEntityBase implements RegistrationInterface
{
    use EntityOwnerTrait;

    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['event_reference'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('Event'))
            ->setRequired(true)
            ->setSetting('target_type', 'event')
            ->setDisplayOptions('form', [
                'type' => 'entity_reference_select',
                'weight' => 5,
            ])
            ->setDefaultValue(1);

        $fields['user_reference'] = BaseFieldDefinition::create('entity_reference')
            ->setLabel(t('User'))
            ->setRequired(true)
            ->setSetting('target_type', 'user')
            ->setDisplayOptions('form', [
                'type' => 'entity_reference',
                'weight' => 5,
            ])
            ->setDefaultValueCallback(static::class . '::getDefaultEntityOwner');

        return $fields;
    }
}
