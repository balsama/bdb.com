<?php

namespace Drupal\registration;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the registration entity type.
 */
class RegistrationListBuilder extends EntityListBuilder
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

        $build['summary']['#markup'] = $this->t('Total registrations: @total', ['@total' => $total]);
        return $build;
    }

  /**
   * {@inheritdoc}
   */
    public function buildHeader()
    {
        $header['id'] = $this->t('ID');
        return $header + parent::buildHeader();
    }

  /**
   * {@inheritdoc}
   */
    public function buildRow(EntityInterface $entity)
    {
      /** @var \Drupal\registration\RegistrationInterface $entity */
        $row['id'] = $entity->id();
        return $row + parent::buildRow($entity);
    }
}
