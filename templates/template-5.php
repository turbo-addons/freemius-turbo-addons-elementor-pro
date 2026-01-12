<div class="trad-template-five-card">
    <div class="trad-template-five-left-section">
        <div class="trad-template-five-icon-wrapper">
            <img src="<?php echo esc_url($settings['template_four_card_logo']['url']); ?>" 
                        width="<?php echo esc_attr($settings['template_five_logo_width']['size']); ?>" 
                        height="<?php echo esc_attr($settings['template_five_logo_height']['size']); ?>" 
                        alt="Logo" />
        </div>
        <div class="trad-template-five-service-name"><?php echo esc_html( $dynamic_title ); ?></div>
    </div>
    <div class="trad-template-five-middle-section">
        <div class="trad-template-five-money-back"><?php echo esc_html( $money_back_title ); ?></div>
        <div class="trad-template-five-price">
            <span class="trad-template-five-price-value"><?php echo esc_html( $template_three_price_title ); ?></span>
        </div>
        <div class="trad-template-five-save"><?php echo esc_html( $template_three_save_title ); ?></div>
        <div class="trad-template-five-devices"><?php echo esc_html( $template_three_secure_title ); ?></div>
    </div>
    <div class="trad-template-five-right-section">
        <div class="trad-template-five-rating-review">
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
            <a href="<?php echo esc_url($link_url_review_five); ?>" class="trad-template-five-review-link"><?php echo esc_html( $button_text_two ); ?></a>
        </div>
        <div class="trad-template-five-visit-section">
            <a href="<?php echo esc_url($link_url_five); ?>" class="trad-template-five-visit-btn"><?php echo esc_html( $button_text ); ?></a>
            <div class="trad-template-five-terms"><?php echo esc_html( $template_five_tc_text ); ?></div>
        </div>
    </div>
</div>
