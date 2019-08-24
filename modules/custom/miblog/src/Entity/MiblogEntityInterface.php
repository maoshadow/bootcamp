<?php

namespace Drupal\miblog\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Miblog entities.
 *
 * @ingroup miblog
 */
interface MiblogEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Miblog name.
   *
   * @return string
   *   Name of the Miblog.
   */
  public function getName();

  /**
   * Sets the Miblog name.
   *
   * @param string $name
   *   The Miblog name.
   *
   * @return \Drupal\miblog\Entity\MiblogEntityInterface
   *   The called Miblog entity.
   */
  public function setName($name);

  /**
   * Gets the Miblog creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Miblog.
   */
  public function getCreatedTime();

  /**
   * Sets the Miblog creation timestamp.
   *
   * @param int $timestamp
   *   The Miblog creation timestamp.
   *
   * @return \Drupal\miblog\Entity\MiblogEntityInterface
   *   The called Miblog entity.
   */
  public function setCreatedTime($timestamp);

}
