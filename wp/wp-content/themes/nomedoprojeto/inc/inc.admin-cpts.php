<?php

/* function disable_emojis_tinymce( $plugins )
{
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
} */

add_action('init', 'init');

function init()
{
    
    //

    register_taxonomy('post_tag', array());
    remove_post_type_support( 'page', 'comments' );
    remove_post_type_support( 'post', 'comments' );

    //

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
	remove_action( 'admin_print_styles', 'print_emoji_styles' );	
	remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
	remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );	
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

    //add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' ); // Remove from TinyMCE



    /**
     * 
     * ADICIONA CPTS NOS PAPEIS DE ADMIN E EDITOR
     * 
     */

    /**
     * 
     * ADMINISTRATOR CAPABILITIES
     * 
     */

    $roleAdministrator = get_role( 'administrator' );

    $roleAdministrator->add_cap( 'delete_published_posts', true );
    $roleAdministrator->add_cap( 'delete_private_posts', true );
    $roleAdministrator->add_cap( 'delete_others_posts', true );
    $roleAdministrator->add_cap( 'delete_post', true );
    $roleAdministrator->add_cap( 'delete_posts', true );
    $roleAdministrator->add_cap( 'create_posts', true );
    $roleAdministrator->add_cap( 'read_posts', true );
    $roleAdministrator->add_cap( 'edit_post', true );
    $roleAdministrator->add_cap( 'edit_posts', true );
    $roleAdministrator->add_cap( 'publish_posts', true );
    $roleAdministrator->add_cap( 'edit_published_posts', true );
    $roleAdministrator->add_cap( 'edit_others_posts', true );






    /**
     * 
     * SOU FORNECEDOR
     */

    /* $roleAdministrator->add_cap( 'delete_published_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_private_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_others_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_sou_fornecedor', true );
    $roleAdministrator->add_cap( 'delete_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'create_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'read_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_sou_fornecedor', true );
    $roleAdministrator->add_cap( 'edit_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'publish_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_published_sou_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_others_sou_fornecedors', true ); */






    /**
     * 
     * SEJA FORNECEDOR
     */

   /*  $roleAdministrator->add_cap( 'delete_published_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_private_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_others_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_seja_fornecedor', true );
    $roleAdministrator->add_cap( 'delete_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'create_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'read_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_seja_fornecedor', true );
    $roleAdministrator->add_cap( 'edit_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'publish_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_published_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_others_seja_fornecedors', true ); */




    /**
     * 
     * CONTATO
     */

    $roleAdministrator->add_cap( 'delete_published_contatos', true );
    $roleAdministrator->add_cap( 'delete_private_contatos', true );
    $roleAdministrator->add_cap( 'delete_others_contatos', true );
    $roleAdministrator->add_cap( 'delete_contato', true );
    $roleAdministrator->add_cap( 'delete_contatos', true );
    $roleAdministrator->add_cap( 'read_contatos', true );
    $roleAdministrator->add_cap( 'edit_contato', true );
    $roleAdministrator->add_cap( 'edit_contatos', true );
    $roleAdministrator->add_cap( 'publish_contatos', true );
    $roleAdministrator->add_cap( 'edit_published_contatos', true );
    $roleAdministrator->add_cap( 'edit_others_contatos', true );

    /**
     * 
     * SUGESTÕES E RECLAMAÇÕES
     */

    /* $roleAdministrator->add_cap( 'delete_published_suggestion_claims', true );
    $roleAdministrator->add_cap( 'delete_private_suggestion_claims', true );
    $roleAdministrator->add_cap( 'delete_others_suggestion_claims', true );
    $roleAdministrator->add_cap( 'delete_suggestion_claim', true );
    $roleAdministrator->add_cap( 'delete_suggestion_claims', true );
    $roleAdministrator->add_cap( 'read_suggestion_claims', true );
    $roleAdministrator->add_cap( 'edit_suggestion_claim', true );
    $roleAdministrator->add_cap( 'edit_suggestion_claims', true );
    $roleAdministrator->add_cap( 'publish_suggestion_claims', true );
    $roleAdministrator->add_cap( 'edit_published_suggestion_claims', true );
    $roleAdministrator->add_cap( 'edit_others_suggestion_claims', true ); */

    /**
     * 
     * FORM SEJA UM FORNECEDOR
     */

    /* $roleAdministrator->add_cap( 'delete_published_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_private_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_others_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'delete_form_seja_fornecedor', true );
    $roleAdministrator->add_cap( 'delete_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'read_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_form_seja_fornecedor', true );
    $roleAdministrator->add_cap( 'edit_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'publish_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_published_form_seja_fornecedors', true );
    $roleAdministrator->add_cap( 'edit_others_form_seja_fornecedors', true ); */







    $roleAdministrator->add_cap( 'delete_published_leads', true );
    $roleAdministrator->add_cap( 'delete_private_leads', true );
    $roleAdministrator->add_cap( 'delete_others_leads', true );
    $roleAdministrator->add_cap( 'delete_lead', true );
    $roleAdministrator->add_cap( 'delete_leads', true );
    $roleAdministrator->add_cap( 'read_leads', true );
    $roleAdministrator->add_cap( 'edit_lead', true );
    $roleAdministrator->add_cap( 'edit_leads', true );
    $roleAdministrator->add_cap( 'publish_leads', true );
    $roleAdministrator->add_cap( 'edit_published_leads', true );
    $roleAdministrator->add_cap( 'edit_others_leads', true );






    $roleAdministrator->add_cap( 'exportacao_contatos', true );
    $roleAdministrator->add_cap( 'manage_options', true );

    /**
     * 
     * EDITOR CAPABILITIES
     * 
     */

    $roleEditor = get_role( 'editor' );

    $roleEditor->add_cap( 'delete_published_posts', false );
    $roleEditor->add_cap( 'delete_private_posts', false );
    $roleEditor->add_cap( 'delete_others_posts', false );
    $roleEditor->add_cap( 'delete_post', false );
    $roleEditor->add_cap( 'delete_posts', false );
    $roleEditor->add_cap( 'create_posts', false );
    $roleEditor->add_cap( 'read_posts', false );
    $roleEditor->add_cap( 'edit_post', false );
    $roleEditor->add_cap( 'edit_posts', false );
    $roleEditor->add_cap( 'publish_posts', false );
    $roleEditor->add_cap( 'edit_published_posts', false );
    $roleEditor->add_cap( 'edit_others_posts', false );



    $roleEditor->add_cap( 'delete_published_sou_fornecedors', true );
    $roleEditor->add_cap( 'delete_private_sou_fornecedors', true );
    $roleEditor->add_cap( 'delete_others_sou_fornecedors', true );
    $roleEditor->add_cap( 'delete_sou_fornecedor', true );
    $roleEditor->add_cap( 'delete_sou_fornecedors', true );
    $roleEditor->add_cap( 'create_sou_fornecedors', true );
    $roleEditor->add_cap( 'read_sou_fornecedors', true );
    $roleEditor->add_cap( 'edit_sou_fornecedor', true );
    $roleEditor->add_cap( 'edit_sou_fornecedors', true );
    $roleEditor->add_cap( 'publish_sou_fornecedors', true );
    $roleEditor->add_cap( 'edit_published_sou_fornecedors', true );
    $roleEditor->add_cap( 'edit_others_sou_fornecedors', true );





    $roleEditor->add_cap( 'delete_published_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_private_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_others_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_seja_fornecedor', true );
    $roleEditor->add_cap( 'delete_seja_fornecedors', true );
    $roleEditor->add_cap( 'create_seja_fornecedors', true );
    $roleEditor->add_cap( 'read_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_seja_fornecedor', true );
    $roleEditor->add_cap( 'edit_seja_fornecedors', true );
    $roleEditor->add_cap( 'publish_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_published_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_others_seja_fornecedors', true );







    /**
     * 
     * CONTATO
     */
    $roleEditor->add_cap( 'delete_published_contatos', true );
    $roleEditor->add_cap( 'delete_private_contatos', true );
    $roleEditor->add_cap( 'delete_others_contatos', true );
    $roleEditor->add_cap( 'delete_contato', true );
    $roleEditor->add_cap( 'delete_contatos', true );
    $roleEditor->add_cap( 'read_contatos', true );
    $roleEditor->add_cap( 'edit_contato', true );
    $roleEditor->add_cap( 'edit_contatos', true );
    $roleEditor->add_cap( 'publish_contatos', true );
    $roleEditor->add_cap( 'edit_published_contatos', true );
    $roleEditor->add_cap( 'edit_others_contatos', true );



    /**
     * 
     * SUGESTÕES E RECLAMAÇÕES
     */
    /* $roleEditor->add_cap( 'delete_published_suggestion_claims', true );
    $roleEditor->add_cap( 'delete_private_suggestion_claims', true );
    $roleEditor->add_cap( 'delete_others_suggestion_claims', true );
    $roleEditor->add_cap( 'delete_suggestion_claim', true );
    $roleEditor->add_cap( 'delete_suggestion_claims', true );
    $roleEditor->add_cap( 'read_suggestion_claims', true );
    $roleEditor->add_cap( 'edit_suggestion_claim', true );
    $roleEditor->add_cap( 'edit_suggestion_claims', true );
    $roleEditor->add_cap( 'publish_suggestion_claims', true );
    $roleEditor->add_cap( 'edit_published_suggestion_claims', true );
    $roleEditor->add_cap( 'edit_others_suggestion_claims', true ); */


    /**
     * 
     * FORM SEJA UM FORNECODR
     */

   /*  $roleEditor->add_cap( 'delete_published_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_private_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_others_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'delete_form_seja_fornecedor', true );
    $roleEditor->add_cap( 'delete_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'read_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_form_seja_fornecedor', true );
    $roleEditor->add_cap( 'edit_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'publish_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_published_form_seja_fornecedors', true );
    $roleEditor->add_cap( 'edit_others_form_seja_fornecedors', true );
 */







    $roleEditor->add_cap( 'delete_published_leads', true );
    $roleEditor->add_cap( 'delete_private_leads', true );
    $roleEditor->add_cap( 'delete_others_leads', true );
    $roleEditor->add_cap( 'delete_lead', true );
    $roleEditor->add_cap( 'delete_leads', true );
    $roleEditor->add_cap( 'read_leads', true );
    $roleEditor->add_cap( 'edit_lead', true );
    $roleEditor->add_cap( 'edit_leads', true );
    $roleEditor->add_cap( 'publish_leads', true );
    $roleEditor->add_cap( 'edit_published_leads', true );
    $roleEditor->add_cap( 'edit_others_leads', true );

    $roleEditor->add_cap( 'exportacao_contatos', true );
    $roleEditor->add_cap( 'manage_options', false );

    $roleEditor->add_cap( 'list_users', true );
    $roleEditor->add_cap( 'remove_users', true );
    $roleEditor->add_cap( 'edit_users', true );
    $roleEditor->add_cap( 'add_users', true );
    $roleEditor->add_cap( 'create_users', true );
    $roleEditor->add_cap( 'delete_users', true );

    /**
     * 
     * PÁGINA PARA CONFIGURAR OS DESTINATÁRIOS DOS FORMS
     * 
     */

    if( function_exists('acf_add_options_page') ) {
	
        acf_add_options_page(array(
            'page_title' 	=> 'Notificações',
            'menu_title'	=> 'Notificações',
            'menu_slug' 	=> 'cs-notification-settings',
            'capability'	=> 'exportacao_contatos',
            'redirect'		=> false
        ));
    }
    


    /**
     * 
     * NOTÍCIA
     * 
     */

    // RETIRA SUPORTE DE "RESUMO" DA NOTÍCIA
    remove_post_type_support('post', 'excerpt');






     /**
     * 
     * SOU FORNECEDOR
     * 
     */

    /* $sou_fornecedor = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_sou_fornecedors',
            'delete_private_posts' => 'delete_private_sou_fornecedors',
            'delete_others_posts' => 'delete_others_sou_fornecedors',
            'delete_post' => 'delete_sou_fornecedor',
            'delete_posts' => 'delete_sou_fornecedors',
            'create_posts' => 'create_sou_fornecedors',
            'read_posts' => 'read_sou_fornecedors',
            'edit_post' => 'edit_sou_fornecedor',
            'edit_posts' => 'edit_sou_fornecedors',
            'publish_posts' => 'publish_sou_fornecedors',
            'edit_published_posts' => 'edit_published_sou_fornecedors',
            'edit_others_posts' => 'edit_others_sou_fornecedors'
        ],
        'labels' => [
            'name' => 'Sou Fornecedor',
            'name_admin_bar' => 'Sou Fornecedor',
            'singular_name' => 'Sou Fornecedor',
            // 'featured_image' => 'Imagem destacada',
            // 'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar novo bloco',
            'all_items' => 'Todos os blocos',
            'not_found' => 'Nenhum bloco encontrado',
        ],
        //'menu_icon' => 'dashicons-image-rotate-right',
        'menu_icon' => 'dashicons-buddicons-buddypress-logo',
        'description' => 'Sou Fornecedor do Site',

        //'public' => true,
        //'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'public' => true,
        'show_in_rest' => true,

        'supports' => [
            'title',
            //'excerpt',
            //'editor',
            //'thumbnail',
            //'custom-fields',
        ],
    ];

    register_post_type('sou_fornecedor', $sou_fornecedor); */








     /**
     * 
     * SEJA FORNECEDOR
     * 
     */

    /* $seja_fornecedor = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_seja_fornecedors',
            'delete_private_posts' => 'delete_private_seja_fornecedors',
            'delete_others_posts' => 'delete_others_seja_fornecedors',
            'delete_post' => 'delete_seja_fornecedor',
            'delete_posts' => 'delete_seja_fornecedors',
            'create_posts' => 'create_seja_fornecedors',
            'read_posts' => 'read_seja_fornecedors',
            'edit_post' => 'edit_seja_fornecedor',
            'edit_posts' => 'edit_seja_fornecedors',
            'publish_posts' => 'publish_seja_fornecedors',
            'edit_published_posts' => 'edit_published_seja_fornecedors',
            'edit_others_posts' => 'edit_others_seja_fornecedors'
        ],
        'labels' => [
            'name' => 'Seja Fornecedor',
            'name_admin_bar' => 'Seja Fornecedor',
            'singular_name' => 'Seja Fornecedor',
            // 'featured_image' => 'Imagem destacada',
            // 'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar novo documento',
            'all_items' => 'Todos os blocos',
            'not_found' => 'Nenhum bloco encontrado',
        ],
        //'menu_icon' => 'dashicons-image-rotate-right',
        'menu_icon' => 'dashicons-businessman',
        'description' => 'Seja um Fornecedor do Site',

        //'public' => true,
        //'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'public' => true,
        'show_in_rest' => true,

        'supports' => [
            'title',
            //'excerpt',
            //'editor',
            //'thumbnail',
            //'custom-fields',
        ],
    ];

    register_post_type('seja_fornecedor', $seja_fornecedor); */




    /**
     * 
     * CUSTOM POST TYPE: Contato
     * 
     */

    $contato = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_contatos',
            'delete_private_posts' => 'delete_private_contatos',
            'delete_others_posts' => 'delete_others_contatos',
            'delete_post' => 'delete_contato',
            'delete_posts' => 'delete_contatos',
            'create_posts' => false,//'create_contatos', // false,
            'read_posts' => 'read_contatos',
            'edit_post' => 'edit_contato',
            'edit_posts' => 'edit_contatos',
            'publish_posts' => 'publish_contatos', // false,
            'edit_published_posts' => 'edit_published_contatos',
            'edit_others_posts' => 'edit_others_contatos'
        ],
        'labels' => [
            'name' => 'Contato',
            'name_admin_bar' => 'Contato',
            'singular_name' => 'Contato',
            'featured_image' => 'Imagem destacada',
            'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar novo contato',
            'all_items' => 'Todas os Contato',
            'not_found' => 'Nenhum contato encontrado',
        ],
        //'menu_icon' => 'dashicons-buddicons-pm',
        'menu_icon' => 'dashicons-email-alt2',
        'description' => 'Inscritos através do formulário Contato',

        //'public' => true,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'supports' => [
            'title'
        ],
    ];

    register_post_type('contato', $contato);



    /**
     * 
     * CUSTOM POST TYPE: SUGESTÕES E RECLAMAÇÕES
     * 
     */

    /* $suggestion_claims = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_suggestion_claims',
            'delete_private_posts' => 'delete_private_suggestion_claims',
            'delete_others_posts' => 'delete_others_suggestion_claims',
            'delete_post' => 'delete_suggestion_claim',
            'delete_posts' => 'delete_suggestion_claims',
            'create_posts' => false,//'create_suggestion_claims', // false,
            'read_posts' => 'read_suggestion_claims',
            'edit_post' => 'edit_suggestion_claim',
            'edit_posts' => 'edit_suggestion_claims',
            'publish_posts' => 'publish_suggestion_claims', // false,
            'edit_published_posts' => 'edit_published_suggestion_claims',
            'edit_others_posts' => 'edit_others_suggestion_claims'
        ],
        'labels' => [
            'name' => 'Sugestões e Reclamações',
            'name_admin_bar' => 'Sugestões e Reclamações',
            'singular_name' => 'Sugestões e Reclamações',
            'featured_image' => 'Imagem destacada',
            'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar nova sugestão ou reclamação',
            'all_items' => 'Todas as sugestões e reclamações',
            'not_found' => 'Nenhuma sugestão ou reclamação encontrada',
        ],
        //'menu_icon' => 'dashicons-buddicons-pm',
        'menu_icon' => 'dashicons-email-alt2',
        'description' => 'Inscritos através do formulário Sugestões e Reclamações',

        //'public' => true,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'supports' => [
            'title'
        ],
    ];

    register_post_type('suggestion_claims', $suggestion_claims); */



    /**
     * 
     * CUSTOM POST TYPE: FORM SEJA UM FORNECEDOR
     * 
     */

    /* $form_seja_fornecedor = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_form_seja_fornecedors',
            'delete_private_posts' => 'delete_private_form_seja_fornecedors',
            'delete_others_posts' => 'delete_others_form_seja_fornecedors',
            'delete_post' => 'delete_form_seja_fornecedor',
            'delete_posts' => 'delete_form_seja_fornecedors',
            'create_posts' => false,//'create_form_seja_fornecedors', // false,
            'read_posts' => 'read_form_seja_fornecedors',
            'edit_post' => 'edit_form_seja_fornecedor',
            'edit_posts' => 'edit_form_seja_fornecedors',
            'publish_posts' => 'publish_form_seja_fornecedors', // false,
            'edit_published_posts' => 'edit_published_form_seja_fornecedors',
            'edit_others_posts' => 'edit_others_form_seja_fornecedors'
        ],
        'labels' => [
            'name' => 'Formulário Seja Fornecedor',
            'name_admin_bar' => 'Formulário Seja Fornecedor',
            'singular_name' => 'Formulário Seja Fornecedor',
            'featured_image' => 'Imagem destacada',
            'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar novo fornecedor',
            'all_items' => 'Todas os fornecedor',
            'not_found' => 'Nenhum fornecedor encontrada',
        ],
        //'menu_icon' => 'dashicons-buddicons-pm',
        'menu_icon' => 'dashicons-email-alt2',
        'description' => 'Inscritos através do formulário Seja um Fornecedor',

        //'public' => true,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'supports' => [
            'title'
        ],
    ];

    register_post_type('form_seja_fornecedor', $form_seja_fornecedor); */



    /**
     * 
     * CUSTOM POST TYPE: LEADS DO FORM BAIXAR APRESENTAÇÃO
     * 
     */

    $leads = [
        'capabilities' => [
            'delete_published_posts' => 'delete_published_leads',
            'delete_private_posts' => 'delete_private_leads',
            'delete_others_posts' => 'delete_others_leads',
            'delete_post' => 'delete_lead',
            'delete_posts' => 'delete_leads',
            'create_posts' => false,//'create_leads', // false
            'read_posts' => 'read_leads',
            'edit_post' => 'edit_lead',
            'edit_posts' => 'edit_leads',
            'publish_posts' => 'publish_leads', // false
            'edit_published_posts' => 'edit_published_leads',
            'edit_others_posts' => 'edit_others_leads'
        ],
        'labels' => [
            'name' => 'Seja um parceiro',
            'name_admin_bar' => 'Seja um parceiro',
            'singular_name' => 'Lead',
            'featured_image' => 'Imagem destacada',
            'set_featured_image' => 'Definir imagem destacada',
            'add_new_item' => 'Adicionar novo lead',
            'all_items' => 'Todos os leads',
            'not_found' => 'Nenhum lead encontrado',
        ],
        //'menu_icon' => 'dashicons-buddicons-pm',
        'menu_icon' => 'dashicons-email-alt2',
        'description' => 'Inscritos através do formulário BAIXAR APRESENTAÇÃO',

        //'public' => true,
        'public' => false,  // it's not public, it shouldn't have it's own permalink, and so on
        'publicly_queryable' => false,  // you should be able to query it
        'show_ui' => true,  // you should be able to edit it in wp-admin
        'exclude_from_search' => true,  // you should exclude it from search results
        'show_in_nav_menus' => false,  // you shouldn't be able to add it to menus
        'has_archive' => false,  // it shouldn't have archive page
        'rewrite' => false,  // it shouldn't have rewrite rules

        'supports' => [
            'title'
        ],
    ];

    register_post_type('lead', $leads);

    /*  */

    // Access global variables.
    global $wp_post_types;





    /**
     * SOU FORNECEDOR
     */

   /*  $labels_sou_fornecedors = &$wp_post_types['fornecedor']->labels;
    $labels_sou_fornecedors->name = 'Fornecedor';
    $labels_sou_fornecedors->singular_name = 'Fornecedor';
    $labels_sou_fornecedors->add_new = 'Novo fornecedor';
    $labels_sou_fornecedors->add_new_item = 'Novo fornecedor';
    $labels_sou_fornecedors->edit_item = 'Alterar fornecedor';
    $labels_sou_fornecedors->new_item = 'Fornecedor';
    $labels_sou_fornecedors->view_item = 'Ver fornecedor';
    $labels_sou_fornecedors->search_items = 'Buscar fornecedor';
    $labels_sou_fornecedors->not_found = 'Nenhum fornecedor encontrado';
    $labels_sou_fornecedors->not_found_in_trash = 'Nenhum fornecedor encontrado'; */





    /**
     * SEJA FORNECEDOR
     */

    /* $labels_seja_fornecedors = &$wp_post_types['fornecedor']->labels;
    $labels_seja_fornecedors->name = 'Fornecedor';
    $labels_seja_fornecedors->singular_name = 'Fornecedor';
    $labels_seja_fornecedors->add_new = 'Novo fornecedor';
    $labels_seja_fornecedors->add_new_item = 'Novo fornecedor';
    $labels_seja_fornecedors->edit_item = 'Alterar fornecedor';
    $labels_seja_fornecedors->new_item = 'Fornecedor';
    $labels_seja_fornecedors->view_item = 'Ver fornecedor';
    $labels_seja_fornecedors->search_items = 'Buscar fornecedor';
    $labels_seja_fornecedors->not_found = 'Nenhum fornecedor encontrado';
    $labels_seja_fornecedors->not_found_in_trash = 'Nenhum fornecedor encontrado'; */
}

/**
 * 
 * ?
 * 
 */

/* function update_projeto_slug( $args, $post_type ) {

    if ( 'projeto' === $post_type ) {

        //$args['rewrite']['slug'] = 'presidentes';

        $my_args = array(
            'rewrite' => array( 'slug' => 'projeto', 'with_front' => false )
        );

        return array_merge( $args, $my_args );
    }

    return $args;
}

add_filter( 'register_post_type_args', 'update_projeto_slug', 10, 2 ); */