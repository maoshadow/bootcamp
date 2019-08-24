<?php

namespace Drupal\about\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for About entity entities.
 */
class AboutEntityViewsData extends EntityViewsData {

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
