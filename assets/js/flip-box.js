(function($){
    "use strict";

    // Click Trigger
    $(document).on('click', '.trad-flip-box.trad-trigger-click', function() {
        $(this).toggleClass('trad-flipped');
    });

    // Button Trigger
    $(document).on('click', '.trad-flip-box.trad-trigger-button .trad-flip-box-button', function(e) {
        e.preventDefault();
        $(this).closest('.trad-flip-box').toggleClass('trad-flipped');
    });

})(jQuery);
