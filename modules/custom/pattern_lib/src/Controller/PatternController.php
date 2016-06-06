<?php

namespace Drupal\pattern_lib\Controller;


use Drupal\Component\Utility\SafeMarkup;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\RendererInterface;
use Drupal\pattern_lib\PatternManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for pattern pages.
 */
class PatternController extends ControllerBase {

  private $manager;

  private $renderer;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('pattern_lib.manager'),
      $container->get('renderer')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(PatternManager $manager, RendererInterface $renderer) {
    $this->manager = $manager;
    $this->renderer = $renderer;
  }

  /**
   * Serve a list of patterns.
   */
  public function indexAction() {
    return [
      '#theme' => 'pattern_list',
      '#render' => TRUE,
      '#patterns' => $this->manager->getPatternsGrouped(),
    ];
  }

  /**
   * Serve a single pattern.
   */
  public function patternAction($patternId) {
    if ($pattern = $this->manager->getPattern($patternId)) {
      $render = $pattern->getRender();
      $html = $this->renderer->render($render);
      return [
        'html' => [
          '#type' => 'details',
          '#title' => $this->t('Markup'),
          '#markup' => '<pre><code>' . SafeMarkup::checkPlain($html) . '</code></pre>',
        ],
        'pattern' => $pattern->getRender(),
      ];
    }
    return [];
  }

  /**
   * Title callback for when viewing a pattern.
   */
  public function patternTitle($patternId) {
    if ($pattern = $this->manager->getPattern($patternId)) {
      return $pattern->getName();
    }
  }

}
