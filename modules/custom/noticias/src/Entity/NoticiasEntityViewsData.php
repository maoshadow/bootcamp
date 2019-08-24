<?php

namespace Drupal\noticias\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Noticias entities.
 */
class NoticiasEntityViewsData extends EntityViewsData {

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
