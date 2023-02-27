<?php

// Remove notifications

function remove_core_updates()
{
    global $wp_version;

    return(object) array(
        'last_checked'=> time(),
        'version_checked'=> $wp_version,
    );
}

add_filter('pre_site_transient_update_core', 'remove_core_updates'); //hide updates for WordPress itself
add_filter('pre_site_transient_update_plugins', 'remove_core_updates'); //hide updates for all plugins
add_filter('pre_site_transient_update_themes', 'remove_core_updates'); //hide updates for all themes

// Disable updates

// add_filter( 'auto_update_theme', '__return_false' );
add_filter( 'auto_update_plugin', '__return_false' );