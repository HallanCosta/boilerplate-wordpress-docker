<?php

function change_wp_search_size($query)
{
    if (!is_user_logged_in())
    {
        // Make sure it is a search page
        if ($query->is_search) {
            $query->set('post_type', ['post', 'page']);
            $query->query_vars['posts_per_page'] = 8; // Change 10 to the number of posts you would like to show
            // $query->query_vars['posts_per_page'] = 5; // Change 10 to the number of posts you would like to show
        }

        // Make sure it is an author page
        if ($query->is_author) {
            $query->query_vars['posts_per_page'] = 3;
        }

        // Make sure it is a tag page
        if ($query->is_tag) {
            $query->query_vars['posts_per_page'] = 3;
        }

        // Make sure it is a category page
        if ($query->is_category) {
            $query->query_vars['posts_per_page'] = 3;
        }
    }

    // Return our modified query variables
    return $query;
}

add_filter('pre_get_posts', 'change_wp_search_size'); // Hook our custom function onto the request filter