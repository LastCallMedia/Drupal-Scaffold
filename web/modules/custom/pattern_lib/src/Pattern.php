<?php

namespace Drupal\pattern_lib;

/**
 * Definition of a single pattern.
 */
class Pattern {

  private $id;
  private $name;
  private $type;
  private $description;
  private $render;

  /**
   * Create a new atom pattern.
   */
  public static function atom($id, $name, $render = [], $description = '') {
    return new static($id, $name, 'atom', $render, $description);
  }

  /**
   * Create a new molecule pattern.
   */
  public static function molecule($id, $name, $render = [], $description = '') {
    return new static($id, $name, 'molecule', $render, $description);
  }

  /**
   * Create a new element pattern.
   */
  public static function element($id, $name, $render = [], $description = '') {
    return new static($id, $name, 'element', $render, $description);
  }

  /**
   * Pattern constructor.
   */
  protected function __construct($id, $name, $type, $render, $description = '') {
    $this->id = $id;
    $this->name = $name;
    $this->type = $type;
    $this->render = $render;
    $this->description = $description;
  }

  /**
   * Get the id of the pattern.
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Get the name of the pattern.
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Get the type of the pattern.
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Get the description of the pattern.
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * Get the render array for the pattern.
   */
  public function getRender() {
    $render = $this->render;
    if (is_callable($render)) {
      return $render();
    }
    return $render;
  }

}
