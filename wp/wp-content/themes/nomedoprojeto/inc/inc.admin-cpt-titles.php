<?php



// Aplicar TITLE (do inline-edit) como TÍTULO PERSONALIZADO do CPT

function titleQuickEdit( $post_id, $post )
{
    // pointless if $_POST is empty (this happens on bulk edit)
    if ( empty( $_POST ) )
        return $post_id;

    // verify quick edit nonce
    if ( isset( $_POST[ '_inline_edit' ] ) && ! wp_verify_nonce( $_POST[ '_inline_edit' ], 'inlineeditnonce' ) )
        return $post_id;

    /* // don't save for autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // dont save for revisions
    if ( isset( $post->post_type ) && $post->post_type == 'revision' )
        return $post_id; */

    if ( !in_array(get_post_type($post_id), ['categoria', 'projeto']) )
        return $post_id;

    $title = trim(esc_html(get_the_title($post_id)));

    update_field( 'nome', $title, $post_id );
}

add_action( 'save_post', 'titleQuickEdit', 10, 2 );



// Aplicar TÍTULO PERSONALIZADO do CPT como TITLE

add_action( 'acf/save_post', 'biwp_set_title_from_first_last_name', 20 );

function biwp_set_title_from_first_last_name( $post_id )
{
    $post_type = get_post_type( $post_id );

    /* if ( 'servico' == $post_type )
    {
        $titulo_menu = trim( esc_html( get_field('titulo_menu', $post_id) ) );

        $data = array(
            'ID'         => $post_id,
            'post_title' => $titulo_menu,
            'post_name'  => sanitize_title($titulo_menu),
        );

        wp_update_post( $data );
    } */

    if ( in_array($post_type, ['categoria', 'projeto']) )
    {
        $nome = trim( esc_html( get_field('nome', $post_id) ) );

        $data = array(
            'ID'         => $post_id,
            'post_title' => $nome,
            'post_name'  => sanitize_title($nome),
        );

        wp_update_post( $data );
    }
}



// Altera o placeholder dos títulos de CPT

function current_screen_callback($screen)
{
    if ( is_object($screen) )
    {
        if (
            in_array($screen->post_type, ['banner'])
        )
        {
            add_filter('gettext', function($translation, $original)
            {
                if (strpos($original, 'title') !== false) {
                    return 'Nome do banner';
                }

                return $translation;
            }, 99, 3);
        }

    }
}

add_action('current_screen', 'current_screen_callback');
