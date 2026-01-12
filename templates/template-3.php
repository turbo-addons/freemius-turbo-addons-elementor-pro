<div class="trad-review-archive-template-three-container">
<div class="trad-review-archive-template-three-logo-image">
        <div class="trad-review-archive-image-section">
            <img src="<?php echo esc_url($settings['template_two_card_logo']['url']); ?>" 
                        width="<?php echo esc_attr($settings['template_two_logo_width']['size']); ?>" 
                        height="<?php echo esc_attr($settings['template_two_logo_height']['size']); ?>" 
                        alt="Logo" />
        </div>

        <div class="trad-review-archive-template-three-divider"></div> 

        <div class="trad-review-archive-template-three-price-section">
            <p class="trad-review-archive-template-three-money-back"><?php echo esc_html( $money_back_title ); ?></p>    
            <h2 class="trad-review-archive-template-three-price-value"><?php echo esc_html( $template_three_price_title ); ?></h2>
            <p class="trad-review-archive-template-three-save-value"><?php echo esc_html( $template_three_save_title ); ?></p>
            <p class="trad-review-archive-template-three-secure-value"><?php echo esc_html( $template_three_secure_title ); ?></p>
        </div>

        <div class="trad-review-archive-template-three-divider"></div>

        <div class="trad-review-archive-template-three-rating-section">
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
            <div class="trad-review-archive-template-three-rating-number"><a href="<?php echo esc_url($link_url); ?>" class="trad-template-three-terms"><?php echo esc_html( $template_three_tc_text ); ?></a></div> 
            
        </div>

        <div class="trad-review-archive-template-three-divider"></div>

        <div class="trad-review-archive-template-three-action-section">
            <a href="<?php echo esc_url($link_url_three); ?>" class="trad-achive-template-three-btn trad-achive-template-three-visit trad-template-three-visit-btn"><?php echo esc_html( $button_text ); ?></a>
            <a href="<?php echo esc_url($link_url_three_review); ?>" class="trad-achive-template-three-btn trad-achive-template-three-read-review trad-template-three-review-btn"><?php echo esc_html( $button_text_two ); ?></a>
        </div>
    </div>
</div>