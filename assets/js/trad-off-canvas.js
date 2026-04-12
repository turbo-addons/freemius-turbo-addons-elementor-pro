/* global jQuery */
(function ($) {
  'use strict';

  function initOffCanvas(wrapper) {
    if (!wrapper) return;

    var $wrapper = $(wrapper);
    var $trigger = $wrapper.find('.trad-offcanvas-trigger');
    var $panel = $wrapper.find('.trad-offcanvas-panel');
    var $overlay = $wrapper.find('.trad-offcanvas-overlay');
    var $closeBtn = $wrapper.find('.trad-offcanvas-close');
    
    var position = $wrapper.data('position');
    var hasOverlay = $wrapper.data('overlay');
    var closeOnOverlay = $wrapper.data('close-overlay');
    var closeOnEsc = $wrapper.data('close-esc');
    var customTrigger = $wrapper.data('custom-trigger');

    // Unbind previous events to prevent double binding
    $trigger.off('click.tradOffCanvas');
    $closeBtn.off('click.tradOffCanvas');
    $overlay.off('click.tradOffCanvas');

    // Set panel width/height as CSS variable for push/reveal animations
    if (position === 'left' || position === 'right') {
      var panelWidth = $panel.outerWidth();
      $wrapper.css('--trad-canvas-width', panelWidth + 'px');
    } else {
      var panelHeight = $panel.outerHeight();
      $wrapper.css('--trad-canvas-height', panelHeight + 'px');
    }

    // Open off-canvas
    function openOffCanvas() {
      $wrapper.addClass('trad-active');
      $('body').addClass('trad-offcanvas-open');
      
      // Update CSS variables on open (in case of responsive changes)
      if (position === 'left' || position === 'right') {
        $wrapper.css('--trad-canvas-width', $panel.outerWidth() + 'px');
      } else {
        $wrapper.css('--trad-canvas-height', $panel.outerHeight() + 'px');
      }
    }

    // Close off-canvas
    function closeOffCanvas() {
      $wrapper.removeClass('trad-active');
      $('body').removeClass('trad-offcanvas-open');
    }

    // Trigger click
    $trigger.on('click.tradOffCanvas', function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      if ($wrapper.hasClass('trad-active')) {
        closeOffCanvas();
      } else {
        openOffCanvas();
      }
    });

    // Custom trigger
    if (customTrigger) {
      $(document).off('click.tradOffCanvas', customTrigger);
      $(document).on('click.tradOffCanvas', customTrigger, function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        if ($wrapper.hasClass('trad-active')) {
          closeOffCanvas();
        } else {
          openOffCanvas();
        }
      });
    }

    // Close button click
    $closeBtn.on('click.tradOffCanvas', function(e) {
      e.preventDefault();
      e.stopPropagation();
      closeOffCanvas();
    });

    // Overlay click
    if (hasOverlay && closeOnOverlay) {
      $overlay.on('click.tradOffCanvas', function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeOffCanvas();
      });
    }

    // ESC key
    if (closeOnEsc) {
      $(document).off('keydown.tradOffCanvas');
      $(document).on('keydown.tradOffCanvas', function(e) {
        if (e.key === 'Escape' && $wrapper.hasClass('trad-active')) {
          closeOffCanvas();
        }
      });
    }

    // Prevent panel click from closing
    $panel.on('click', function(e) {
      e.stopPropagation();
    });

    // Update dimensions on window resize
    $(window).on('resize', function() {
      if ($wrapper.hasClass('trad-active')) {
        if (position === 'left' || position === 'right') {
          $wrapper.css('--trad-canvas-width', $panel.outerWidth() + 'px');
        } else {
          $wrapper.css('--trad-canvas-height', $panel.outerHeight() + 'px');
        }
      }
    });
  }

  $(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction('frontend/element_ready/trad-off-canvas.default', function ($scope) {
      var wrapper = $scope[0].querySelector('.trad-offcanvas-wrapper');
      if (wrapper) {
        initOffCanvas(wrapper);
      }
    });
  });

  // Initialize on document ready (for frontend/live preview)
  $(document).ready(function() {
    $('.trad-offcanvas-wrapper').each(function() {
      initOffCanvas(this);
    });
  });

})(jQuery);
