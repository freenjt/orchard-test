<?php

namespace Drupal\product_day\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Product of the Day settings.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'product_day_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['product_day.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('product_day.settings');

    $form['block_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Block Title'),
      '#default_value' => $config->get('block_title'),
    ];

    $form['admin_email'] = [
      '#type' => 'email',
      '#title' => $this->t('Admin Email'),
      '#default_value' => $config->get('admin_email'),
      '#required' => TRUE,
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('product_day.settings')
      ->set('block_title', $form_state->getValue('block_title'))
      ->set('admin_email', $form_state->getValue('admin_email'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
