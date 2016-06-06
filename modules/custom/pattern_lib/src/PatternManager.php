<?php


namespace Drupal\pattern_lib;


use Drupal\Core\Theme\ThemeManagerInterface;

/**
 * Load and determine patterns.
 */
class PatternManager {

  private $themeManager;

  /**
   * PatternManager constructor.
   */
  public function __construct(ThemeManagerInterface $themeManager) {
    $this->themeManager = $themeManager;
  }

  /**
   * Get a list of patterns.
   */
  public function getPatterns() {
    $themeName = $this->themeManager->getActiveTheme()->getName();
    $class = "Drupal\\$themeName\\Style\\Patterns";
    if (class_exists($class)) {
      $instance = new $class();
      if ($instance instanceof PatternProviderInterface) {
        return $instance->getPatterns();
      }
    }
    return [];
  }

  /**
   * Get a list of patterns, grouped by type.
   */
  public function getPatternsGrouped() {
    $groups = [
      'atom' => [],
      'molecule' => [],
      'element' => [],
    ];
    foreach ($this->getPatterns() as $pattern) {
      $groups[$pattern->getType()][] = $pattern;
    }
    return $groups;
  }

  /**
   * Get a single pattern.
   */
  public function getPattern($id) {
    foreach ($this->getPatterns() as $pattern) {
      if ($pattern->getId() === $id) {
        return $pattern;
      }
    }
  }

}
