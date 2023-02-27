<?php

add_filter('manage_users_columns', 'user_columns');

function user_columns($columns)
{
    if ( is_user_logged_in() && !current_user_can('administrator') )
    {
        // unset($columns['role']);
        // unset($columns['ba-eas-author-slug']);
    }

    return $columns;
}