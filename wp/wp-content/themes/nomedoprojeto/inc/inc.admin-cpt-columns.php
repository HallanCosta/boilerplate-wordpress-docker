<?php
add_filter('manage_sou_fornecedor_posts_columns', 'sou_fornecedor_colunas_cabecalho');
function sou_fornecedor_colunas_cabecalho($columns)
{
    unset($columns['title']);
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'title' => 'Título',
            'imagem' => 'Imagem',
            'documento_1' => 'Documento 1',
            'documento_2' => 'Documento 2',
            'link_1' => 'Link da página 1',
            'link_2' => 'Link da página 2'
        ]
    );

    return $columns;
}

add_filter('manage_seja_fornecedor_posts_columns', 'seja_fornecedor_colunas_cabecalho');
function seja_fornecedor_colunas_cabecalho($columns)
{
    unset($columns['title']);
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'title' => 'Título',
            'documento_1' => 'Documento 1',
            'documento_2' => 'Documento 2',
            'documento_3' => 'Documento 3',
            'documento_4' => 'Documento 4'
        ]
    );

    return $columns;
}


add_filter('manage_suggestion_claims_posts_columns', 'suggestion_claims_colunas_cabecalho');
function suggestion_claims_colunas_cabecalho($columns)
{
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'mensagem' => 'Mensagem'
        ]
    );

    return $columns;
}

add_filter('manage_form_seja_fornecedor_posts_columns', 'form_seja_fornecedor_colunas_cabecalho');
function form_seja_fornecedor_colunas_cabecalho($columns)
{
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'nome' => 'Nome',
            'arquivo' => 'Arquivo',
            'mensagem' => 'Mensagem',
            'date' => 'Data'
        ]
    );

    return $columns;
}

add_filter('manage_contato_posts_columns', 'contato_colunas_cabecalho');
function contato_colunas_cabecalho($columns)
{
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'title' => 'Nome',
            'email' => 'E-mail',
            // 'telefone' => 'Telefone',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
        ]
    );

    return $columns;
}

add_filter('manage_lead_posts_columns', 'lead_colunas_cabecalho');
function lead_colunas_cabecalho($columns)
{
    unset($columns['date']);

    $columns = array_merge(
        $columns,
        [
            'title' => 'Nome',
            'email' => 'E-mail',
            'telefone' => 'Telefone',
            'cidade' => 'Cidade',
            'razao_social' => 'Razão social',
            'cnpj' => 'CNPJ',
            'interesse' => 'Interesse',
            'mensagem' => 'Mensagem',
            'data' => 'Data',
        ]
    );

    return $columns;
}





add_action('manage_posts_custom_column', 'colunas_conteudo', 10, 2);

