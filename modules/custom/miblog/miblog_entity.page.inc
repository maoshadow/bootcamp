<?php

/**
 * @file
 * Contains miblog_entity.page.inc.
 *
 * Page callback for Miblog entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Miblog templates.
 *
 * Default template: miblog_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_miblog_entity(array &$variables) {
  // Fetch MiblogEntity Entity Object.
  $miblog_entity = $variables['elements']['#miblog_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
