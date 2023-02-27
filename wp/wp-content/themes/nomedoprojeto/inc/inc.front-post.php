<?php

add_filter('next_posts_link_attributes', function() {
    return 'class="nav-next"';
});

add_filter('previous_posts_link_attributes', function() {
    return 'class="nav-prev"';
});