<?php

add_filter('manage_edit-category_columns', 'category_columns');

function category_columns($columns)
{
    unset($columns['description']);

    return $columns;
}

add_filter('manage_edit-post_tag_columns', 'tag_columns');

function tag_columns($columns)
{
    unset($columns['description']);

    return $columns;
}