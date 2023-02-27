<?php

add_action('admin_footer', 'admin_footer');

function admin_footer()
{
    global $_wp_admin_css_colors, $pagenow;

//     if ( is_user_logged_in() )
//     {
//         if (!function_exists('get_current_screen')) {
//             require_once(ABSPATH . 'wp-admin/includes/screen.php');
//         }
//         $current_screen = get_current_screen();

//         $limites = ['categoria' => 32, 'projeto' => 64];

//         if (isset($limites["{$current_screen->post_type}"]) && $pagenow === 'edit.php')
//         {
//             echo <<<HEREDOC
// <script type="text/javascript">
//     document.getElementsByClassName('ptitle')[0].setAttribute('maxlength', {$limites["{$current_screen->post_type}"]});
// </script>
// HEREDOC;
//         }

//     }
}



add_action('admin_head', 'head');
add_action('login_head', 'head');

function head()
{
    global $_wp_admin_css_colors, $pagenow;

    $_wp_admin_css_colors = 0;

    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . get_bloginfo('wpurl') . '/favicon-32x32.png?2">';
    // echo '<style type="text/css">.login h1 a {width: 200px; background-size: 200px;}</style>';

    //

    if ( is_user_logged_in() )
    {
        if (!function_exists('get_current_screen')) {
            require_once(ABSPATH . 'wp-admin/includes/screen.php');
        }
        $current_screen = get_current_screen();

        if (!is_null($current_screen))
        {
        /**
         * 
         * GLOBAL
         * 
         */

        /* td.colspanchange {
            padding: 8px 10px !important;
        } */

        echo <<<HEREDOC
<style type="text/css">
    .widefat td {
        vertical-align: middle;
    }
</style>
HEREDOC;

        // Retira a SCREEN OPTION de AJUDA

        if (
            in_array($current_screen->post_type, ['post', 'attachment'])
            ||
            in_array($pagenow, ['users.php', 'profile.php', 'user-new.php', 'user-edit.php', 'upload.php', 'media-new.php', 'index.php'])
        )
        {
            $current_screen->remove_help_tabs();
        }



        // Retira as opções de COLUNAS e MODO DE VISUALIZAÇÃO do SCREEN OPTIONS

        if (
            in_array($current_screen->post_type, ['post', 'sou_fornecedor', 'seja_fornecedor', 'contato', 'lead', 'attachment'])
            ||
            $pagenow === 'users.php'
        )
        {
            echo <<<HEREDOC
<style type="text/css">
    #screen-options-wrap fieldset.metabox-prefs,
    #screen-options-wrap fieldset.metabox-prefs.view-mode {
        display: none !important;
    }
</style>
HEREDOC;
        }



        // Retira a SCREEN OPTIONS

        if (

            // novo POST ou CPT
            (
                in_array($pagenow, ['post-new.php']) && in_array($current_screen->post_type, ['post', 'sou_fornecedor', 'seja_fornecedor'])
            )
            ||

            // alterar POST ou CPT
            (
                in_array($pagenow, ['post.php']) && ($_REQUEST['action'] == 'edit') && in_array($current_screen->post_type, ['post', 'sou_fornecedor', 'seja_fornecedor', 'contato', 'lead'])
            )

            ||

            // Biblioteca de mídias (novo e editar)
            (
                in_array($pagenow, ['post.php']) && in_array($current_screen->post_type, ['attachment'])
            )
        )
        {
            echo <<<HEREDOC
<style type="text/css">
    #screen-options-link-wrap {
        display: none !important;
    }
</style>
HEREDOC;
        }



        // Retira opções de status, visibilidade e agendamento do POST ou CPT

        if (
            in_array($current_screen->post_type, ['post', 'sou_fornecedor', 'contato', 'lead'])
        )
        {
            echo <<<HEREDOC
<style type="text/css">#add_pod_button, #misc-publishing-actions, #minor-publishing-actions { display: none !important; }</style>
HEREDOC;
        }



        // Retira do POST as opções de CATEGORIA ASCENDENTE (Categorias)

        if (
            in_array($current_screen->post_type, ['post'])
        )
        {
            echo <<<HEREDOC
<style type="text/css">#newcategory_parent { display: none !important; }</style>
HEREDOC;
        }



        // Retira o TÍTULO da CAIXA do ACF

        if (
            in_array($current_screen->post_type, ['post', 'sou_fornecedor', 'seja_fornecedor'])
        )
        {
            echo <<<HEREDOC
<style type="text/css">.acf-postbox .postbox-header { display: none !important; }</style>
HEREDOC;
        }



        // Retira o TÍTULO da CAIXA do PODS

        if (
            in_array($current_screen->post_type, ['contato', 'lead'])
        )
        {
            echo <<<HEREDOC
<style type="text/css">#pods-meta-mais-campos .postbox-header, #pods-meta-more-fields .postbox-header { display: none !important; }</style>
HEREDOC;
        }



        // Retira campos excedentes do editor de categorias e assuntos

        if (
            ( $pagenow === 'edit-tags.php' && (in_array($_REQUEST['taxonomy'], ['category', 'post_tag'])) )
            ||
            ( $pagenow === 'term.php' && (in_array($_REQUEST['taxonomy'], ['category', 'post_tag'])) )
        )
        {
            echo <<<HEREDOC
<style type="text/css">.form-field.term-parent-wrap, .form-field.term-description-wrap { display: none !important; }</style>
HEREDOC;
        }



        // AUTO WIDTH para colunas do editor de categorias e assuntos

        if (
            ( $pagenow === 'edit-tags.php' && (in_array($_REQUEST['taxonomy'], ['category', 'post_tag'])) )
        )
        {
            echo <<<HEREDOC
<style type="text/css">
    .manage-column.column-name,
    .manage-column.column-slug,
    .manage-column.column-posts {
        width: auto !important;
    }
    .posts.column-posts
    {
        text-align: left;
    }
</style>
HEREDOC;
        }




        // Remove filtro por data

        if (
            in_array($current_screen->post_type, ['sou_fornecedor', 'seja_fornecedor'])
        )
        {
            add_filter('months_dropdown_results', '__return_empty_array');
        }



        //
        //
        //



        /**
         * 
         * PERSONALIZAÇÕES PARA "MÍDIA"
         * 
         */

        echo <<<HEREDOC
<style type="text/css">

.attachment-details [data-setting="caption"],
.attachment-details [data-setting="description"]
{
display: none !important;
}

</style>
HEREDOC;

        if ( $current_screen->post_type === 'attachment' || $pagenow === 'upload.php' )
        {

            echo <<<HEREDOC
<style type="text/css">

.manage-column.column-title,
.manage-column.column-alt,
.manage-column.column-author,
.manage-column.column-parent,
.manage-column.column-date
{
    width: auto !important;
}

label[for="attachment_caption"],
#attachment_caption,
.attachment-content-description,
#wp-attachment_content-wrap
{
    display: none !important;
}

</style>
HEREDOC;
        }



        //
        //
        //



        /**
         * 
         * PERSONALIZAÇÕES PARA "USUÁRIOS"
         * 
         */

        if ( $pagenow === 'users.php' )
        {
            // Retira as abas acima da lista de usuários

            echo <<<HEREDOC
<style type="text/css">

ul.subsubsub { display: none !important; }

.manage-column.column-username,
.manage-column.column-name,
.manage-column.column-email,
.manage-column.column-posts
{
    width: auto !important;
}

</style>
HEREDOC;
        }

        // in_array($pagenow, ['users.php', 'profile.php', 'user-new.php', 'user-edit.php', 'upload.php', 'media-new.php', 'index.php'])

        if (
            in_array($pagenow, ['profile.php', 'user-edit.php'])
        )
        {
            echo <<<HEREDOC
<style type="text/css">

    /* Retira o bloco "Senhas da aplicação */
    #application-passwords-section,

    /* Retira o título (h2) EDIT AUTHOR SLUG */
    #your-profile > h2:last-of-type,

    /* Retira o texto após o título EDIT AUTHOR SLUG */
    #your-profile > h2:last-of-type + p,

    /* Retira as opções do EDIT AUTHOR SLUG */
    #your-profile > h2:last-of-type + p + table {
        display: none !important;
    }


    /*  */


    /* Nome */
    #your-profile > h2:nth-of-type(2),

    /* Sobre você */
    #your-profile > h2:nth-of-type(4),

    tr.user-syntax-highlighting-wrap,
    tr.user-last-name-wrap,
    tr.user-rich-editing-wrap,
    tr.user-comment-shortcuts-wrap,
    tr.user-admin-bar-front-wrap,
    tr.user-language-wrap,
    tr.user-url-wrap,
    tr.user-description-wrap,

    /* Picture no gravatar */
    tr.user-profile-picture,

    tr.ratings-row
    {
        display: none !important;
    }

</style>
HEREDOC;
        }

        if ( $pagenow === 'user-new.php' && !current_user_can( 'manage_options' ))
        {
            echo <<<HEREDOC
<style type="text/css">
#createuser .form-table:nth-of-type(1) tr:nth-of-type(4) {display: none !important;} /* Sobrenome */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(5) {display: none !important;} /* Site */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(6) {display: none !important;}  /* Idioma */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(11) {display: none !important;} /* Função */
.submit {display: none !important;} /* Button add new user */
</style>
HEREDOC;
        }

        if ($pagenow === 'user-new.php' && current_user_can( 'manage_options' )) {
            echo <<<HEREDOC
<style type="text/css">
#createuser .form-table:nth-of-type(1) tr:nth-of-type(4) {display: none !important;} /* Sobrenome */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(5) {display: none !important;} /* Site */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(6) {display: none !important;}  /* Idioma */
#createuser .form-table:nth-of-type(1) tr:nth-of-type(11) option[value='contributor'] {display: none !important;} /* Função - Contributor*/
#createuser .form-table:nth-of-type(1) tr:nth-of-type(11) option[value='editor'] {display: none !important;} /* Função - Editor*/
#createuser .form-table:nth-of-type(1) tr:nth-of-type(11) option[value='administrator'] {display: none !important;} /* Função - Administrador*/
#createuser .form-table:nth-of-type(1) tr:nth-of-type(11) option[value='subscriber'] {display: none !important;} /* Função - Assinante*/
</style>

<script>

setTimeout(function() {
    var select = document.querySelector('#role');
    console.log('test:', select)
    
    select.innerHTML = '<option value="author" selected>Autor</option>';
}, 200)

</script>
HEREDOC;
        }


        //
        //
        //



        /**
         * 
         * PERSONALIZAÇÕES PARA "NOTÍCIA"
         * 
         */

        if ( 'post' === $current_screen->post_type )
        {
            echo <<<HEREDOC
<style type="text/css">
    .manage-column.column-imagem {
        width: 75px !important;
    }
    .manage-column.column-visualizacoes {
        width: 150px !important;
    }
    .manage-column.column-title,
    .manage-column.column-author,
    .manage-column.column-categories,
    .manage-column.column-tags,
    .manage-column.column-date {
        width: auto !important;
    }
</style>
HEREDOC;
        }

        /**
         * 
         * PERSONALIZAÇÕES PARA "sou_fornecedor"
         * 
         */

        if ( $current_screen->post_type == 'sou_fornecedor' )
        {
            echo <<<HEREDOC
<style type="text/css">
    .column-title,
    .column-redirecionamento {
        width: auto !important;
    }

    .acf-editor-wrap .quicktags-toolbar, .acf-editor-wrap .mce-top-part { display: none !important; }
</style>
HEREDOC;
        }


        /**
         * 
         * PERSONALIZAÇÕES PARA "seja_fornecedor"
         * 
         */

        if ( $current_screen->post_type == 'seja_fornecedor' )
        {
            echo <<<HEREDOC
<style type="text/css">
    .column-title,
    .column-redirecionamento {
        width: auto !important;
    }

    .acf-editor-wrap .quicktags-toolbar, .acf-editor-wrap .mce-top-part { display: none !important; }
</style>
HEREDOC;
        }


        /**
         * 
         * PERSONALIZAÇÕES PARA "form_seja_fornecedor"
         * 
         */

        if ( $current_screen->post_type == 'form_seja_fornecedor' )
        {
            echo <<<HEREDOC
<style type="text/css">
 
    .acf-actions { display: none !important; }
</style>
HEREDOC;
        }

    


        /**
         * 
         * CONTATO
         * 
         */

        if (
            'contato' === $current_screen->post_type
        )
        {
            echo <<<HEREDOC
<style type="text/css">
    .tablenav .actions
    {
        padding: 4px 0 6px 0;
    }

    .view-mode
    {
        display: none !important;
    }

    .manage-column.column-title, /* nome */
    .manage-column.column-email,
    .manage-column.column-telefone,
    .manage-column.column-mensagem,
    .manage-column.column-data {
        width: auto !important;
    }
</style>
HEREDOC;
        }



        /**
         * 
         * LEADS DO FORM BAIXAR APRESENTAÇÃO
         * 
         */

        if (
            'lead' === $current_screen->post_type
        )
        {
            echo <<<HEREDOC
<style type="text/css">
    .tablenav .actions
    {
        padding: 4px 0 6px 0;
    }

    .view-mode
    {
        display: none !important;
    }

    .manage-column.column-title, /* nome */
    .manage-column.column-email,
    .manage-column.column-telefone,
    .manage-column.column-cidade,
    .manage-column.column-razao_social,
    .manage-column.column-cnpj,
    .manage-column.column-interesse,
    .manage-column.column-mensagem,
    .manage-column.column-data {
        width: auto !important;
    }
</style>
HEREDOC;
        }
        }
    }
}