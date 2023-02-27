<?php

add_filter('category_row_actions', 'remove_category_row_actions', 10, 1);

function remove_category_row_actions($actions)
{
    unset( $actions['edit'] );

    return $actions;
}

add_filter('tag_row_actions', 'remove_tag_row_actions', 10, 1);

function remove_tag_row_actions($actions)
{
    unset( $actions['edit'] );

    return $actions;
}