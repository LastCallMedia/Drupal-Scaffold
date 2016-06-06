<?php

namespace Drupal\scaffold\Style;

use Drupal\pattern_lib\Pattern;
use Drupal\pattern_lib\PatternProviderInterface;

/**
 * Style pattern declarations for this theme.
 *
 * Patterns are discrete pieces of HTML that can be reused across the site.
 * You can use this class to build a living style guide that updates as your
 * templates and CSS changes.
 *
 * Patterns are either atoms, molecules, or elements.
 *
 * @see http://demo.patternlab.io/
 */
class Patterns implements PatternProviderInterface {

  /**
   * {@inheritdoc}
   */
  public function getPatterns() {
    $patterns = [];
    $patterns[] = $this->getStatusMessagePattern();
    $patterns[] = $this->getTypeographyPattern();
    $patterns[] = $this->getListsPattern();
    $patterns[] = $this->getButtonsPattern();
    return $patterns;
  }

  /**
   * Pattern for <h> elements.
   */
  private function getTypeographyPattern() {
    $markup = '';
    foreach (range(1, 5) as $i) {
      $markup .= '<h' . $i . '>Header ' . $i . '</h' . $i . '>';
    }
    $markup .= '<div><a href="#">Link</a></div>';
    $markup .= '<div><p>This is paragraph text!</p></div>';
    $markup .= '<div><blockquote>Blockquotes are the best. <cite>Abraham Lincoln</cite></blockquote></div>';
    $markup .= '<div><hr /></div>';
    return Pattern::atom('typography', 'Typography', [
      '#markup' => $markup,
    ]);
  }

  private function getListsPattern() {
    return Pattern::atom('lists', 'Lists', [
      'ordered' => [
        '#theme' => 'item_list',
        '#list_type' => 'ol',
        '#items' => ['Item 1', 'Item 2', 'Item 3'],
      ],
      'unordered' => [
        '#theme' => 'item_list',
        '#items' => ['Item 1', 'Item 2', 'Item 3'],
      ]
    ]);
  }

  private function getButtonsPattern() {
    $buttons = [];
    $sizes = ['tiny', 'small', '', 'large', 'expanded', 'small expanded'];
    foreach($sizes as $size) {
      $buttons[] = [
        '#type' => 'button',
        '#value' => 'Button ' . $size,
        '#attributes' => ['class' => [
          'button',
          $size
        ]]
      ];
    }
    $colors = ['secondary', 'success', 'alert', 'warning', 'disabled'];
    foreach($colors as $color) {
      $buttons[] = [
        '#type' => 'button',
        '#value' => 'Button ' . $color,
        '#attributes' => ['class' => [
          'button',
          $color
        ]]
      ];
    }
    return Pattern::atom('buttons', 'Buttons', $buttons);
  }

  /**
   * Pattern for status messages.
   */
  private function getStatusMessagePattern() {
    return Pattern::molecule('alerts', 'Alerts', [
      '#theme' => 'status_messages',
      '#message_list' => [
        'status' => ['Status Message'],
        'warning' => ['Warning Message'],
        'error' => ['Error Message'],
      ],
    ]);
  }

}
