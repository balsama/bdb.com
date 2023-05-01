<?php

namespace Drupal\registration\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\registration\RegistrationInterface;
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
 *     singular = "@count registration",
 *     plural = "@count registrations",
 *   ),
 *   constraints = {
 *     "UniqueEvent" = {}
 *   },
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
 *     "owner" = "uid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/registration",
 *     "add-form" = "/registration/add",
 *     "canonical" = "/registration/{registration}",
 *     "edit-form" = "/registration/{registration}/edit",
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
        $fields += static::ownerBaseFieldDefinitions($entity_type);

        $fields['uid']
            ->setReadOnly(true)
            ->setLabel(t('Registrant'))
            ->setDescription(t('The user who is registering for the event. (Not editable)'))
            ->setDisplayOptions('view', [
                'label' => 'hidden',
                'type' => 'author',
                'weight' => 0,
            ])
            ->setDisplayConfigurable('view', true)
            ->setDisplayOptions('form', [
                'type' => 'entity_reference_autocomplete',
                'weight' => 5,
                'settings' => [
                    'match_operator' => 'CONTAINS',
                    'size' => '60',
                    'placeholder' => '',
                ],
            ])
            ->setDisplayConfigurable('form', true);

        return $fields;
    }

    public function validate()
    {
        return parent::validate();
    }
}
