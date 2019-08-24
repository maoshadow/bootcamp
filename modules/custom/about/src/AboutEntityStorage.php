<?php

namespace Drupal\about;

use Drupal\Core\Entity\Sql\SqlContentEntityStorage;
use Drupal\Core\Session\AccountInterface;
use Drupal\about\Entity\AboutEntityInterface;

/**
 * Defines the storage handler class for About entity entities.
 *
 * This extends the base storage class, adding required special handling for
 * About entity entities.
 *
 * @ingroup about
 */
class AboutEntityStorage extends SqlContentEntityStorage implements AboutEntityStorageInterface {

  /**
   * {@inheritdoc}
   */
  public function revisionIds(AboutEntityInterface $entity) {
    return $this->database->query(
      'SELECT vid FROM {about_entity_revision} WHERE id=:id ORDER BY vid',
      [':id' => $entity->id()]
    )->fetchCol();
  }

  /**
   * {@inheritdoc}
   */
  public function userRevisionIds(AccountInterface $account) {
    return $this->database->query(
      'SELECT vid FROM {about_entity_field_revision} WHERE uid = :uid ORDER BY vid',
      [':uid' => $account->id()]
    )->fetchCol();
  }

}
