<?php

/**
 * @file
 * Contains about_entity.page.inc.
 *
 * Page callback for About entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for About entity templates.
 *
 * Default template: about_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_about_entity(array &$variables) {
  // Fetch AboutEntity Entity Object.
  $about_entity = $variables['elements']['#about_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
