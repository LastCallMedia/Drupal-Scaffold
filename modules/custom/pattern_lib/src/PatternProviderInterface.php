<?php

namespace Drupal\pattern_lib;

/**
 * Defines a class that provides patterns.
 */
interface PatternProviderInterface {

  /**
   * Get a list of patterns.
   *
   * @return Pattern[]
   *   Patterns
   */
  public function getPatterns();

}
