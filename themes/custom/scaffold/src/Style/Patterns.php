<?php

namespace Drupal\scaffold\Style;

use Drupal\pattern_lib\Pattern;
use Drupal\pattern_lib\PatternProviderInterface;

/**
 * Style pattern declarations for this theme.
 *
 * Patterns are discrete pieces of HTML that can be reused across the site.
 * You can use this class to build a living style guide that updates as your
 * templates and CSS changes.
 *
 * Patterns are either atoms, molecules, or elements.
 *
 * @see http://demo.patternlab.io/
 */
class Patterns implements PatternProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getPatterns() {
    $patterns = [];
    $patterns[] = $this->getStatusMessagePattern();
    $patterns[] = $this->getHeaderPattern();
    return $patterns;
  }

  /**
   * Pattern for <h> elements.
   */
  private function getHeaderPattern() {
    $markup = '';
    foreach (range(1, 5) as $i) {
      $markup .= '<h' . $i . '>Header ' . $i . '</h' . $i . '>';
    }
    return Pattern::atom('headers', 'Headers', [
      '#markup' => $markup,
    ]);
  }

  /**
   * Pattern for status messages.
   */
  private function getStatusMessagePattern() {
    return Pattern::atom('alerts', 'Alerts', [
      '#theme' => 'status_messages',
      '#message_list' => [
        'status' => ['Status Message'],
        'warning' => ['Warning Message'],
        'error' => ['Error Message'],
      ],
    ]);
  }

}
