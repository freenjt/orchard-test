<?php

declare(strict_types=1);

namespace Drupal\product_day\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\product_day\ProductInterface;

/**
 * Defines the product entity class.
 *
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product"),
 *   label_collection = @Translation("Products"),
 *   label_singular = @Translation("product"),
 *   label_plural = @Translation("products"),
 *   label_count = @PluralTranslation(
 *     singular = "@count products",
 *     plural = "@count products",
 *   ),
 *   handlers = {
 *     "list_builder" = "Drupal\product_day\ProductListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData",
 *     "form" = {
 *       "add" = "Drupal\product_day\Form\ProductForm",
 *       "edit" = "Drupal\product_day\Form\ProductForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "delete-multiple-confirm" =
 *   "Drupal\Core\Entity\Form\DeleteMultipleForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "product",
 *   admin_permission = "administer product",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "id",
 *     "uuid" = "uuid",
 *   },
 *   links = {
 *     "collection" = "/admin/content/product",
 *     "add-form" = "/product/add",
 *     "canonical" = "/product/{product}",
 *     "edit-form" = "/product/{product}/edit",
 *     "delete-form" = "/product/{product}/delete",
 *     "delete-multiple-form" = "/admin/content/product/delete-multiple",
 *   },
 * )
 */
final class Product extends ContentEntityBase implements ProductInterface {

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setRequired(TRUE);

    $fields['summary'] = BaseFieldDefinition::create('text')
      ->setLabel(t('Summary'))
      ->setRequired(TRUE);

    $fields['image'] = BaseFieldDefinition::create('image')
      ->setLabel(t('Image'))
      ->setRequired(TRUE)
      ->setSettings([
        'file_extensions' => 'png jpg jpeg',
        'max_files' => 1,
      ]);

    $fields['flag'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Flag'))
      ->setDefaultValue(FALSE);

    return $fields;
  }

}
