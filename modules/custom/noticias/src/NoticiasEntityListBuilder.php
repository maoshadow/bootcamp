<?php

namespace Drupal\noticias;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Noticias entities.
 *
 * @ingroup noticias
 */
class NoticiasEntityListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Noticias ID');
    $header['name'] = $this->t('Name');
    $header['status'] = $this->t('Status');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\noticias\Entity\NoticiasEntity $entity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.noticias_entity.edit_form',
      ['noticias_entity' => $entity->id()]
    );
    $row['status'] = $entity->getStatusName();
    return $row + parent::buildRow($entity);
  }

}
