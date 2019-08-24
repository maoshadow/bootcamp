<?php

namespace Drupal\miblog;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Miblog entity.
 *
 * @see \Drupal\miblog\Entity\MiblogEntity.
 */
class MiblogEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\miblog\Entity\MiblogEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished miblog entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published miblog entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit miblog entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete miblog entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add miblog entities');
  }

}
