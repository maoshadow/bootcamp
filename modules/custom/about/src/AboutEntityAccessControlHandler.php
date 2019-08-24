<?php

namespace Drupal\about;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the About entity entity.
 *
 * @see \Drupal\about\Entity\AboutEntity.
 */
class AboutEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\about\Entity\AboutEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished about entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published about entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit about entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete about entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add about entity entities');
  }

}
