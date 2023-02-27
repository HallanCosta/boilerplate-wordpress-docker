<?php

add_filter('add_meta_boxes', 'hide_meta_boxes_post');

function hide_meta_boxes_post()
{
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('commentstatusdiv', 'post', 'normal');
    remove_meta_box('commentsdiv', 'post', 'normal');
;
    remove_meta_box('slugdiv', 'banner', 'normal');
    remove_meta_box('commentstatusdiv', 'banner', 'normal');
    remove_meta_box('commentsdiv', 'banner', 'normal');

    remove_meta_box('slugdiv', 'categoria', 'normal');
    remove_meta_box('commentstatusdiv', 'categoria', 'normal');
    remove_meta_box('commentsdiv', 'categoria', 'normal');

    remove_meta_box('slugdiv', 'projeto', 'normal');
    remove_meta_box('commentstatusdiv', 'projeto', 'normal');
    remove_meta_box('commentsdiv', 'projeto', 'normal');

    remove_meta_box('slugdiv', 'contato', 'normal');
    remove_meta_box('commentstatusdiv', 'contato', 'normal');
    remove_meta_box('commentsdiv', 'contato', 'normal');
    remove_meta_box('submitdiv', 'contato', 'side');

    remove_meta_box('slugdiv', 'lead', 'normal');
    remove_meta_box('commentstatusdiv', 'lead', 'normal');
    remove_meta_box('commentsdiv', 'lead', 'normal');
    remove_meta_box('submitdiv', 'lead', 'side');
}

add_action('wp_dashboard_setup', 'wporg_remove_all_dashboard_metaboxes');

function wporg_remove_all_dashboard_metaboxes()
{
    // Remove Welcome panel
    remove_action( 'welcome_panel', 'wp_welcome_panel' );

    // Remove the rest of the dashboard widgets
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
    remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' );
    remove_meta_box( 'health_check_status', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' );
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
}