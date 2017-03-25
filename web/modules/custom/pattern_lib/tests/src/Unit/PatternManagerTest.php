<?php

namespace Drupal\pattern_lib\Tests\Unit;

use Drupal\Core\Theme\ActiveTheme;
use Drupal\pattern_lib\Pattern;
use Drupal\pattern_lib\PatternManager;
use Drupal\pattern_lib\PatternProviderInterface;
use Drupal\Tests\UnitTestCase;

/**
 * Tests for PatternManager.
 */
class PatternManagerTest extends UnitTestCase {

  /**
   * Return an example pattern.
   */
  public static function exampleAtom() {
    return Pattern::atom('foo', 'Bar', [], 'Baz');
  }

  /**
   * Test calling for all patterns on a theme that won't have any.
   */
  public function testGetPatternsForEmptyTheme() {
    $manager = new PatternManager();
    $theme = new ActiveTheme(['name' => 'pattern_lib_test_empty_theme']);
    $this->assertEquals([], $manager->getPatterns($theme));
  }

  /**
   * Test calling for all patterns.
   */
  public function testGetPatterns() {
    $theme_name = 'pattern_lib_test_' . __FUNCTION__;
    class_alias(TestPatterns::class, "Drupal\\{$theme_name}\\Style\\Patterns");
    $theme = new ActiveTheme(['name' => $theme_name]);
    $manager = new PatternManager();

    $patterns = $manager->getPatterns($theme);
    $this->assertCount(1, $patterns);
    $this->assertEquals(
      self::exampleAtom(),
      $patterns[0]
    );
  }

  /**
   * Test calling for grouped patterns.
   */
  public function testGetPatternsGrouped() {
    $theme_name = 'pattern_lib_test_' . __FUNCTION__;
    class_alias(TestPatterns::class, "Drupal\\{$theme_name}\\Style\\Patterns");
    $theme = new ActiveTheme(['name' => $theme_name]);
    $manager = new PatternManager();

    $patterns = $manager->getPatternsGrouped($theme);
    $this->assertEquals([self::exampleAtom()], $patterns['atom']);
    $this->assertEquals([], $patterns['molecule']);
    $this->assertEquals([], $patterns['element']);
  }

  /**
   * Test calling for a pattern by ID.
   */
  public function testGetPattern() {
    $theme_name = 'pattern_lib_test_' . __FUNCTION__;
    class_alias(TestPatterns::class, "Drupal\\{$theme_name}\\Style\\Patterns");
    $theme = new ActiveTheme(['name' => $theme_name]);
    $manager = new PatternManager();

    $this->assertEquals(self::exampleAtom(), $manager->getPattern($theme, 'foo'));
  }

  /**
   * Test calling for a nonexistant pattern.
   */
  public function testGetNonexistantPattern() {
    $theme_name = 'pattern_lib_test_' . __FUNCTION__;
    class_alias(TestPatterns::class, "Drupal\\{$theme_name}\\Style\\Patterns");
    $theme = new ActiveTheme(['name' => $theme_name]);
    $manager = new PatternManager();

    $this->assertEquals(FALSE, $manager->getPattern($theme, 'bar'));
  }

}


/**
 * Stub pattern class to be aliased.
 */
class TestPatterns implements PatternProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getPatterns() {
    return [
      Pattern::atom('foo', 'Bar', [], 'Baz'),
    ];
  }

}
