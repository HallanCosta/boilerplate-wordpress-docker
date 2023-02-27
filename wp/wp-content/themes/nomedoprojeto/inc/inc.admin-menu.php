<?php

/* add_action( 'load-profile.php', function() {
    if( ! current_user_can( 'manage_options' ) )
        exit( wp_safe_redirect( admin_url() ) );
} ); */


add_action( 'wp_before_admin_bar_render', 'my_admin_bar_render' );

function my_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('page');
}

add_action( 'admin_bar_menu', 'remove_wp_nodes', 999 );

function remove_wp_nodes() 
{
    global $wp_admin_bar;   
    $wp_admin_bar->remove_node( 'new-post' );
    $wp_admin_bar->remove_node( 'new-page' );
}


function formularios()
{

}

/* add_filter( 'wp_mail_smtp_admin_adminbarmenu_has_access', '__return_false' ); */

/* add_filter( 'wp_mail_smtp_admin_adminbarmenu_has_access', function() {
    return false;
}); */

add_action('admin_menu', function()
{
    // Renomear menu POSTS

    global $menu;
    global $submenu;
    $menu[5][0] = 'Notícias';
    $submenu['edit.php'][5][0] = 'Todas as notícias';
    $submenu['edit.php'][10][0] = 'Nova notícia';
    echo '';


    // remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
    remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');


    // Retira alguns menus administrativos do EDITOR

    if ( is_user_logged_in() )
    {
        $user = wp_get_current_user();

        /** FORMULÁRIOS */
        remove_menu_page('edit.php?post_type=contato');
        // remove_menu_page('edit.php?post_type=suggestion_claims');
        // remove_menu_page('edit.php?post_type=form_seja_fornecedor');


        remove_menu_page('edit.php?post_type=lead');

        remove_menu_page('edit.php?post_type=categoria');
        remove_menu_page('edit.php?post_type=projeto');

        // remove_menu_page('cs-notification-settings');

        if ( is_user_in_role($user->ID, 'editor') )
        {
            // remove_menu_page( 'edit.php' );
            remove_menu_page( 'pods' );
            remove_menu_page( 'options-general.php' );
            remove_menu_page( 'edit.php?post_type=page' );
            remove_menu_page( 'tools.php' );
            remove_menu_page( 'edit-comments.php' );
            // remove_menu_page( 'edit.php?post_type=acf-field-group' );
            // remove_menu_page( 'wp-mail-smtp' );
            // remove_menu_page( 'toplevel_page_wp-mail-smtp' );
        }
    }



    add_menu_page(
        'Formulários',
        'Formulários', // menu
        'exportacao_contatos',
        'menu-formularios',
        'formularios',
        'dashicons-buddicons-pm'
    );

    add_submenu_page('menu-formularios', 'Contato', 'Contato', 'exportacao_contatos', 'edit.php?post_type=contato');
    // add_submenu_page('menu-formularios', 'Sugestões e Reclamações', 'Sugestões e Reclamações', 'exportacao_contatos', 'edit.php?post_type=suggestion_claims');
    // add_submenu_page('menu-formularios', 'Seja um Fornecedor', 'Seja um Fornecedor', 'exportacao_contatos', 'edit.php?post_type=form_seja_fornecedor');
    add_submenu_page('menu-formularios', 'Separator', '<span style="user-select: none; display:block; margin:1px 0 1px -5px; padding:0; height:1px; line-height:1px; background-color: rgba(255, 255, 255, 0.3)"></span>', 'exportacao_contatos', '#');
    // add_submenu_page('menu-formularios', 'Notificações', 'Notificações', 'exportacao_contatos', 'admin.php?page=cs-notification-settings');
    add_submenu_page('menu-formularios', 'Notificações', 'Notificações', 'exportacao_contatos', 'exportacao', 'my_cool_plugin_settings_page');

    // add_menu_page('My Cool Plugin Settings', 'Cool Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page', get_stylesheet_directory_uri('stylesheet_directory')."/images/media-button-other.gif");

    remove_submenu_page( 'menu-formularios', 'menu-formularios' ); // Remove sub menu que faz referência ao pai

    /**
     * 
     * LOJAS
     * 
     */

    add_menu_page(
        'Projetos',
        'Projetos', // menu
        'nossos_projetos',
        'menu-projetos',
        'lojas',
        'dashicons-admin-multisite
        '
    );

    add_submenu_page('menu-projetos', 'Projetos', 'Projetos', 'nossos_projetos', 'edit.php?post_type=projeto');
    add_submenu_page('menu-projetos', 'Tipos de projeto', 'Tipos de projeto', 'nossos_projetos', 'edit.php?post_type=categoria');

    // add_menu_page('My Cool Plugin Settings', 'Cool Settings', 'administrator', __FILE__, 'my_cool_plugin_settings_page', get_stylesheet_directory_uri('stylesheet_directory')."/images/media-button-other.gif");

    remove_submenu_page( 'menu-projetos', 'menu-projetos' ); // Remove sub menu que faz referência ao pai
});



add_action( 'admin_init', 'register_my_cool_plugin_settings' );

function register_my_cool_plugin_settings() {
    // Access global variables.
    global $menu;

    foreach ( $menu as $key => $val ) {
        if ( 'Notícias' == $val[0] ) {
            $menu[$key][6] = 'dashicons-megaphone';
        }
    }

    // remove_post_type_support('post', 'revisions');
    // remove_post_type_support('page', 'revisions');

	register_setting( 'cs-notifications-settings', 'form_contato' );
    // register_setting( 'my_options_group', 'my_option_name', 'intval' ); 
}

function my_cool_plugin_settings_page()
{
    $form_contato = esc_attr( get_option('form_contato') );
    // $form_lead = esc_attr( get_option('form_lead') );

    echo <<<HEREDOC
<div class="wrap">
    <h1>Notificações</h1>

    <form method="post" action="options.php">
HEREDOC;
        settings_fields( 'cs-notifications-settings' );
        do_settings_sections( 'cs-notifications-settings' );
echo <<<HEREDOC
        <table class="form-table">
            <tr valign="top">
            <th scope="row">Formulário de Contato:<br><span style="display: inline-block;font-size: 13px;font-weight: 500;padding-top: 7px;color: #888">Informe os e-mails que vão receber o formulário.</span></th>
            <td><textarea name="form_contato" style="width: 100%; min-height: 150px" placeholder="Exemplo:\nteste1@email.com.br\nteste2@email.com.br">{$form_contato}</textarea></td>
            </tr>
        </table>
HEREDOC;
        submit_button();
echo <<<HEREDOC
    </form>
</div>
HEREDOC;
}

add_filter('custom_menu_order', 'wpse_custom_menu_order', 10, 1);
add_filter('menu_order', 'wpse_custom_menu_order', 10, 1);

function wpse_custom_menu_order($menu_ord)
{
    if (!$menu_ord) {
        return true;
    }

    return array(
        'index.php',
        'upload.php',
        'edit.php',
        'edit.php?post_type=contato',
        
        'separator1', // separator
        
        'menu-projetos',
        // 'edit.php?post_type=midia',

        'separator2', // separator

        'menu-formularios',
        'relatorios-de-email',

        'separator-last', // separator

        'users.php', // 
        'profile.php', // 
    );
}