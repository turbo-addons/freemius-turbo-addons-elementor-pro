<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
} 
?>


<div class="trad-image-overlay-template-one-container">
    <img src="<?php echo esc_url($settings['trad_overlay_image_upload']['url']); ?>" alt="Avatar" class="trad-image-overlay-template-one-image">
    <div class="trad-image-overlay-template-one-overlay">
        <div class="trad-image-overlay-template-one-text">
            <h4 class="trad-image-overlay-template-one-text-title"><?php echo esc_html( $settings['trad_overlay_image_title'] ); ?></h4>
            <!-- Social Icons Container -->
            <div class="trad-image-overlay-template-one-social-icons">
                <?php if ( ! empty( $settings['social_icons_list'] ) ) : ?>
                    <?php foreach ( $settings['social_icons_list'] as $trad_item ): ?>
                        <?php
                            $trad_icon_value = isset( $trad_item['trad_overlay_image_social_icon']['value'] ) ? esc_attr( $trad_item['trad_overlay_image_social_icon']['value'] ) : 'fa fa-facebook'; // Default icon
                            $trad_icon_color = isset( $trad_item['trad_overlay_image_icon_color'] ) ? esc_attr( $trad_item['trad_overlay_image_icon_color'] ) : '#000'; // Default color
                            $trad_link_url   = isset( $trad_item['trad_overlay_image_social_link']['url'] ) ? esc_url( $trad_item['trad_overlay_image_social_link']['url'] ) : '#'; // Default link
                        ?>
                        <a class="trad-social-icon" 
                            href="<?php echo esc_url( $trad_link_url ); ?>" 
                            target="_blank" 
                            data-id="<?php echo esc_attr( $trad_item['_id'] ); ?>" 
                            style="color: <?php echo esc_attr( $trad_icon_color ); ?>;">
                            <i class="<?php echo esc_attr( $trad_icon_value ); ?>" style="color: <?php echo esc_attr( $trad_icon_color ); ?>"></i>
                            <span class="trad-social-title"><?php echo esc_html( $trad_icon_value ); ?></span>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>