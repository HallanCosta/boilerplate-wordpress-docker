<?php

add_action('admin_init', 'set_user_metaboxes');

function set_user_metaboxes($user_id=NULL)
{
    // So this can be used without hooking into user_register
    if ( !$user_id ) $user_id = get_current_user_id();

    // Set the default order if it has not been set yet
    if ( !get_user_meta( $user_id, 'meta-box-order_post', true) )
    {
        $meta_value = array(
            'side' => 'submitdiv,formatdiv,categorydiv,tagsdiv-post_tag,authordiv,postimagediv',
            'normal' => 'postexcerpt,postcustom,commentstatusdiv,commentsdiv,trackbacksdiv,slugdiv,revisionsdiv',
            'advanced' => '',
        );
        update_user_meta( $user_id, 'meta-box-order_post', $meta_value );
    }

    // Set the default hiddens if it has not been set yet
    if ( !get_user_meta( $user_id, 'metaboxhidden_post', true) )
    {
        $meta_value = array('postcustom','trackbacksdiv','commentstatusdiv','commentsdiv','slugdiv'/* ,'authordiv','revisionsdiv' */);
        update_user_meta( $user_id, 'metaboxhidden_post', $meta_value );
    }
}



/* add_filter('acf/fields/post_object/query/name=noticias_relacionadas', 'limitar_noticias_relacionadas', 10, 3);

function limitar_noticias_relacionadas( $args, $field, $post_id ) {

    // Restrict results to children of the current post only.
    $args['post__not_in'] = [
        $post_id
    ];

    return $args;
} */



/* add_post_type_support( 'page', 'excerpt' );

function wpse_edit_post_show_excerpt( $user_login, $user )
{
    $unchecked = get_user_meta( $user->ID, 'metaboxhidden_post', true );

    $key_excerpt = array_search( 'postexcerpt', $unchecked );
    $key_author = array_search( 'authordiv', $unchecked );

    if ( FALSE !== $key_excerpt ) array_splice( $unchecked, $key_excerpt, 1 );
    if ( FALSE !== $key_author ) array_splice( $unchecked, $key_author, 1 );

    if ( FALSE !== $key_excerpt || FALSE !== $key_author ) {
        update_user_meta( $user->ID, 'metaboxhidden_post', $unchecked );
    }
}
add_action( 'wp_login', 'wpse_edit_post_show_excerpt', 10, 2 ); */