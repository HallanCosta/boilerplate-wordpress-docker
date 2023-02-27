<?php

function buildBlogNoticias($props = [
    'limit' => -1,
    'image_size' => 'thumbnail',
    'image_dummy' => 'https://www.4devs.com.br/4devs_gerador_imagem.php?acao=gerar_imagem&txt_largura=1170&txt_altura=800&extensao=png&fundo_r=0&fundo_g=0&fundo_b=0&texto_r=0&texto_g=0&texto_b=0&texto=&tamanho_fonte=10'
])
{
    extract($props, EXTR_OVERWRITE, "wddx");

    $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    $args = array(
        'post_type'      => 'post',
        'post_status' => 'publish',
        'posts_per_page' => $limit,
        'paged'          => $paged
    );
    $query = new WP_Query($args);

    $max_num_pages = $query->max_num_pages;

    $postsArray = [];
    $posts = get_posts($args);
    if (!empty($posts)) {

        foreach ($posts as $post){
            $id = $post->ID;
            $url = get_permalink($id);
            $title = $post->post_title;
            // $title = strlen($post->post_title) >= 29 ? substr($post->post_title, 0, 29) . '..' : $post->post_title;
            $resume = rwmb_meta( 'neoplan_noticia_resumo', '', $id );
            
            $text = strip_tags($post->post_content); // Usado para fazer cálculo do tempo de leitura
            $date = get_the_date('d/M/Y');
            $calculeteTimeRead = ((int)strlen($title) + (int)strlen($text)) / 265 * 60 * 1;
            $timeRead = explode(".", $calculeteTimeRead / 60)[0]; //https://pt.linkedin.com/pulse/como-o-medium-c%C3%A1lcula-tempo-de-leitura-um-artigo-guto-martins

            /* $image_post = get_rwmb_image_advanced([
                'field_id' => 'neoplan_noticia_imagem_pequena',
                'size'     => $image_size,
                'post_id'  => $id
            ]);
            
            $image = !is_null($image_post) ? $image_post[0] : $image_dummy; */

            $image = '';
            $imageId = get_post_thumbnail_id($id);

            if ((int)$imageId == 0) {
                $image = $image_dummy;
            } else {
                $image = wp_get_attachment_image_src($imageId, $image_size)[0];
            }

            $postsArray[] = [
                'post_id' => $id,
                'post_url' => $url,
                'post_title' => $title,
                'post_resume' => $resume,
                'post_date' => $date,
                'post_time_read' => $timeRead,
                'post_image'=> $image,
                'post_paginate_links' => getPagination($max_num_pages)
            ];
        }
    }
    
    wp_reset_postdata();

    return $postsArray;
}