<?php

namespace Drupal\event\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\event\EventInterface;

/**
 * Defines the event entity class.
 *
 * @ContentEntityType(
 *   id = "event",
 *   label = @Translation("Event"),
 *   label_collection = @Translation("Events"),
 *   label_singular = @Translation("event"),
 *   label_plural = @Translation("events"),
 *   label_count = @PluralTranslation(
 *     singular = "@count events",
 *     plural = "@count events",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\event\EventListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\event\Form\EventForm",
 *       "edit" = "Drupal\event\Form\EventForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "event",
 *   admin_permission = "administer event",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/event",
 *     "add-form" = "/event/add",
 *     "canonical" = "/event/{event}",
 *     "edit-form" = "/event/{event}/edit",
 *     "delete-form" = "/event/{event}/delete",
 *   },
 *   field_ui_base_route = "entity.event.settings",
 * )
 */
class Event extends ContentEntityBase implements EventInterface
{
  /**
   * {@inheritdoc}
   */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
    {

        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['event_date'] = BaseFieldDefinition::create('datetime')
            ->setLabel(t('Event Date'))
            ->setRequired(true)
            ->setSetting('datetime_type', 'date')
            ->setDisplayOptions('view', [
                  'label' => 'above',
                  'type' => 'datetime_default',
                  'weight' => 5,
                ])
              ->setDisplayOptions('form', [
                  'type' => 'datetime_default',
                  'weight' => 5,
                ])
            ->setDisplayConfigurable('form', true)
            ->setDisplayConfigurable('view', true);

        $fields['label'] = BaseFieldDefinition::create('string')
            ->setLabel(t('Event Name'))
            ->setRequired(true)
            ->setSetting('max_length', 255)
            ->setDisplayOptions('form', [
            'type' => 'string_textfield',
            'weight' => -5,
            ])
            ->setDisplayConfigurable('form', true)
            ->setDisplayOptions('view', [
            'label' => 'hidden',
            'type' => 'string',
            'weight' => -5,
            ])
            ->setDisplayConfigurable('view', true);

        return $fields;
    }
}
