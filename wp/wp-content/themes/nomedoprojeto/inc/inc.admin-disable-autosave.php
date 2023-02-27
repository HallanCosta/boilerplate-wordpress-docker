<?php

add_action('admin_print_scripts', 'disable_autosave');

function disable_autosave()
{
    global $post;

    if (!is_null($post)) {
        $pt = get_post_type($post->ID);

        if (in_array($pt, ['post', 'banner', 'categoria', 'projeto', 'contato', 'lead'])) {
            wp_deregister_script('autosave');
        }
    }
}

function wpdocs_untrash_multiple_posts( $post_id = '' ) {
    wp_update_post(['ID' => $post_id, 'post_status' => 'publish']);

    // error_log("[{$post_id}] " . var_export($_GET, true) . ' | ' . get_post_status($post_id) . ' | ' . get_post_meta( $post_id, '_wp_trash_meta_status', true ) );
}
add_action( 'untrashed_post', 'wpdocs_untrash_multiple_posts' );