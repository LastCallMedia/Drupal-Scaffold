<?php

namespace Drupal\pattern_lib_test_theme\Style;

use Drupal\pattern_lib\Pattern;
use Drupal\pattern_lib\PatternProviderInterface;

/**
 * Patterns for the test theme.
 */
class Patterns implements PatternProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getPatterns() {
    return [
      Pattern::atom('foo', 'Bar', ['#markup' => 'This is the foo pattern'], 'Foo pattern'),
    ];
  }

}
