<section class="trad_pricing_table_pro_plans__container">
  <div class="trad_pricing_table_pro_plans">
    <div class="trad_pricing_table_pro_plansHero">
      <h1 class="trad_pricing_table_pro_plansHero__title">
        <?php
        if(!empty($settings['trad_pricing_table_pro_header_title'])){
          echo esc_html( $settings['trad_pricing_table_pro_header_title'] );
        }
        ?>
      </h1>
      <p class="trad_pricing_table_pro_plansHero__subtitle">
        <?php
          if(!empty($settings['trad_pricing_table_pro_sub_header_title'])){
            echo esc_html( $settings['trad_pricing_table_pro_sub_header_title'] );
          }
        ?>
      </p>
    </div>
    <div class="trad_pricing_table_pro_planItem__container">
      <!--free plan starts -->
      <div class="trad_pricing_table_pro_planItem trad_pricing_table_pro_planItem--free">

          <div class="trad_pricing_table_pro_card">
              <div class="trad_pricing_table_pro_card__header">
                <?php 
                      $image_visibility = $settings['trad_pricing_table_pro_free_image_visibility'] === 'yes' ? 'block' : 'none';
                      
                ;?>
                <div class="trad_pricing_table_pro_card__icon trad_pricing_table_pro_symbol trad_pricing_table_pro_symbol--rounded" 
                style="<?php echo esc_attr($image_visibility === 'block' ? 'display: block;' : 'display: none;'); ?>">
                <?php 
                      $style_one_pricing_table_pro_image = isset($settings['trad_pricing_table_pro_free_price_image']['url']) 
                      ? esc_url($settings['trad_pricing_table_pro_free_price_image']['url']) 
                      : '';
                    if (!empty($style_one_pricing_table_pro_image)) { ;?>
                      <img class="trad_pricing_table_pro_free_price_image_resize" 
                      src="<?php echo esc_url( $style_one_pricing_table_pro_image ); ?>" 
                      alt="<?php echo esc_attr__( 'style-one-table', 'turbo-addons-elementor-pro' ); ?>">
                      <?php
                      };
                    ?>
                </div>
                <h2 class="trad_pricing_table_pro_free_text_edit">
                  <?php
                  if(!empty($settings['trad_pricing_table_pro_free'])){
                    echo esc_html( $settings['trad_pricing_table_pro_free'] );
                  }
                  ?>
                </h2>
              </div>
              <div class="trad_pricing_table_pro_card__desc">
                  <p class="trad_pricing_table_pro_card__desc_text">
                    <?php
                        if(!empty($settings['trad_pricing_table_pro_free_description'])){
                          echo esc_html( $settings['trad_pricing_table_pro_free_description'] );
                        }
                    ?>
                  </p>
              </div>
          </div>

          <div class="trad_pricing_table_pro_price trad_pricing_table_pro_price_value">
            <?php
                    if(!empty($settings['trad_pricing_table_pro_free_price'])){
                      echo esc_html( $settings['trad_pricing_table_pro_free_price'] );
                    }
            ?>
            <span class="trad_pricing_table_pro_price_unit">

            <?php
                    if(!empty($settings['trad_pricing_table_pro_free_price_unit'])){
                      echo esc_html( $settings['trad_pricing_table_pro_free_price_unit'] );
                    }
            ?>
            </span>
          </div>

          <ul class="trad_pricing_table_pro_featureList">
              <?php 
              // Check if the repeater data exists and is an array
              if ( isset( $settings['trad_pricing_table_free_features_list'] ) && is_array( $settings['trad_pricing_table_free_features_list'] ) ) {
                  foreach ( $settings['trad_pricing_table_free_features_list'] as $item ) {
                    $text_decoration = ! empty( $item['trad_pricing_table_free_feature_text_decoration'] ) ? esc_attr( $item['trad_pricing_table_free_feature_text_decoration'] ) : 'none';
                      ?>
                      <li>
                          <span class="elementor-icon trad_pricing_table_pro_features_list_icon">
                              <?php
                              // Check if the icon is set and render it
                              if ( isset( $item['trad_pricing_table_free_feature_icon'] ) ) {
                                  $trad_pricing_table_pro_free_icon_color_style = ! empty( $item['trad_pricing_table_free_feature_icon_color'] ) ? 'fill: ' . esc_attr( $item['trad_pricing_table_free_feature_icon_color'] ) . ';' : '';
                                  \Elementor\Icons_Manager::render_icon( $item['trad_pricing_table_free_feature_icon'], [ 'aria-hidden' => 'true', 'style' => $trad_pricing_table_pro_free_icon_color_style ] );
                              }
                              ?>
                          </span>
                          <span class="trad_pricing_table_pro_free_feature_text" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
                              <?php
                              // Check if feature text is set and display it
                              if ( ! empty( $item['trad_pricing_table_free_feature_text'] ) ) {
                                  echo esc_html( $item['trad_pricing_table_free_feature_text'] );
                              }
                              ?>
                          </span>
                      </li>
                      <?php
                  }
              }
              ?>
          </ul>
          <a 
              class="trad_pricing_table_pro_button trad_pricing_table_pro_button_custom trad_pricing_table_pro_button_text"
              href="<?php echo isset( $settings['trad_pricing_table_pro_free_price_url']['url'] ) ? esc_url( $settings['trad_pricing_table_pro_free_price_url']['url'] ) : '#'; ?>" 
              <?php echo isset( $settings['trad_pricing_table_pro_free_price_url']['is_external'] ) && $settings['trad_pricing_table_pro_free_price_url']['is_external'] ? 'target="_blank"' : ''; ?>
              <?php echo isset( $settings['trad_pricing_table_pro_free_price_url']['nofollow'] ) && $settings['trad_pricing_table_pro_free_price_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>
          >
            <?php
                    if(!empty($settings['trad_pricing_table_pro_btn_text_free'])){
                      echo esc_html( $settings['trad_pricing_table_pro_btn_text_free'] );
                    }
            ?>
          </a>

      </div>
      <!--free plan ends -->

      <!--pro plan starts -->
      <div class="trad_pricing_table_pro_planItem trad_pricing_table_pro_planItem--pro">
        <div class="trad_pricing_table_pro_card">
          <div class="trad_pricing_table_pro_card__header">
          <?php 
              $image_pro_visibility = $settings['trad_pricing_table_pro_pro_image_visibility'] === 'yes' ? 'block' : 'none';
                      
          ;?>
            <div class="trad_pricing_table_pro_card__icon trad_pricing_table_pro_symbol" style="<?php echo esc_attr($image_pro_visibility === 'block' ? 'display: block;' : 'display: none;'); ?>">
              <?php 
                  $style_one_pricing_table_pro_pro_image = isset($settings['trad_pricing_table_pro_pro__image']['url']) 
                  ? esc_url($settings['trad_pricing_table_pro_pro__image']['url']) 
                  : '';
                if (!empty($style_one_pricing_table_pro_pro_image)) { ; ?>
                <img class="trad_pricing_table_pro_pro_price_image_resize" 
                src="<?php echo esc_url( $style_one_pricing_table_pro_pro_image ); ?>" 
                alt="<?php echo esc_attr__( 'style-one-table', 'turbo-addons-elementor-pro' ); ?>">
                <?php
                    };
              ?>
            </div>
            <h2 class="trad_pricing_table_pro_pro_text_edit">
              <?php
                if(!empty($settings['trad_pricing_table_pro_pro'])){
                  echo esc_html( $settings['trad_pricing_table_pro_pro'] );
                }
              ?>
            </h2>
            <?php
              $badge_show = isset($settings['trad_pricing_table_pro_pro_show_badge']) ? $settings['trad_pricing_table_pro_pro_show_badge'] : 'no';
              if (!empty($badge_show) && $badge_show === 'yes') {
              ?>
                  <div class="trad_pricing_table_pro_card__label trad_pricing_table_pro_label">
                      <?php echo !empty($settings['trad_pricing_table_pro_pro_badge_text']) ? esc_html($settings['trad_pricing_table_pro_pro_badge_text']) : ''; ?>
                  </div>
              <?php
              }
            ?>

          </div>
          <div class="trad_pricing_table_pro_card__desc">
              <p class="trad_pricing_table_pro_pro_card__desc_text">
              <?php
                    if (!empty($settings['trad_pricing_table_pro_pro_description'])) {
                      echo esc_html( $settings['trad_pricing_table_pro_pro_description'] );
                    }
              ?>
              </p>
          </div>
        </div>

        <div class="trad_pricing_table_pro_price trad_pricing_table_pro_pro_price_value">
        <?php
                if(!empty($settings['trad_pricing_table_pro_pro_price'])){
                  echo esc_html( $settings['trad_pricing_table_pro_pro_price'] );
                }
        ?>
        <span class="trad_pricing_table_pro_pro_price_unit">

        <?php
                if(!empty($settings['trad_pricing_table_pro_pro_price_unit'])){
                  echo esc_html( $settings['trad_pricing_table_pro_pro_price_unit'] );
                }
        ?>
        </span>
        </div>

        <ul class="trad_pricing_table_pro_featureList">
        <?php 
            // Check if the repeater data exists and is an array
            if ( isset( $settings['trad_pricing_table_pro_features_list'] ) && is_array( $settings['trad_pricing_table_pro_features_list'] ) ) {
                foreach ( $settings['trad_pricing_table_pro_features_list'] as $item ) {
                  $text_decoration = ! empty( $item['trad_pricing_table_pro_feature_text_decoration'] ) ? esc_attr( $item['trad_pricing_table_pro_feature_text_decoration'] ) : 'none';
                    ?>
                    <li>
                        <span class="elementor-icon trad_pricing_table_pro_features_list_icon">
                            <?php
                            // Check if the icon is set and render it
                            if ( isset( $item['trad_pricing_table_pro_feature_icon'] ) ) {
                                \Elementor\Icons_Manager::render_icon( $item['trad_pricing_table_pro_feature_icon'], [ 'aria-hidden' => 'true' ] );
                            }
                            ?>
                        </span>
                        <span class="trad_pricing_table_pro_pro_feature_text" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
                            <?php
                            // Check if feature text is set and display it
                            if ( ! empty( $item['trad_pricing_table_pro_feature_text'] ) ) {
                                echo esc_html( $item['trad_pricing_table_pro_feature_text'] );
                            }
                            ?>
                        </span>
                    </li>
                    <?php
                }
            }
        ?>
        </ul>
        <a 
            class="trad_pricing_table_pro_button trad_pricing_table_pro_button--pink trad_pricing_table_pro_pro_button_custom trad_pricing_table_pro_button_text"
            href="<?php echo isset( $settings['trad_pricing_table_pro_pro_price_url']['url'] ) ? esc_url( $settings['trad_pricing_table_pro_pro_price_url']['url'] ) : '#'; ?>" 
            <?php echo isset( $settings['trad_pricing_table_pro_pro_price_url']['is_external'] ) && $settings['trad_pricing_table_pro_pro_price_url']['is_external'] ? 'target="_blank"' : ''; ?>
            <?php echo isset( $settings['trad_pricing_table_pro_pro_price_url']['nofollow'] ) && $settings['trad_pricing_table_pro_pro_price_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>
        >
            <?php
                    if(!empty($settings['trad_pricing_table_pro_btn_text_pro'])){
                      echo esc_html( $settings['trad_pricing_table_pro_btn_text_pro'] );
                    }
            ?>
        </a>
      </div>
      <!--pro plan ends -->

      <!--entp plan starts -->
      <div class="trad_pricing_table_pro_planItem trad_pricing_table_pro_planItem--entp">
        <div class="trad_pricing_table_pro_card">
          <div class="trad_pricing_table_pro_card__header">
          <?php 
                      $image_enterprise_visibility = $settings['trad_pricing_table_pro_enterprise_image_visibility'] === 'yes' ? 'block' : 'none';
                      
                ;?>
            <div class="trad_pricing_table_pro_card__icon" style="<?php echo esc_attr($image_enterprise_visibility === 'block' ? 'display: block;' : 'display: none;'); ?>">
              <?php 
                  $style_one_pricing_table_exclusive_image = isset($settings['trad_pricing_table_pro_exclusive__image']['url']) 
                  ? esc_url($settings['trad_pricing_table_pro_exclusive__image']['url']) 
                  : '';
                if (!empty($style_one_pricing_table_exclusive_image)) { ; ?>
                <img class="trad_pricing_table_pro_enterprise_price_image_resize" 
                src="<?php echo esc_url( $style_one_pricing_table_exclusive_image ); ?>" 
                alt="<?php echo esc_attr__( 'style-one-table', 'turbo-addons-elementor-pro' ); ?>">
                <?php
                    };
              ?>
            </div>
            <h2 class="trad_pricing_table_pro_enterprise_text_edit">
              <?php
              if(!empty($settings['trad_pricing_table_pro_enterprise'])){
                echo esc_html( $settings['trad_pricing_table_pro_enterprise'] );
              }
              ?>
            </h2>
          </div>
          <div class="trad_pricing_table_pro_card__desc">
              <p class="trad_pricing_table_pro_enterprise_card__desc_text">
              <?php
                    if (!empty($settings['trad_pricing_table_pro_enterprise_description'])) {
                      echo esc_html( $settings['trad_pricing_table_pro_enterprise_description'] );
                    }
              ?>
              </p>
          </div>
        </div>

        <div class="trad_pricing_table_pro_price trad_pricing_table_pro_enterprise_price_value">
        <?php
                if(!empty($settings['trad_pricing_table_pro_enterprise_price'])){
                  echo esc_html( $settings['trad_pricing_table_pro_enterprise_price'] );
                }
        ?>
        <span class="trad_pricing_table_pro_enterprise_price_unit">

        <?php
                if(!empty($settings['trad_pricing_table_pro_enterprise_price_unit'])){
                  echo esc_html( $settings['trad_pricing_table_pro_enterprise_price_unit'] );
                }
        ?>
        </span>
        </div>

        <ul class="trad_pricing_table_pro_featureList">
        <?php 
            // Check if the repeater data exists and is an array
            if ( isset( $settings['trad_pricing_table_enterprise_features_list'] ) && is_array( $settings['trad_pricing_table_enterprise_features_list'] ) ) {
                foreach ( $settings['trad_pricing_table_enterprise_features_list'] as $item ) {
                  $text_decoration = ! empty( $item['trad_pricing_table_pro_enterprise_feature_text_decoration'] ) ? esc_attr( $item['trad_pricing_table_pro_enterprise_feature_text_decoration'] ) : 'none';
                    ?>
                    <li>
                        <span class="elementor-icon trad_pricing_table_pro_features_list_icon">
                            <?php
                            // Check if the icon is set and render it
                            if ( isset( $item['trad_pricing_table_enterprise_feature_icon'] ) ) {
                                \Elementor\Icons_Manager::render_icon( $item['trad_pricing_table_enterprise_feature_icon'], [ 'aria-hidden' => 'true' ] );
                            }
                            ?>
                        </span>
                        <span class="trad_pricing_table_pro_enterprise_feature_text" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
                            <?php
                            // Check if feature text is set and display it
                            if ( ! empty( $item['trad_pricing_table_enterprise_feature_text'] ) ) {
                                echo esc_html( $item['trad_pricing_table_enterprise_feature_text'] );
                            }
                            ?>
                        </span>
                    </li>
                    <?php
                }
            }
        ?>
        </ul>
        <a 
            class="trad_pricing_table_pro_button trad_pricing_table_pro_button--white trad_pricing_table_pro_enterprise_button_custom trad_pricing_table_pro_button_text"
            href="<?php echo isset( $settings['trad_pricing_table_pro_enterprise_price_url']['url'] ) ? esc_url( $settings['trad_pricing_table_pro_enterprise_price_url']['url'] ) : '#'; ?>" 
            <?php echo isset( $settings['trad_pricing_table_pro_enterprise_price_url']['is_external'] ) && $settings['trad_pricing_table_pro_enterprise_price_url']['is_external'] ? 'target="_blank"' : ''; ?>
            <?php echo isset( $settings['trad_pricing_table_pro_enterprise_price_url']['nofollow'] ) && $settings['trad_pricing_table_pro_enterprise_price_url']['nofollow'] ? 'rel="nofollow"' : ''; ?>
        >
          <?php
                    if(!empty($settings['trad_pricing_table_pro_btn_text_enterprise'])){
                      echo esc_html( $settings['trad_pricing_table_pro_btn_text_enterprise'] );
                    }
            ?>
        </a>
      </div>
      <!--entp plan ends -->

    </div>
  </div>
</section>
