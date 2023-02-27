<?php

/**
 * 
 * AÇÕES DE LISTAGEM
 * 
 */

add_filter('post_row_actions', 'remove_row_actions', 10, 1);

function remove_row_actions($actions)
{
    $pt = get_post_type();
    $pid = get_the_ID();

    if ( in_array($pt, ['post', 'sou_fornecedor']) )
    {
        unset( $actions['inline hide-if-no-js'] );
    }

    if ( in_array($pt, ['contato', 'lead']) )
    {
        unset( $actions['view'] );
        unset( $actions['inline hide-if-no-js'] );

        unset( $actions['edit'] );
        //unset( $actions[ 'trash' ] );
    }

    return $actions;
}



/**
 * 
 * AÇÕES EM MASSA
 * 
 */

/* add_filter('bulk_actions-edit-post', function($actions)
{
    unset( $actions[ 'edit' ] );
    return $actions;
}); */

add_filter('bulk_actions-edit-sou_fornecedor', function($actions)
{
    unset( $actions[ 'edit' ] );
    return $actions;
});


add_filter('bulk_actions-edit-banner', function($actions)
{
    unset( $actions[ 'edit' ] );
    return $actions;
});

add_filter('bulk_actions-edit-contato', function($actions)
{
    unset( $actions[ 'edit' ] );
    return $actions;
});

add_filter('bulk_actions-edit-lead', function($actions)
{
    unset( $actions[ 'edit' ] );
    return $actions;
});