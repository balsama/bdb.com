<?php

namespace Drupal\event;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the event entity type.
 */
class EventListBuilder extends EntityListBuilder
{
  /**
   * {@inheritdoc}
   */
    public function render()
    {
        $build['table'] = parent::render();

        $total = $this->getStorage()
        ->getQuery()
        ->accessCheck(false)
        ->count()
        ->execute();

        $build['summary']['#markup'] = $this->t('Total events: @total', ['@total' => $total]);
        return $build;
    }

  /**
   * {@inheritdoc}
   */
    public function buildHeader()
    {
        $header['id'] = $this->t('ID');
        $header['label'] = $this->t('Label');
        return $header + parent::buildHeader();
    }

  /**
   * {@inheritdoc}
   */
    public function buildRow(EntityInterface $entity)
    {
      /** @var \Drupal\event\EventInterface $entity */
        $row['id'] = $entity->id();
        $row['label'] = $entity->toLink();
        return $row + parent::buildRow($entity);
    }
}
