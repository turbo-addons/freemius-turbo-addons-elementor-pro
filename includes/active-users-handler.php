<?php
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Visitor Count widget: "active users" counter.
 *
 * Since 1.9.6 this no longer uses PHP sessions (session_start() on public AJAX
 * requests broke full-page caching, raised a Site Health warning and created a
 * session file per request). The browser now sends a random per-tab visitor ID
 * (sessionStorage); the server only keeps "ID => last seen" for 30 seconds,
 * validates the ID format and caps the list so it cannot be inflated.
 */
const TRAD_ACTIVE_USERS_TIMEOUT = 30;
const TRAD_ACTIVE_USERS_MAX     = 2000;

add_action( 'wp_ajax_trad_update_active_users', 'trad_update_active_users' );
add_action( 'wp_ajax_nopriv_trad_update_active_users', 'trad_update_active_users' );
add_action( 'wp_ajax_trad_remove_active_user', 'trad_remove_active_user' );
add_action( 'wp_ajax_nopriv_trad_remove_active_user', 'trad_remove_active_user' );

/**
 * Visitor ID sent by the widget script (random, 16–40 chars of [a-z0-9]).
 *
 * @return string Empty string when missing or malformed.
 */
function trad_active_users_visitor_id() {
    // phpcs:ignore WordPress.Security.NonceVerification.Recommended -- public, read-mostly counter; the ID is validated below.
    $vid = isset( $_REQUEST['vid'] ) ? strtolower( sanitize_text_field( wp_unslash( $_REQUEST['vid'] ) ) ) : '';
    return preg_match( '/^[a-z0-9]{16,40}$/', $vid ) ? $vid : '';
}

/**
 * Current list without expired entries.
 *
 * @return array visitor ID => last seen timestamp.
 */
function trad_active_users_list() {
    $now   = time();
    $users = get_transient( 'trad_active_users' );
    $users = is_array( $users ) ? $users : [];
    foreach ( $users as $vid => $seen ) {
        if ( ! is_int( $seen ) || $now - $seen > TRAD_ACTIVE_USERS_TIMEOUT ) {
            unset( $users[ $vid ] );
        }
    }
    return $users;
}

function trad_update_active_users() {
    $users = trad_active_users_list();
    $vid   = trad_active_users_visitor_id();

    if ( '' !== $vid ) {
        $users[ $vid ] = time();
        if ( count( $users ) > TRAD_ACTIVE_USERS_MAX ) {
            asort( $users );
            $users = array_slice( $users, -TRAD_ACTIVE_USERS_MAX, null, true );
        }
        set_transient( 'trad_active_users', $users, TRAD_ACTIVE_USERS_TIMEOUT );
    }

    wp_send_json_success( [ 'active_users' => max( 1, count( $users ) ) ] );
}

function trad_remove_active_user() {
    $users = trad_active_users_list();
    $vid   = trad_active_users_visitor_id();

    if ( '' !== $vid && isset( $users[ $vid ] ) ) {
        unset( $users[ $vid ] );
        set_transient( 'trad_active_users', $users, TRAD_ACTIVE_USERS_TIMEOUT );
    }

    wp_send_json_success( [ 'active_users' => count( $users ) ] );
}

// --------------------------post load more button handler//
add_action( 'wp_ajax_trad_load_more_posts', 'trad_load_more_posts_callback' );
add_action( 'wp_ajax_nopriv_trad_load_more_posts', 'trad_load_more_posts_callback' );

function trad_load_more_posts_callback() {
    check_ajax_referer( 'trad_load_more_posts_nonce', 'security' );
    $cat_id = isset( $_POST['category'] ) ? absint( $_POST['category'] ) : 0;
    $offset = isset( $_POST['offset'] ) ? absint( $_POST['offset'] ) : 0;
    $limit  = isset( $_POST['limit'] ) ? absint( $_POST['limit'] ) : 6;
    // Never let a public request ask for "all posts" (-1) or thousands at once.
    $limit = min( max( 1, $limit ), 50 );

    $query = new WP_Query( [
        'cat'                 => $cat_id,
        'posts_per_page'      => $limit,
        'offset'              => $offset,
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
    ] );

    ob_start();
    $count = 0;

    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            $count++;

            $title       = get_the_title();
            $description = get_the_excerpt();
            $image       = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
            $date        = get_the_date();

            echo '<div class="trad-post-list">';
            if ( $image ) {
                echo '<img src="' . esc_url( $image ) . '" alt="' . esc_attr( $title ) . '" class="trad-post-feature-image">';
            }
            echo '<h3 class="trad-post-title">' . esc_html( $title ) . '</h3>';
            echo '<p class="trad-post-date">' . esc_html( $date ) . '</p>';
            echo '<p class="trad-post-description">' . esc_html( wp_trim_words( $description, 20, '...' ) ) . '</p>';
            echo '<a href="' . esc_url( get_permalink() ) . '" class="trad-post-read-more-button">' . esc_html__( 'Read More', 'freemius-turbo-addons-elementor-pro' ) . '</a>';
            echo '</div>';
        }
    }

    // found_posts already holds the total; no second "fetch every post" query needed.
    $total = (int) $query->found_posts;
    wp_reset_postdata();
    $html = ob_get_clean();

    wp_send_json_success( [
        'html'     => $html,
        'count'    => $count,
        'has_more' => ( $offset + $count ) < $total,
    ] );
}
