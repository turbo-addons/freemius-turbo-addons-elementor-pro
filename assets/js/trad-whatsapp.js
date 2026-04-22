( function( $ ) {

    function initWhatsAppWidget( $scope ) {

        // ---- Inline Chat Window ----
        var $inlineWrapper = $scope.find( '.trad-wa-inline-wrapper' );
        if ( $inlineWrapper.length ) {
            var $btn = $inlineWrapper.find( '.trad-wa-cw-btn' );
            var $win = $inlineWrapper.find( '.trad-wa-chatwin' );

            $btn.off( 'click.tradwa' ).on( 'click.tradwa', function( e ) {
                e.stopPropagation();
                $win.toggleClass( 'trad-show' );
            } );
        }

        // ---- Floating Multi-Agent ----
        var $floatWrapper = $scope.find( '.trad-whatsapp-wrapper' );
        if ( $floatWrapper.length ) {
            var $button = $floatWrapper.find( '.trad-whatsapp-button' );
            var $popup  = $floatWrapper.find( '.trad-whatsapp-popup' );

            $button.off( 'click.tradwa' ).on( 'click.tradwa', function( e ) {
                e.stopPropagation();
                $popup.toggleClass( 'trad-show' );
            } );
        }
    }

    // ---- Elementor Editor + Frontend ----
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction(
            'frontend/element_ready/trad-whatsapp.default',
            function( $scope ) {
                initWhatsAppWidget( $scope );
            }
        );
    } );

    // ---- Fallback for normal frontend (non-editor) ----
    $( document ).ready( function() {
        // Close on outside click
        $( document ).on( 'click', function( e ) {
            if ( ! $( e.target ).closest( '.trad-whatsapp-wrapper' ).length ) {
                $( '.trad-whatsapp-popup' ).removeClass( 'trad-show' );
            }
            if ( ! $( e.target ).closest( '.trad-wa-inline-wrapper' ).length ) {
                $( '.trad-wa-chatwin' ).removeClass( 'trad-show' );
            }
        } );

        // Init all widgets on page load (non-editor context)
        $( '.trad-wa-inline-wrapper' ).each( function() {
            var $wrapper = $( this );
            var $btn     = $wrapper.find( '.trad-wa-cw-btn' );
            var $win     = $wrapper.find( '.trad-wa-chatwin' );

            $btn.off( 'click.tradwa' ).on( 'click.tradwa', function( e ) {
                e.stopPropagation();
                $win.toggleClass( 'trad-show' );
            } );
        } );

        $( '.trad-whatsapp-wrapper' ).each( function() {
            var $wrapper = $( this );
            var $button  = $wrapper.find( '.trad-whatsapp-button' );
            var $popup   = $wrapper.find( '.trad-whatsapp-popup' );

            $button.off( 'click.tradwa' ).on( 'click.tradwa', function( e ) {
                e.stopPropagation();
                $popup.toggleClass( 'trad-show' );
            } );
        } );
    } );

} )( jQuery );
