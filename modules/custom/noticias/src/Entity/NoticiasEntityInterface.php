<?php

namespace Drupal\noticias\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Noticias entities.
 *
 * @ingroup noticias
 */
interface NoticiasEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Noticias name.
   *
   * @return string
   *   Name of the Noticias.
   */
  public function getName();

  /**
   * Sets the Noticias name.
   *
   * @param string $name
   *   The Noticias name.
   *
   * @return \Drupal\noticias\Entity\NoticiasEntityInterface
   *   The called Noticias entity.
   */
  public function setName($name);

  /**
   * Gets the Noticias creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Noticias.
   */
  public function getCreatedTime();

  /**
   * Sets the Noticias creation timestamp.
   *
   * @param int $timestamp
   *   The Noticias creation timestamp.
   *
   * @return \Drupal\noticias\Entity\NoticiasEntityInterface
   *   The called Noticias entity.
   */
  public function setCreatedTime($timestamp);

}
