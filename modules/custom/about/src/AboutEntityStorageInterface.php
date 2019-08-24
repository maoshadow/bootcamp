<?php

namespace Drupal\about;

use Drupal\Core\Entity\ContentEntityStorageInterface;
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
interface AboutEntityStorageInterface extends ContentEntityStorageInterface {

  /**
   * Gets a list of About entity revision IDs for a specific About entity.
   *
   * @param \Drupal\about\Entity\AboutEntityInterface $entity
   *   The About entity entity.
   *
   * @return int[]
   *   About entity revision IDs (in ascending order).
   */
  public function revisionIds(AboutEntityInterface $entity);

  /**
   * Gets a list of revision IDs having a given user as About entity author.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The user entity.
   *
   * @return int[]
   *   About entity revision IDs (in ascending order).
   */
  public function userRevisionIds(AccountInterface $account);

}
