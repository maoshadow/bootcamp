<?php

namespace Drupal\miblog\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Miblog entities.
 */
class MiblogEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
