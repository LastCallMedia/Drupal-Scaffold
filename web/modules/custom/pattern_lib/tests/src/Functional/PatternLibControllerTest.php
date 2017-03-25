<?php

namespace Drupal\pattern_lib\Tests\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests for the pattern lib controller.
 */
class PatternLibControllerTest extends BrowserTestBase {

  public static $modules = ['pattern_lib'];

  /**
   * {@inheritdoc}
   */
  public function installDrupal() {
    parent::installDrupal();
    /** @var \Drupal\Core\Extension\ThemeInstallerInterface $theme_installer */
    $theme_installer = $this->container->get('theme_installer');
    $theme_installer->install(['pattern_lib_test_theme']);
    $theme_config = $this->config('system.theme');
    $theme_config->set('default', 'pattern_lib_test_theme');
    $theme_config->save();
    $this->rebuildContainer();
  }

  /**
   * Check controller responses.
   */
  public function testController() {
    $this->drupalGet('/patterns');
    $this->assertSession()->statusCodeEquals(403);

    $account = $this->drupalCreateUser(['access patterns']);
    $this->drupalLogin($account);

    $this->drupalGet('/patterns');
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->linkExists('Bar');

    $this->drupalGet('/patterns/foo');
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->elementExists('css', '.patternlib--pattern');
  }

}
