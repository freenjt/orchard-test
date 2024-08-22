<?php

declare(strict_types=1);

namespace Drupal\product_day\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Database\Connection;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a product of the day block.
 *
 * @Block(
 *   id = "product_day_block",
 *   admin_label = @Translation("Product of the Day Block"),
 *   category = @Translation("Custom"),
 * )
 */
final class ProductDayBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Constructs the plugin instance.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    private readonly Connection $connection,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition): self {
    return new self(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('database'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $product_id = $this->connection->select('product', 'p')
      ->fields('p', ['id'])
      ->condition('flag', 1)
      ->orderRandom()
      ->range(0, 1)
      ->execute()
      ->fetchField();

    $product = \Drupal::entityTypeManager()
      ->getStorage('product')
      ->load($product_id);

    $title = \Drupal::config('product_day.settings')->get('block_title') ?? '';

    if ($product) {
      return [
        '#theme' => 'product_day_block',
        '#product' => $product,
        '#title' => $title,
        '#cache' => [
          // No caching context.
          'contexts' => ['url'],
          // No cache tags.
          'tags' => [],
          // No cache lifetime.
          'max-age' => 0,
        ],
      ];
    }

    return [];
  }

}
