<?php

function getPagination($max_num_pages)
{
    return paginate_links( array(
        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
        'total'        => $max_num_pages,
        'current'      => max( 1, get_query_var('paged') ),
        'format'       => '?paged=%#%',
        'show_all'     => false,
        'type'         => 'plain',
        'end_size'     => 2,
        'mid_size'     => 1,
        'prev_next'    => true,
        'prev_text'    => sprintf( '<i></i> %1$s', __( 'Anterior', 'text-domain' ) ),
        'next_text'    => sprintf( '%1$s <i></i>', __( 'Próximo', 'text-domain' ) ),
        'add_args'     => false,
        'add_fragment' => '',
    ));
}