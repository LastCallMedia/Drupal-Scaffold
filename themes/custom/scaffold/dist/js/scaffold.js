/**
 * @file
 * Sitewide javascript behaviors.
 */
(function ($) {

  /**
   * Attach and detach Foundation JS.
   */
  Drupal.behaviors.foundation = {
    attach: function(context) {
      $(context).foundation();
    },
    detach: function(context) {
      $(context).foundation('destroy');
    }
  }

})(jQuery);

//# sourceMappingURL=../maps/scaffold.js.map