function colunas_conteudo($column_name, $post_ID)
{
    $post_type = get_post_type($post_ID);



     /**
     * 
     * FORMULÁRIO DE SEJA UM FORNECEDOR
     * 
     */

    if (
        in_array($post_type, ['form_seja_fornecedor'])
    )
    {
        if ($column_name == 'title')
        {

        }

        if ($column_name == 'nome') {
            $nome = get_field('nome', $post_ID);
            echo $nome;
        }

        if ($column_name == 'arquivo') {
            $arquivo_id = get_field('arquivo', $post_ID);
            $attachment_url = wp_get_attachment_url($arquivo_id); 

            echo "<a href='{$attachment_url}' target='_blank'>Download: " . get_the_title($arquivo_id) . "</a>";
        }

        if ($column_name == 'mensagem') {
            echo str_replace( PHP_EOL, '<br />', get_field('mensagem', $post_ID) );
        }
    }


     /**
     * 
     * SUGESTÕES E RECLAMAÇÕES
     * 
     */

    if (
        in_array($post_type, ['suggestion_claims'])
    )
    {
        if ($column_name == 'title')
        {
           

        }

        if ($column_name == 'mensagem') {
            echo str_replace( PHP_EOL, '<br />', get_field('mensagem', $post_ID) );
        }
    }


     /**
     * 
     * SOU FORNECEDOR
     * 
     */

    if (
        in_array($post_type, ['sou_fornecedor'])
    )
    {
        if ($column_name == 'title')
        {
           

        }

        if ($column_name == 'imagem')
        {
            $image = get_rwmb_image_advanced([
                'field_id' =>  'neoplan_sou_fornecedor_imagem',
                'size'     =>  'sz-admin-thumb',
                'post_id'  =>  $post_ID
            ])[0];

            echo "<img draggable=\"false\" src=\"{$image}\" alt=\"\">";
        }
        if ($column_name == 'documento_1')
        {
            $filename1 = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_sou_fornecedor_documento_1',
                'post_id'   =>  $post_ID
            ])[0]['url'];

            echo $filename1;
        }

        if ($column_name == 'documento_2')
        {
            $filename2 = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_sou_fornecedor_documento_2',
                'post_id'   =>  $post_ID
            ])[0]['url'];

            echo $filename2;
        }

        if ($column_name == 'link_1')
        {
            $link_1 = rwmb_meta( 'neoplan_sou_fornecedor_link_1',  array(), $post_id );
            echo $link_1;
        }
        if ($column_name == 'link_2')
        {
            $link_2 = rwmb_meta( 'neoplan_sou_fornecedor_link_2', array(), $post_id );
            echo $link_2;
        }
    }



    /**
     * 
     * SEJA FORNECEDOR
     * 
     */

    if (
        in_array($post_type, ['seja_fornecedor'])
    )
    {
        if ($column_name == 'title')
        {

        }

        if ($column_name == 'documento_1')
        {
            $filename = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_seja_fornecedor_documentos',
                'post_id'   =>  $post_ID
            ])[0]['url'];

            echo $filename;
        }

        if ($column_name == 'documento_2')
        {
            $filename = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_seja_fornecedor_documentos',
                'post_id'   =>  $post_ID
            ])[1]['url'];

            echo $filename;
        }

        if ($column_name == 'documento_3')
        {
            $filename = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_seja_fornecedor_documentos',
                'post_id'   =>  $post_ID
            ])[2]['url'];

            echo $filename;
        }

        if ($column_name == 'documento_4')
        {
            $filename = get_rwmb_file_advanced([
                'field_id'  =>  'neoplan_seja_fornecedor_documentos',
                'post_id'   =>  $post_ID
            ])[3]['url'];

            echo $filename;
        }
    }









    /**
     * 
     * FALE CONOSCO
     * 
     */

    if ($post_type == 'contato')
    {
        if ($column_name == 'title') {
            echo get_field('nome', $post_ID)->post_title;
        }
        if ($column_name == 'email') {
            echo get_field('email', $post_ID);
        }
  
        // if ($column_name == 'telefone') {
        //     echo get_field('telefone', $post_ID);
        // }
        /* if ($column_name == 'debug_current') {
            echo get_post_status($post_ID);
        }
        if ($column_name == 'debug') {
            echo get_post_meta( $post_ID, '_wp_trash_meta_status', true );
        } */
        // if ($column_name == 'origem') {
        //     /* $origemID = (int)get_field('origem', $post_ID);
        //     if ($origemID > 0) {
        //         $projetoURL = get_the_permalink($origemID);
        //         $projetoNome = get_field('nome', $origemID);
        //         echo "<a href=\"{$projetoURL}\" target=\"_blank\">{$projetoNome}</a>";
        //     } else {
        //         echo "<a href=\"" . getEndereco('contato') . "\" target=\"_blank\">Página \"Contato\"</a>";
        //     } */

        //     $origemUrl = get_field('origem', $post_ID);
        //     echo "<a href=\"{$origemUrl}\" target=\"_blank\">{$origemUrl}</a>";
        // }
        if ($column_name == 'mensagem') {
            echo str_replace( PHP_EOL, '<br />', get_field('mensagem', $post_ID) );
        }

        if ($column_name == 'data') {
            echo '<abbr title="' . get_the_date('d/m/Y H:i:s', $post_ID) . '">' . get_the_date('d/m/Y H:i', $post_ID) . '</abbr>';
        }
    }




    /**
     * 
     * LEADS DO FORM SEJA UM PARCEIRO
     * 
     */

    if ($post_type == 'lead')
    {
        if ($column_name == 'title') {
            // echo esc_html( trim(get_the_title($post_ID)) );
            echo get_field('lead', $post_ID)->post_title;
        }
        if ($column_name == 'email') {
            echo get_field('email', $post_ID);
        }
        if ($column_name == 'telefone') {
            echo get_field('telefone', $post_ID);
        }
        if ($column_name == 'cidade') {
            echo get_field('cidade', $post_ID);
        }
        if ($column_name == 'razao_social') {
            echo get_field('razao_social', $post_ID);
        }
        if ($column_name == 'cnpj') {
            echo get_field('cnpj', $post_ID);
        }
        if ($column_name == 'interesse') {
            echo get_field('interesse', $post_ID);
        }
        if ($column_name == 'mensagem') {
            echo str_replace( PHP_EOL, '<br />', get_field('mensagem', $post_ID) );
        }

        if ($column_name == 'data') {
            echo '<abbr title="' . get_the_date('d/m/Y H:i:s', $post_ID) . '">' . get_the_date('d/m/Y H:i', $post_ID) . '</abbr>';
        }
    }
}