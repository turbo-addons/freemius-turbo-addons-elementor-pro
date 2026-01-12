(function ($) {
    function initWooMinCart($scope) {
        // Ensure this only applies to the specific widget section
        var exadAddCart = $scope.find( '.trad-woo-mini-cart' ).eq(0);

        var cartVisibility = exadAddCart.data('visibility');
    
        var cartWrapper = exadAddCart.find( '.trad-woo-mini-cart-wrapper' );
        var cartIcon = exadAddCart.find( '.trad-woo-mini-cart-wrapper .trad-woo-cart-icon' );
        var cartBag = exadAddCart.find( '.trad-woo-mini-cart-wrapper .trad-woo-cart-bag' );
        var cartOverlay = exadAddCart.find( '.trad-woo-mini-cart-wrapper .trad-woo-cart-bag-fly-out-overlay' );
    
        if( 'hover' === cartVisibility ){
            $( cartWrapper ).hover( function()  {
                cartWrapper.addClass('hover-active');
            }, function() {
                cartWrapper.removeClass('hover-active');
            });
        }else if( 'click' === cartVisibility ){
            $(cartWrapper).on("click", function(e){
                cartWrapper.toggleClass('click-active');
            });
        } else if( 'fly-out' === cartVisibility ){
            var closeIcon = cartBag.find( '.trad-woo-cart-bag-fly-out-close-icon' );
    
            closeIcon.on("click", function(e){
                cartBag.removeClass('fly-out-active');
                cartOverlay.removeClass('fly-out-active');
            });
            $(cartIcon).on("click", function(e){
                cartBag.addClass('fly-out-active');
                cartOverlay.addClass('fly-out-active');
            });
            $(cartOverlay).on("click", function(e){
                cartBag.removeClass('fly-out-active');
                cartOverlay.removeClass('fly-out-active');
            });
        }
    }

    // Initialize in live mode
    $(document).ready(function () {
        initWooMinCart($(document));
    });

    // Initialize in Elementor editor mode
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/global', function ($scope) {
            initWooMinCart($scope);
        });
    });
})(jQuery);