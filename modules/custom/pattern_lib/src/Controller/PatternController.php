<?php

namespace Drupal\pattern_lib\Controller;


use Drupal\Core\Controller\ControllerBase;
use Drupal\pattern_lib\PatternManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for pattern pages.
 */
class PatternController extends ControllerBase {

  private $manager;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('pattern_lib.manager'));
  }

  /**
   * {@inheritdoc}
   */
  public function __construct(PatternManager $manager) {
    $this->manager = $manager;
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
      return $pattern->getRender();
    }
    return [];
  }

}
