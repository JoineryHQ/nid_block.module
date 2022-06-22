<?php
namespace Drupal\nid_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Markup;

/**
 * Provides a 'DefaultBlock' block.
 *
 * @Block(
 *  id = "nid_block",
 *  admin_label = @Translation("Node by url nid"),
 * )
 */
class NidBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return [
    ] + parent::defaultConfiguration();
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    $this->configuration['label'] = '';
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $build = [];
    $request = \Drupal::request();
    $nid = $request->query->get('nid');
    $entity_type = 'node';
    $view_mode = 'full';

    $view_builder = \Drupal::entityTypeManager()->getViewBuilder($entity_type);
    $storage = \Drupal::entityTypeManager()->getStorage($entity_type);
    $node = $storage->load($nid);
    $build = $view_builder->view($node, $view_mode);
    return $build;
    
  }

  /**
   * @return int
   */
  public function getCacheMaxAge() {
    return 0;
  }
  
}
