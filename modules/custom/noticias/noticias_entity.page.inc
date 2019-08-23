<?php

/**
 * @file
 * Contains noticias_entity.page.inc.
 *
 * Page callback for Noticias entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Noticias templates.
 *
 * Default template: noticias_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_noticias_entity(array &$variables) {
  // Fetch NoticiasEntity Entity Object.
  $noticias_entity = $variables['elements']['#noticias_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
