<?php

namespace Drupal\about\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining About entity entities.
 *
 * @ingroup about
 */
interface AboutEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the About entity name.
   *
   * @return string
   *   Name of the About entity.
   */
  public function getName();

  /**
   * Sets the About entity name.
   *
   * @param string $name
   *   The About entity name.
   *
   * @return \Drupal\about\Entity\AboutEntityInterface
   *   The called About entity entity.
   */
  public function setName($name);

  /**
   * Gets the About entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the About entity.
   */
  public function getCreatedTime();

  /**
   * Sets the About entity creation timestamp.
   *
   * @param int $timestamp
   *   The About entity creation timestamp.
   *
   * @return \Drupal\about\Entity\AboutEntityInterface
   *   The called About entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Gets the About entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the About entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\about\Entity\AboutEntityInterface
   *   The called About entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the About entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the About entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\about\Entity\AboutEntityInterface
   *   The called About entity entity.
   */
  public function setRevisionUserId($uid);

}
