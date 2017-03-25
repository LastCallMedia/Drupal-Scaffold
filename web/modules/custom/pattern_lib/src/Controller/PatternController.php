<?php

namespace Drupal\pattern_lib\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\RendererInterface;
use Drupal\Core\Theme\ThemeManagerInterface;
use Drupal\pattern_lib\PatternManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for pattern pages.
 */
class PatternController extends ControllerBase {

  private $manager;

  private $renderer;

  private $themeManager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('pattern_lib.manager'),
      $container->get('renderer'),
      $container->get('theme.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(PatternManager $manager, RendererInterface $renderer, ThemeManagerInterface $themeManager) {
    $this->manager = $manager;
    $this->renderer = $renderer;
    $this->themeManager = $themeManager;
  }

  /**
   * Serve a list of patterns.
   */
  public function indexAction() {
    $theme = $this->themeManager->getActiveTheme();

    return [
      '#theme' => 'pattern_list',
      '#render' => TRUE,
      '#patterns' => $this->manager->getPatternsGrouped($theme),
    ];
  }

  /**
   * Serve a single pattern.
   */
  public function patternAction($patternId) {
    $theme = $this->themeManager->getActiveTheme();
    if ($pattern = $this->manager->getPattern($theme, $patternId)) {
      $render = $pattern->getRender();
      $render['#theme_wrappers'][] = 'pattern';
      return $render;
    }
    return [];
  }

  /**
   * Title callback for when viewing a pattern.
   */
  public function patternTitle($patternId) {
    $theme = $this->themeManager->getActiveTheme();
    if ($pattern = $this->manager->getPattern($theme, $patternId)) {
      return $pattern->getName();
    }
  }

}
