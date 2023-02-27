<?php


/* add_filter( 'get_edit_post_link', 'wpse107783_remove_media_icon_link', 20, 2 );

function wpse107783_remove_media_icon_link( $url, $post_id )
{
    if ( !is_user_logged_in() || 'upload' !== get_current_screen()->id )
        return $url;

    return '';//sprintf( '#post-%s', $post_id );
} */

add_filter('media_row_actions', 'remove_media_row_actions', 10, 1);

function remove_media_row_actions($actions)
{
    //unset( $actions['edit'] );
    unset( $actions['view'] );
    //unset( $actions['regenerate_thumbnails'] );

    return $actions;
}


















add_filter('manage_media_columns', 'colunas_media');

function colunas_media($defaults)
{
    unset($defaults['comments']);
    unset($defaults['title']);
    unset($defaults['alt']);
    unset($defaults['author']);
    unset($defaults['parent']);
    unset($defaults['date']);

    $defaults = array_merge(
        $defaults,
        [
            //'cb' => '',
            'title' => 'Nome',
            'alt' => 'Texto alternativo',
            'author' => 'Autor',
            'parent' => 'Anexado a',
            'date' => 'Data',
        ]
    );

    return $defaults;
}



add_action('manage_media_custom_column', 'media_colunas_conteudo', 10, 2);

function media_colunas_conteudo($column_name, $post_ID)
{
    if ($column_name == 'alt')
    {
        $alt = trim( get_post_meta($post_ID, '_wp_attachment_image_alt', true) );

        echo $post_ID !== 0 && $alt !== '' ? $alt : '&mdash;';
    }
}