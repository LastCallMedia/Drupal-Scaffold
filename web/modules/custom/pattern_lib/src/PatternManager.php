<?php

namespace Drupal\pattern_lib;

use Drupal\Core\Theme\ActiveTheme;

/**
 * Load and determine patterns.
 */
class PatternManager {

  /**
   * Get a list of patterns.
   */
  public function getPatterns(ActiveTheme $theme) {
    $name = $theme->getName();
    $class = "Drupal\\{$name}\\Style\\Patterns";
    if (class_exists($class)) {
      $instance = new $class();
      if ($instance instanceof PatternProviderInterface) {
        $patterns = $instance->getPatterns();
        uasort($patterns, function (Pattern $a, Pattern $b) {
          return strnatcasecmp($a->getName(), $b->getName());
        });
        return $patterns;
      }
    }
    return [];
  }

  /**
   * Get a list of patterns, grouped by type.
   */
  public function getPatternsGrouped(ActiveTheme $theme) {
    $groups = [
      'atom' => [],
      'molecule' => [],
      'element' => [],
    ];
    foreach ($this->getPatterns($theme) as $pattern) {
      $groups[$pattern->getType()][] = $pattern;
    }
    return $groups;
  }

  /**
   * Get a single pattern.
   */
  public function getPattern(ActiveTheme $theme, $id) {
    foreach ($this->getPatterns($theme) as $pattern) {
      if ($pattern->getId() === $id) {
        return $pattern;
      }
    }
  }

}
