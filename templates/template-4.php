<div class="trad-review-archive-template-four-container">
    <div class="trad-review-archive-template-four-container-body">
        <div class="trad-review-archive-template-four-container-header">
            <img src="<?php echo esc_url($settings['template_four_card_logo']['url']); ?>" 
                            width="<?php echo esc_attr($settings['template_four_logo_width']['size']); ?>" 
                            height="<?php echo esc_attr($settings['template_four_logo_height']['size']); ?>" 
                            alt="Logo" />
            <div class="trad-review-archive-template-four-container-info">
                <h3 class="trad-review-archive-template-four-container-title"><?php echo esc_html( $dynamic_title ); ?></h3>
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
            </div>
        </div>
        <p class="trad-review-archive-template-four-container-description">
            <?php echo esc_html( $dynamic_content ); ?>
        </p>
        <div class="trad-review-archive-template-four-container-footer">
            <a href="#" class="trad-card-btn trad-template-four-review-btn"><?php echo esc_html( $button_text_two ); ?></a>
            <a href="#" class="trad-card-btn trad-template-four-visit-btn"><?php echo esc_html( $button_text ); ?></a>
        </div>
        <p class="trad-review-archive-template-four-container-trad-terms"><a href="<?php echo esc_url($link_url_four); ?>" class="trad-template-three-terms"><?php echo esc_html( $template_four_tc_text ); ?></a></p>
    </div>
</div>
