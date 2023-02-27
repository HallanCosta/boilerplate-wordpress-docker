<?php

function buildPost()
{
    global $post;

    $postId = $post->ID;

    $title = $post->post_title;
    $content = $post->post_content;
    $date = get_the_date('d/M/Y');

    $bannerId = get_post_thumbnail_id($postId);
    $bannerUrl = wp_get_attachment_image_src($bannerId, 'post-noticias');
    $banner = $bannerUrl[0] != "" ? $bannerUrl[0] : 'https://www.4devs.com.br/4devs_gerador_imagem.php?acao=gerar_imagem&txt_largura=1170&txt_altura=800&extensao=png&fundo_r=0&fundo_g=0&fundo_b=0&texto_r=0&texto_g=0&texto_b=0&texto=&tamanho_fonte=10';

    $postArray =[
        'post_title'     => $title,
        'post_resume'    => $resume,
        'post_content'   => $content,
        'post_image'    => $banner,
        'post_date'      => $date
    ];

    wp_reset_postdata();

    return $postArray;
}