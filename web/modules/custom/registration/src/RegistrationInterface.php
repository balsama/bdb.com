<?php

namespace Drupal\registration;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a registration entity type.
 */
interface RegistrationInterface extends ContentEntityInterface, EntityOwnerInterface
{
}
