<?php

add_filter('rwmb_meta_boxes', 'rwmb_meta_boxes_notices_fields');

function rwmb_meta_boxes_notices_fields( $meta_boxes )
{
    $prefix = 'neoplan_';

    $meta_boxes[] = array(
        'id'        => $prefix."noticia",
        'title'     => 'Informações adicionais',
        // 'pages'     => array( 'neoplan_tipo_de_ensaio' ),
        'post_types' => [ 'post' ],
        'context' => 'normal',
        'fields'    => array(
            array(
                'name' => 'Resumo',
                'id' => "{$prefix}noticia_resumo",
                'desc' => 'Digite o resumo da notícia',
                'type' => 'textarea',
                'cols' => 50,
                'maxlength' => 104
            ),
        )
    );
    
    return $meta_boxes;
}