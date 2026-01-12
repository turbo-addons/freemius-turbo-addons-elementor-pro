<div class="trad-review-archive-container">
        <div class="trad-review-archive-image-section">
            <img src="<?php echo esc_url($settings['template_two_card_logo']['url']); ?>" 
                    width="<?php echo esc_attr($settings['template_two_logo_width']['size']); ?>" 
                    height="<?php echo esc_attr($settings['template_two_logo_height']['size']); ?>" 
                    alt="Logo" />
        </div>
        <div class="trad-review-archive-template-two-content-section">
            <h2 class="trad-template-two-title"><?php echo esc_html( $dynamic_title ); ?></h2>
            <!-- <div class="rating">
                <span class="stars">★★★★☆</span>
            </div> -->
            <div class="trad-template-stars <?php echo esc_attr($hover_class); ?>" 
                style="
                    --rating: <?php echo esc_attr($rating); ?>; 
                    --star-size: <?php echo esc_attr($star_size); ?>; 
                    --star-color: <?php echo esc_attr($star_color); ?>; 
                    --star-background: <?php echo esc_attr($star_background_color); ?>;
                " 
                data-stars="<?php echo esc_attr($stars_content); ?>" 
                aria-label="Rating of this product is <?php echo esc_attr($rating); ?> out of 5.">
            </div>
            <p class="trad-template-two-description"><strong><?php echo esc_html( $dynamic_sub_title ); ?></strong></p>
            <p class="trad-template-two-description"><?php echo esc_html( $dynamic_content ); ?></p>
        </div>
</div>