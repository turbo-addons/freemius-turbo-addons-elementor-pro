<div class="trad-review-archive">
    <div class="trad-review-archive-logo">
        <img src="<?php echo esc_url($settings['trad_review_archive_logo']['url']); ?>" 
                width="<?php echo esc_attr($settings['logo_width']['size']); ?>" 
                height="<?php echo esc_attr($settings['logo_height']['size']); ?>" 
                alt="Logo" />
    </div>
    <div class="trad-review-archive-content">
        <h3 class="trad-review-archive-name"><?php echo esc_html( $dynamic_title ); ?></h3>
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

        <p class="trad-review-archive-features">
            <?php echo esc_html( $dynamic_content ); ?>
        </p>
    </div>
    <div class="trad-review-archive-action"> 
        <a href="<?php echo esc_url($link_url_one); ?>" class="trad-review-archive-btn"><?php echo esc_html( $button_text ); ?></a>
        <p class="trad-review-archive-terms"><?php echo esc_html( $tc_text ); ?></p>
    </div>
</div>
