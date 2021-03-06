<?php
/**
 * @file
 * Contains \Drupal\atlas\Plugin\Preprocess\Input.
 */

namespace Drupal\atlas\Plugin\Preprocess;

use Drupal\bootstrap\Annotation\BootstrapPreprocess;
use Drupal\bootstrap\Utility\Element;
use Drupal\bootstrap\Utility\Variables;
use Drupal\bootstrap\Plugin\Preprocess\PreprocessInterface;
use Drupal\bootstrap\Plugin\Preprocess\PreprocessBase;

/**
 * Pre-processes variables for the "select" theme hook.
 *
 * @ingroup plugins_preprocess
 *
 * @BootstrapPreprocess("select")
 */
class Select extends PreprocessBase implements PreprocessInterface {

  /**
   * {@inheritdoc}
   */
  public function preprocessElement(Element $element, Variables $variables) {
    // Create variables for #input_group and #input_group_button flags.
    $variables['input_group'] = $element->getProperty('input_group') || $element->getProperty('input_group_button');

    // Map the element properties.
    $variables->map([
      'attributes' => 'attributes',
      'field_prefix' => 'prefix',
      'field_suffix' => 'suffix',
    ]);
    if(!(is_null($element->getProperty('option_attributes')))) {
        $variables['option_attributes'] = $element->getProperty('option_attributes');
    }

    // Ensure attributes are proper objects.
    $this->preprocessAttributes();
  }

}
