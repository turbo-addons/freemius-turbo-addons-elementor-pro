<a class="trad-advance-featured-card-post-link"
   href="<?php echo esc_url( $card_link ); ?>"
   <?php if ( ! empty( $link_target ) ) : ?>
      target="<?php echo esc_attr( $link_target ); ?>"
   <?php endif; ?>
   <?php if ( ! empty( $link_nofollow ) ) : ?>
      rel="<?php echo esc_attr( $link_nofollow ); ?>"
   <?php endif; ?>
>

<div class="trad_advance_features_card">
        <div class="trad_advance_features_card_content">
        <?php
                if (!empty($image_upload_for_card)) { ; ?>
                <img class="trad_advance_features_card_content_image" 
                src="<?php echo esc_url( $image_upload_for_card ); ?>" 
                alt="<?php echo esc_attr__( 'new', 'turbo-addons-elementor-pro' ); ?>">
            <?php
                };
            ?>
            <p class="trad_advance_features_card_content_title">
                <?php echo !empty($badge_card_title) ? esc_html($badge_card_title) : ''; ?>
            </p>
        </div>
        <span class="trad_advance_features_card_badge">
            <?php
            if (!empty($style_badge_image)) { ; ?>
                <img class="trad_advance_features_card_badge_image" 
                src="<?php echo esc_url( $style_badge_image ); ?>" 
                alt="<?php echo esc_attr__( 'new', 'turbo-addons-elementor-pro' ); ?>">
            <?php
                };
            ?>
        </span>
</div>
</a>