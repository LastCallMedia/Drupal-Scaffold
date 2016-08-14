/**
 * @file
 * Sitewide javascript behaviors.
 */
(function ($) {
  'use strict';

  /**
   * Attach and detach Foundation JS.
   */
  Drupal.behaviors.foundation = {
    attach: function (context) {
      $(context).foundation();
    }
  };

})(jQuery);

//# sourceMappingURL=../maps/scaffold.js.map
