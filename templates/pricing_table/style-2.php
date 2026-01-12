<section class="trad-pricing-table-pro-style-two-pricing-section trad_pricing_table_pro_plans__container">
    <div class="trad-pricing-table-pro-heading-style-two">
        <h2 class="trad_pricing_table_pro_plansHero__title">
            <?php
            if(!empty($settings['trad_pricing_table_pro_header_title'])){
            echo esc_html( $settings['trad_pricing_table_pro_header_title'] );
            }
            ?>
        </h2>
        <p class="trad_pricing_table_pro_plansHero__subtitle">
            <?php
            if(!empty($settings['trad_pricing_table_pro_sub_header_title'])){
                echo esc_html( $settings['trad_pricing_table_pro_sub_header_title'] );
            }
            ?>
        </p>
    </div>
    <div class="trad-pricing-table-pro-style-two-pricing-cards">
        <!-- Starter Plan -->
        <div class="trad-pricing-table-pro-style-two-pricing-card">
            <h3 class="trad_pricing_table_pro_free_text_edit trad_pricing_table_pro_free_text_edit_one">
            <?php
                if(!empty($settings['trad_pricing_table_pro_free'])){
                    echo esc_html( $settings['trad_pricing_table_pro_free'] );
                }
            ?>
            </h3>
            <div class="trad-pricing-table-pro-style-two-divider trad-pricing-table-pro-style-two-divider-one"></div>
            <div class="trad-pricing-table-pro-style-two-price trad_pricing_table_pro_price_value">
            <span class="trad_pricing_table_pro_price_unit_price">
            <?php
                if(!empty($settings['trad_pricing_table_pro_free_price'])){
                        echo esc_html( $settings['trad_pricing_table_pro_free_price'] );
                    }
                ?>
            </span>
            <span class="trad_pricing_table_pro_price_unit trad_pricing_table_pro_price_unit_one">

            <?php
                    if(!empty($settings['trad_pricing_table_pro_free_price_unit'])){
                      echo esc_html( $settings['trad_pricing_table_pro_free_price_unit'] );
                    }
            ?>
            </span>
            </div>
            <div class="trad-pricing-table-pro-style-two-divider-main trad-pricing-table-pro-style-two-divider-main-one"></div>
            <ul class="trad-pricing-table-pro-style-two-pricing-item-alignment">
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
                          <span class="trad_pricing_table_pro_free_feature_text trad_pricing_table_pro_free_feature_text_free_plan" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
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
              class="trad_pricing_table_pro_button_custom trad_pricing_table_pro_style_two_starter_button trad_pricing_table_pro_button_text trad_pricing_table_pro_button_basic"
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
        <!-- Professional Plan -->
        <div class="trad-pricing-table-pro-style-two-pricing-card trad-pricing-table-pro-style-two-featured">
            <h3 class="trad_pricing_table_pro_free_text_edit trad_pricing_table_pro_free_text_edit_two">
            <?php
                if(!empty($settings['trad_pricing_table_pro_pro'])){
                    echo esc_html( $settings['trad_pricing_table_pro_pro'] );
                }
            ?>
            </h3>
            <div class="trad-pricing-table-pro-style-two-divider trad-pricing-table-pro-style-two-divider-two"></div>
            <div class="trad-pricing-table-pro-style-two-price">
            <span class="trad_pricing_table_pro_price_unit_price_two">
            <?php
                    if(!empty($settings['trad_pricing_table_pro_pro_price'])){
                      echo esc_html( $settings['trad_pricing_table_pro_pro_price'] );
                    }
            ?>
            </span>
            <span class="trad_pricing_table_pro_price_unit trad_pricing_table_pro_price_unit_two">

            <?php
                    if(!empty($settings['trad_pricing_table_pro_pro_price_unit'])){
                      echo esc_html( $settings['trad_pricing_table_pro_pro_price_unit'] );
                    }
            ?>
            </span>
            </div>
            <div class="trad-pricing-table-pro-style-two-divider-main trad-pricing-table-pro-style-two-divider-main-two"></div>
            <ul class="trad-pricing-table-pro-style-two-pricing-item-alignment">
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
                                  $trad_pricing_table_pro_pro_icon_color_style = ! empty( $item['trad_pricing_table_pro_feature_icon_color'] ) ? 'fill: ' . esc_attr( $item['trad_pricing_table_pro_feature_icon_color'] ) . ';' : '';
                                  \Elementor\Icons_Manager::render_icon( $item['trad_pricing_table_pro_feature_icon'], [ 'aria-hidden' => 'true', 'style' => $trad_pricing_table_pro_pro_icon_color_style ] );
                              }
                              ?>
                          </span>
                          <span class="trad_pricing_table_pro_free_feature_text trad_pricing_table_pro_free_feature_text_pro_plan" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
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
              class="trad_pricing_table_pro_button_custom trad_pricing_table_pro_style_two_starter_button trad_pricing_table_pro_button_text trad_pricing_table_pro_button_pro"
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
        <!-- Enterprise Plan -->
        <div class="trad-pricing-table-pro-style-two-pricing-card">
            <h3 class="trad_pricing_table_pro_free_text_edit trad_pricing_table_pro_free_text_edit_three">
            <?php
                if(!empty($settings['trad_pricing_table_pro_enterprise'])){
                    echo esc_html( $settings['trad_pricing_table_pro_enterprise'] );
                }
            ?>
            </h3>
            <div class="trad-pricing-table-pro-style-two-divider trad-pricing-table-pro-style-two-divider-three"></div>
            <div class="trad-pricing-table-pro-style-two-price">
            <span class="trad_pricing_table_pro_price_unit_price_three">
            <?php
                    if(!empty($settings['trad_pricing_table_pro_enterprise_price'])){
                      echo esc_html( $settings['trad_pricing_table_pro_enterprise_price'] );
                    }
            ?>
            </span>
            <span class="trad_pricing_table_pro_price_unit trad_pricing_table_pro_price_unit_three">

            <?php
                    if(!empty($settings['trad_pricing_table_pro_enterprise_price_unit'])){
                      echo esc_html( $settings['trad_pricing_table_pro_enterprise_price_unit'] );
                    }
            ?>
            </span>
            </div>
            <div class="trad-pricing-table-pro-style-two-divider-main trad-pricing-table-pro-style-two-divider-main-three"></div>
            <ul class="trad-pricing-table-pro-style-two-pricing-item-alignment">
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
                                  $trad_pricing_table_pro_enterprise_icon_color_style = ! empty( $item['trad_pricing_table_enterprise_feature_icon_color'] ) ? 'fill: ' . esc_attr( $item['trad_pricing_table_enterprise_feature_icon_color'] ) . ';' : '';
                                  \Elementor\Icons_Manager::render_icon( $item['trad_pricing_table_enterprise_feature_icon'], [ 'aria-hidden' => 'true', 'style' => $trad_pricing_table_pro_enterprise_icon_color_style ] );
                              }
                              ?>
                          </span>
                          <span class="trad_pricing_table_pro_free_feature_text trad_pricing_table_pro_free_feature_text_enterprise_plan" style="text-decoration: <?php echo esc_attr( $text_decoration ); ?>;">
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
              class="trad_pricing_table_pro_button_custom trad_pricing_table_pro_style_two_starter_button trad_pricing_table_pro_button_text trad_pricing_table_pro_button_enterprise"
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
    </div>
</section>