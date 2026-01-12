<div class="trad-turbo-testmonial-slider-template-one-slider">
            <div class="trad-turbo-testmonial-slider-template-one-slides">
                <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                    <div class="trad-turbo-testmonial-slider-template-one-content <?php echo esc_attr( $index == 0 ? 'trad-turbo-testmonial-slider-template-one-card-active' : '' ); ?>">
                        <div class="trad-turbo-testmonial-slider-template-one-image">
                            <?php  
                                $image_url = !empty( $testimonial['testimonial_image']['url'] ) ? $testimonial['testimonial_image']['url'] : esc_url( TRAD_TURBO_ADDONS_PLUGIN_URL . 'assets/images/trad-testimonial.jpg' );
                            ?>
                            <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $testimonial['testimonial_name'] ); ?>">
                        </div>
                        <h3 class="trad-turbo-testmonial-slider-template-one-name"><?php echo esc_html( $testimonial['testimonial_name'] ); ?></h3>
                        <p class="trad-turbo-testmonial-slider-template-one-location"><?php echo esc_html( $testimonial['testimonial_location'] ); ?></p>
                        <p class="trad-turbo-testmonial-slider-template-one-text"><?php echo esc_html( $testimonial['testimonial_content'] ); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="trad-turbo-testmonial-slider-template-one-controls">
                <?php foreach ( $testimonials as $index => $testimonial ) : ?>
                    <span class="trad-turbo-testmonial-slider-template-one-dot <?php echo esc_attr( $index == 0 ? 'trad-turbo-testmonial-slider-template-one-active' : '' ); ?>" data-slide="<?php echo esc_attr( $index ); ?>"></span>
                <?php endforeach; ?>
            </div>
</div>

<script>
        jQuery(document).ready(function($) {
            var $slider = $('.trad-turbo-testmonial-slider-template-one-slider'),
                $slides = $slider.find('.trad-turbo-testmonial-slider-template-one-content'),
                $dots = $slider.find('.trad-turbo-testmonial-slider-template-one-dot'),
                currentIndex = 0,
                speed = <?php echo esc_js($slider_speed); ?>;

            function showSlide(index) {
                $slides.removeClass('trad-turbo-testmonial-slider-template-one-card-active').eq(index).addClass('trad-turbo-testmonial-slider-template-one-card-active');
                $dots.removeClass('trad-turbo-testmonial-slider-template-one-active').eq(index).addClass('trad-turbo-testmonial-slider-template-one-active');
            }

            function nextSlide() {
                currentIndex = (currentIndex + 1) % $slides.length;
                showSlide(currentIndex);
            }

            var interval = setInterval(nextSlide, speed);

            $dots.on('click', function() {
                clearInterval(interval);
                currentIndex = $(this).data('slide');
                showSlide(currentIndex);
                interval = setInterval(nextSlide, speed);
            });
        });
</script>