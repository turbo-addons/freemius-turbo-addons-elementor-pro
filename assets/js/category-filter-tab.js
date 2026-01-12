(function ($) {
    function initTabFunctionality($scope) {
        // Ensure this only applies to the specific widget section
        var $widget = $scope.find('.trad-advance-post-filter-left-btn');
        if (!$widget.length) return;

        $widget.on("click", function (e) {
            e.preventDefault();

            // Remove active class from all buttons
            $(".trad-advance-post-filter-left-btn").removeClass("active");
            $(this).addClass("active");

            // Get target section
            var target = $(this).attr("href");

            // Hide all sections
            $(".trad-post-filter-content-section").removeClass("trad-post-filter-content-active-section");

            // Show the target section
            $(target).addClass("trad-post-filter-content-active-section");
        });
    }

    // Initialize in live mode
    $(document).ready(function () {
        initTabFunctionality($(document));
    });

    // Initialize in Elementor editor mode
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
            initTabFunctionality($scope);
        });
    });
})(jQuery);