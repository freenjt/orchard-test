<?php

declare(strict_types=1);

namespace Drupal\product_day;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for the product entity type.
 */
final class ProductListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader(): array {
    $header['id'] = $this->t('ID');
    $header['name'] = $this->t('Name');
    $header['flag'] = $this->t('Is Product of the day');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity): array {
    /** @var \Drupal\product_day\ProductInterface $entity */
    $row['id'] = $entity->toLink();
    $row['name'] = $entity->get('name')->value;
    $row['flag'] = $entity->get('flag')->value > 0 ? $this->t('Yes') : $this->t('No');
    return $row + parent::buildRow($entity);
  }

}
