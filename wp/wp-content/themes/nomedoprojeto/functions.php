<?php
flush_rewrite_rules();

//HELPERS
require_once('inc/inc.utils.php');
require_once('inc/inc.validate.php');

// // ENABLE FEATURED IMAGE SUPPORT
add_theme_support( 'post-thumbnails', ['post'] );

// // DEFINE THUMBNAIL SIZES
require_once('inc/inc.admin-images.php');

// // WP_QUERY SIZE
require_once('inc/inc.search.php');

// // DISABLE AUTO SAVE FROM CUSTOM POST TYPE
require_once('inc/inc.admin-disable-autosave.php');

// // TINY MCE
require_once('inc/inc.tinymce.php');

// // MENU ORDER
require_once('inc/inc.admin-menu.php');

// // CPT -> LISTAGEM
require_once('inc/inc.admin-cpt-actions.php');
require_once('inc/inc.admin-cpt-columns.php');

// // CATEGORIA E ASSUNTOS -> LISTAGEM
require_once('inc/inc.admin-terms-actions.php');
require_once('inc/inc.admin-terms-columns.php');

// // PERSONALIZAÇÃO DOS ESTILOS E RECURSOS ADMINISTRATIVOS
require_once('inc/inc.admin-cpt-features.php');
require_once('inc/inc.admin-metaboxes.php');

// // PERSONALIZAÇÃO DA BIBLIOTECA DE MÍDIA
require_once('inc/inc.admin-media.php');

// // Atualiza TÍTULOS ao salvar campo correspondente do ACF
require_once('inc/inc.admin-cpt-titles.php');

// // Features de NOTÍCIA -> RETIRA POST EM EDIÇÃO, INCLUSÃO DA LISTA DE POSTS RELACIONADOS e DEFINE OPÇÕES PADRÃO DO SCREEN OPTIONS
require_once('inc/inc.admin-cpt-post.php');

// // START CPT's
require_once('inc/inc.admin-cpts.php');
require_once('inc/inc.admin-cpt-unidade.php');

// // [FRONT-END] STYLING PREV NEXT PAGINATE BUTTONS
// require_once('inc/inc.front-post.php');

// // OTIMIZA O BOTÃO DE "ADICIONAR MÍDIA"
require_once('inc/inc.admin-media-button.php');

// // FEATURES DE EDITOR
require_once('inc/inc.admin-cpt-user.php');
require_once('inc/inc.admin-user-columns.php');

// // DISABLE WORDPRESS UPDATES AND NOTIFICATIONS
require_once('inc/inc.admin-disable-updates.php');






// /**
//  * Configuração das Notificações de E-mail
//  */
// $destinatarios = [
//     'contato' => 'backup.fernando.firmino@gmail.com',
// ]; // Fallback

// $formContato = get_option('contato');

// if ($formContato) {
//     $tempEmails = esc_attr( $formContato );
//     $tempEmails = textareaToEmails($tempEmails);
//     if (count($tempEmails) > 0) {
//         $destinatarios['contato'] = $tempEmails;
//     }
// }

/**
 * 
 * FORMULÁRIOS
 * 
 */
require_once('inc/inc.admin-form-contato.php');