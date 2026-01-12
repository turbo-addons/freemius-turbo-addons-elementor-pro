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
       <?php 
            $badge_text = !empty($badge_card_text) ? $badge_card_text : 'Popular';

            // Extract first word only
            $first_word = explode(' ', trim($badge_text))[0];

            // Convert to safe CSS slug (lowercase, no spaces)
            $badge_first_slug = sanitize_title($first_word);

            // Final dynamic class
            $dynamic_class = 'trad-featured-badge-' . $badge_first_slug;
            ?>

            <span 
                class="trad_advance_features_card_badge_text_global <?php echo esc_attr($dynamic_class); ?>"
                id="trad-features-badge-text">
                <?php echo esc_html($badge_text); ?>
            </span>
</div>
</a>
