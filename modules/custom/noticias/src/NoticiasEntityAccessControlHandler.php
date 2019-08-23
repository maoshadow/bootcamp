<?php

namespace Drupal\noticias;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Noticias entity.
 *
 * @see \Drupal\noticias\Entity\NoticiasEntity.
 */
class NoticiasEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\noticias\Entity\NoticiasEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished noticias entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published noticias entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit noticias entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete noticias entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add noticias entities');
  }

}
