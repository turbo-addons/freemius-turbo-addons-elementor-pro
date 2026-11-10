/**
 * Turbo Addons Pro – Hero Slider.
 *
 * Initialises every Hero Slider widget separately (scoped to its own element),
 * using Elementor's bundled Swiper through elementorFrontend.utils.swiper, so it
 * works with several sliders on one page and in the editor preview.
 *
 * @since 1.9.6
 */
( function ( $ ) {
	'use strict';

	function initHeroSlider( $scope ) {
		var container = $scope[ 0 ] && $scope[ 0 ].querySelector( '.trad_turbo_slider_pro_swiper-container' );
		if ( ! container || container.swiper ) {
			return;
		}

		var pagination = container.querySelector( '.swiper-pagination' );
		var nextEl     = container.querySelector( '.swiper-button-next' );
		var prevEl     = container.querySelector( '.swiper-button-prev' );

		var options = {
			loop: true,
			speed: 1000,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false
			},
			on: {
				setTransition: function ( speed ) {
					for ( var i = 0; i < this.slides.length; i++ ) {
						this.slides[ i ].style.transition = speed + 'ms';
					}
				},
				slideChangeTransitionStart: function () {
					var swiper = this;
					Array.prototype.forEach.call( swiper.slides, function ( slide, index ) {
						var inner = slide.querySelector( '.slide-inner' );
						if ( index === swiper.activeIndex ) {
							slide.style.zIndex = 2;
							if ( inner ) {
								inner.style.transform = 'translateX(0)';
							}
						} else {
							slide.style.zIndex = 1;
						}
					} );
				},
				slideChangeTransitionEnd: function () {
					var swiper = this;
					Array.prototype.forEach.call( swiper.slides, function ( slide, index ) {
						var inner = slide.querySelector( '.slide-inner' );
						if ( index !== swiper.activeIndex ) {
							slide.style.transition = 'none';
							if ( inner ) {
								inner.style.transform = 'translateX(100%)';
							}
						}
					} );
				}
			}
		};

		if ( pagination ) {
			options.pagination = { el: pagination, clickable: true };
		}
		if ( nextEl && prevEl ) {
			options.navigation = { nextEl: nextEl, prevEl: prevEl };
		}

		var SwiperUtil = window.elementorFrontend && elementorFrontend.utils && elementorFrontend.utils.swiper;
		if ( SwiperUtil ) {
			new SwiperUtil( container, options );
		} else if ( 'function' === typeof window.Swiper ) {
			new window.Swiper( container, options );
		}
	}

	$( window ).on( 'elementor/frontend/init', function () {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/trad_hero_slider.default', initHeroSlider );
	} );
}( jQuery ) );
