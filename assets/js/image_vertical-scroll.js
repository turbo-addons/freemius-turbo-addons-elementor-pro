(function ($) {
  $(window).on('load', function () {
    $('.trad-image-grid-scrolling').each(function () {
      const $wrap = $(this).find('.trad-image-grid-scrolling-wrapper');
      const $inner = $wrap.find('.trad-image-grid-scrolling-inner').first();
      if ($inner.length === 0) return;

      // Duplicate once for seamless looping
      const $clone = $inner.clone().addClass('clone');
      $wrap.append($clone);
    });
  });
})(jQuery);