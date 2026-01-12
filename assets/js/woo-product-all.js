function tradInitQuantityButtons($scope, $) {
    const $wrapper = $scope.find('.cart .quantity');
    if (!$wrapper.length) return;

    $wrapper.each(function () {
        const $input = $(this).find('input.qty');

        // Remove default + / -
        $(this).find('button.plus, button.minus').remove();

        // Avoid duplicates
        if ($(this).find('.trad-woo-product-cart-minus-button').length || $(this).find('.trad-woo-product-cart-plus-button').length) return;

        // Add buttons
        $('<button type="button" class="trad-woo-product-cart-minus-button">-</button>').insertBefore($input);
        $('<button type="button" class="trad-woo-product-cart-plus-button">+</button>').insertAfter($input);

        // Bind actions
        $(this).on('click', '.trad-woo-product-cart-minus-button', function (e) {
            e.preventDefault();
            $(this).siblings('input.qty')[0].stepDown();
        });

        $(this).on('click', '.trad-woo-product-cart-plus-button', function (e) {
            e.preventDefault();
            $(this).siblings('input.qty')[0].stepUp();
        });
    });
}

jQuery(window).on('elementor/frontend/init', function () {
    elementorFrontend.hooks.addAction(
        'frontend/element_ready/trad_woo_product_cart_button.default',
        tradInitQuantityButtons
    );
});
