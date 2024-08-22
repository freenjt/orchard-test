<?php

declare(strict_types=1);

namespace Drupal\product_day\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the product entity edit forms.
 */
final class ProductForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);

    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#default_value' => $this->entity->get('name')->value,
      '#required' => TRUE,
    ];

    $form['summary'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Summary'),
      '#default_value' => $this->entity->get('summary')->value,
    ];

    $form['image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#default_value' => isset($this->entity->image->target_id) ? [$this->entity->image->target_id] : [],
      '#upload_location' => 'public://product_images/',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg'],
        // 1MB in bytes (1MB = 1024 * 1024 bytes)
        'file_validate_size' => [1048576],
      ],
      '#required' => TRUE,
    ];

    $form['flag'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Is Product of the Day'),
      '#default_value' => $this->entity->get('flag')->value,
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state): int {
    $result = parent::save($form, $form_state);

    $message_args = ['%label' => $this->entity->toLink()->toString()];
    $logger_args = [
      '%label' => $this->entity->label(),
      'link' => $this->entity->toLink($this->t('View'))->toString(),
    ];

    switch ($result) {
      case SAVED_NEW:
        $this->messenger()
          ->addStatus($this->t('New product %label has been created.', $message_args));
        $this->logger('product_day')
          ->notice('New product %label has been created.', $logger_args);
        break;

      case SAVED_UPDATED:
        $this->messenger()
          ->addStatus($this->t('The product %label has been updated.', $message_args));
        $this->logger('product_day')
          ->notice('The product %label has been updated.', $logger_args);
        break;

      default:
        throw new \LogicException('Could not save the entity.');
    }

    $form_state->setRedirectUrl($this->entity->toUrl());

    return $result;
  }

}
