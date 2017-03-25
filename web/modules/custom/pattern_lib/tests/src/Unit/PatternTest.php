<?php

namespace Drupal\pattern_lib\Tests\Unit;

use Drupal\pattern_lib\Pattern;

/**
 * Tests for the Pattern class.
 */
class PatternTest extends \PHPUnit_Framework_TestCase {

  /**
   * Test atom creation.
   */
  public function testAtomCreation() {
    $atom = Pattern::atom('foo', 'Bar', [], 'Baz');
    $this->assertEquals('foo', $atom->getId());
    $this->assertEquals('Bar', $atom->getName());
    $this->assertEquals([], $atom->getRender());
    $this->assertEquals('Baz', $atom->getDescription());
  }

  /**
   * Test molecule creation.
   */
  public function testMoleculeCreation() {
    $molecule = Pattern::molecule('foo', 'Bar', [], 'Baz');
    $this->assertEquals('foo', $molecule->getId());
    $this->assertEquals('Bar', $molecule->getName());
    $this->assertEquals([], $molecule->getRender());
    $this->assertEquals('Baz', $molecule->getDescription());
  }

  /**
   * Test element creation.
   */
  public function testElementCreation() {
    $element = Pattern::element('foo', 'Bar', [], 'Baz');
    $this->assertEquals('foo', $element->getId());
    $this->assertEquals('Bar', $element->getName());
    $this->assertEquals([], $element->getRender());
    $this->assertEquals('Baz', $element->getDescription());
  }

  /**
   * Test rendering with a callback.
   */
  public function testGetRenderForCallback() {
    $cb = function () {
      return 'I rendered';
    };
    $atom = Pattern::atom('foo', 'Bar', $cb, 'Baz');
    $this->assertEquals('I rendered', $atom->getRender());
  }

}
