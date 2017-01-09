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

  protected static $sizes = [
    'tiny',
    'small',
    'large',
  ];
  protected static $colors = [
    'primary',
    'secondary',
    'success',
    'alert',
    'warning',
  ];

  /**
   * {@inheritdoc}
   */
  public function getPatterns() {
    $patterns = [];
    $patterns[] = $this->getStatusMessagePattern();
    $patterns[] = $this->getTypographyPattern();
    $patterns[] = $this->getListsPattern();
    $patterns[] = $this->getButtonsPattern();
    $patterns[] = $this->getFormsPattern();
    $patterns[] = $this->getPagerPattern();
    $patterns[] = $this->getTablePattern();
    return $patterns;
  }

  /**
   * Pattern for <h> elements.
   */
  private function getTypographyPattern() {
    $markup = '';
    foreach (range(1, 5) as $i) {
      $markup .= "<h{$i}>Header $i</h{$i}>\n";
    }
    $markup .= "<div><a href=\"#\">Link</a></div>\n";
    $markup .= "<div><p>This is paragraph text!</p></div>\n";
    $markup .= "<div><blockquote>Blockquotes are the best. <cite>Abraham Lincoln</cite></blockquote></div>\n";
    $markup .= "<div><hr /></div>\n";
    return Pattern::atom('typography', 'Typography', [
      '#markup' => $markup,
    ]);
  }

  /**
   * OL and UL.
   */
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
      ],
    ]);
  }

  /**
   * Buttons.
   */
  private function getButtonsPattern() {
    $buttons = [];
    $hollow_colors = array_map(function ($color) {
      return $color . ' hollow';
    }, self::$colors);
    $variants = array_merge(
      self::$colors,
      $hollow_colors,
      self::$sizes,
      ['expanded', 'expanded small']
    );
    foreach ($variants as $variant) {
      $buttons[] = [
        '#type' => 'button',
        '#value' => 'Button ' . $variant,
        '#attributes' => ['class' => ['button', $variant]],
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

  /**
   * Forms.
   */
  private function getFormsPattern() {
    $elements[] = [
      '#type' => 'textfield',
      '#title' => 'Textfield',
    ];
    $elements[] = [
      '#type' => 'email',
      '#title' => 'E-Mail',
    ];
    $elements[] = [
      '#type' => 'password',
      '#title' => 'Password',
    ];
    $elements[] = [
      '#type' => 'search',
      '#title' => 'Search',
    ];
    $elements[] = [
      '#type' => 'number',
      '#title' => 'Number',
    ];
    $elements[] = [
      '#type' => 'tel',
      '#title' => 'Telephone',
    ];
    $elements[] = [
      '#type' => 'url',
      '#title' => 'URL',
    ];
    $elements[] = [
      '#type' => 'date',
      '#title' => 'Date',
    ];
    $elements[] = [
      '#type' => 'file',
      '#title' => 'File',
    ];
    $elements[] = [
      '#type' => 'select',
      '#title' => 'Select',
      '#options' => [
        'Option 1', 'Option 2',
      ],
    ];
    $elements[] = [
      '#type' => 'textarea',
      '#title' => 'Textarea',
    ];
    $elements[] = [
      '#type' => 'fieldset',
      '#title' => 'fieldset',
      'content' => [
        '#markup' => 'content',
      ],
    ];

    return Pattern::atom('forms', 'Forms', $elements);
  }

  /**
   * Tables.
   */
  private function getTablePattern() {
    return Pattern::atom('table', 'Tables', [
      '#type' => 'table',
      '#header' => ['Column 1', 'Column 2', 'Column 3'],
      '#rows' => [
        ['Row 1', 'Row 1', 'Row 1'],
        ['Row 2', 'Row 2', 'Row 2'],
      ],
    ]);
  }

  /**
   * Pager.
   */
  private function getPagerPattern() {
    pager_default_initialize(50, 5, 2);
    return Pattern::molecule('pager', 'Pager', [
      '#type' => 'pager',
      '#element' => 2,
    ]);
  }

}
