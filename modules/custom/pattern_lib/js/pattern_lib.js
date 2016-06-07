
(function ($, Drupal) {

  'use strict';

  Drupal.behaviors.patternLibrary = {
    attach: function (context) {
      $('[data-pattern]', context).each(function () {
        var $pattern = $(this);
        var $trigger = $('<a class="pattern-toggle">Edit</a>');
        $pattern
          .wrapInner('<div class="pattern-content"></div>')
          .append($trigger);

        var $content = $pattern.find('.pattern-content');
        $pattern.on('pattern.edit', function (e) {
          var html = $content.html();
          var area = $('<textarea></textarea>').val(html);
          $content.html(area);
          $trigger.text('View');
        });
        $pattern.on('pattern.save', function (e) {
          var html = $content.find('textarea').val();
          $content.html(html);
          $trigger.text('Edit');
        });

        $trigger.click(function () {
          if ($pattern.hasClass('editing')) {
            $pattern.trigger('pattern.save').removeClass('editing');
          }
          else {
            $pattern.trigger('pattern.edit').addClass('editing');
          }
        });

      });
    }
  };

})(jQuery, Drupal);
