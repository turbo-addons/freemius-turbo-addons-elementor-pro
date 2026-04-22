(function($) {
    'use strict';

    function initHotspot($scope) {
        var $markers = $scope.find('.trad-hotspot-marker');

        $markers.each(function() {
            var $marker     = $(this);
            var trigger     = $marker.data('trigger') || 'hover';
            var tipStyle    = $marker.data('tooltip-style') || 'default';
            var $tooltip    = $marker.find('.trad-hotspot-tooltip');
            var $lineTooltip = $marker.find('.trad-line-tooltip');

            // Setup line style geometry on init
            if ( tipStyle === 'line' ) {
                setupLineTooltip( $marker, $lineTooltip );
            }

            if ( trigger === 'hover' ) {
                $marker.on('mouseenter', function() {
                    closeAllTooltips($scope);
                    if ( tipStyle === 'line' ) {
                        $lineTooltip.addClass('trad-line-visible');
                    } else {
                        $tooltip.addClass('trad-tooltip-visible');
                    }
                    $marker.addClass('trad-active');
                });
                $marker.on('mouseleave', function() {
                    if ( tipStyle === 'line' ) {
                        $lineTooltip.removeClass('trad-line-visible');
                    } else {
                        $tooltip.removeClass('trad-tooltip-visible');
                    }
                    $marker.removeClass('trad-active');
                });
            } else if ( trigger === 'click' ) {
                $marker.on('click', function(e) {
                    e.stopPropagation();
                    if ( tipStyle === 'line' ) {
                        var isOpen = $lineTooltip.hasClass('trad-line-visible');
                        closeAllTooltips($scope);
                        if ( !isOpen ) {
                            $lineTooltip.addClass('trad-line-visible');
                            $marker.addClass('trad-active');
                        }
                    } else {
                        var isOpen = $tooltip.hasClass('trad-tooltip-visible');
                        closeAllTooltips($scope);
                        if ( !isOpen ) {
                            $tooltip.addClass('trad-tooltip-visible');
                            $marker.addClass('trad-active');
                        }
                    }
                });
            }
        });

        // Close on outside click — only if enabled
        var closeOutside = $scope.find('.trad-hotspot-wrapper').data('close-outside');

        // Always remove any previously attached listener for this scope first
        var scopeId = $scope.attr('data-id') || $scope.index();
        $(document).off('click.trad_hotspot_' + scopeId);

        if ( closeOutside === 'yes' ) {
            $(document).on('click.trad_hotspot_' + scopeId, function() {
                closeAllTooltips($scope);
            });
        }

        $scope.find('.trad-hotspot-tooltip, .trad-line-tooltip').on('click', function(e) {
            e.stopPropagation();
        });
    }

    /**
     * Position the line tooltip elements based on direction & length
     */
    function setupLineTooltip( $marker, $lineTooltip ) {
        var dir     = $lineTooltip.data('dir') || 'right-down';
        var lineLen = parseInt( $marker.data('line-len') ) || 80;
        var $lineH  = $lineTooltip.find('.trad-line-h');
        var $lineV  = $lineTooltip.find('.trad-line-v');
        var $label  = $lineTooltip.find('.trad-line-label');

        // Set CSS variable for animated width/height
        $lineTooltip[0].style.setProperty('--trad-line-len', lineLen + 'px');

        // Position the tooltip container at the marker center
        $lineTooltip.css({ position: 'absolute', top: '50%', left: '50%' });

        if ( dir === 'right-down' ) {
            // H goes right, V goes down from end of H
            $lineH.css({ top: '-1px', left: '0', transformOrigin: 'left center' });
            $lineV.css({ top: '-1px', left: lineLen + 'px', transformOrigin: 'top center' });
            $label.css({ top: lineLen + 'px', left: lineLen + 'px', transform: 'translateX(-50%)' });

        } else if ( dir === 'right-up' ) {
            // H goes right, V goes up from end of H
            $lineH.css({ top: '-1px', left: '0', transformOrigin: 'left center' });
            $lineV.css({ bottom: '-1px', left: lineLen + 'px', top: 'auto', transformOrigin: 'bottom center' });
            $label.css({ bottom: lineLen + 'px', left: lineLen + 'px', top: 'auto', transform: 'translateX(-50%)' });

        } else if ( dir === 'left-down' ) {
            // H goes left, V goes down from end of H
            $lineH.css({ top: '-1px', right: '0', left: 'auto', transformOrigin: 'right center' });
            $lineV.css({ top: '-1px', right: lineLen + 'px', left: 'auto', transformOrigin: 'top center' });
            $label.css({ top: lineLen + 'px', right: lineLen + 'px', left: 'auto', transform: 'translateX(50%)' });

        } else if ( dir === 'left-up' ) {
            // H goes left, V goes up from end of H
            $lineH.css({ top: '-1px', right: '0', left: 'auto', transformOrigin: 'right center' });
            $lineV.css({ bottom: '-1px', right: lineLen + 'px', left: 'auto', top: 'auto', transformOrigin: 'bottom center' });
            $label.css({ bottom: lineLen + 'px', right: lineLen + 'px', left: 'auto', top: 'auto', transform: 'translateX(50%)' });
        }
    }

    function closeAllTooltips($scope) {
        $scope.find('.trad-hotspot-tooltip').removeClass('trad-tooltip-visible');
        $scope.find('.trad-line-tooltip').removeClass('trad-line-visible');
        $scope.find('.trad-hotspot-marker').removeClass('trad-active');
    }

    $(window).on('elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction('frontend/element_ready/trad-hotspot.default', function($scope) {
            initHotspot($scope);
        });
    });

})(jQuery);
