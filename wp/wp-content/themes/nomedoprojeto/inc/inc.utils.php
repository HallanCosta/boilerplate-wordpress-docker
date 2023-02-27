<?php

// GLOBAL VARS
$is_local = $_SERVER['HTTP_HOST'] == 'your-domain.test';
$is_staging = $_SERVER['HTTP_HOST'] == 'your-domain.agencianeolan.com.br';
$is_production = $_SERVER['HTTP_HOST'] == 'your-domain.com.br' || $_SERVER['HTTP_HOST'] == 'www.your-domain.com.br';


// CSS/JS update
function getVers()
{
    global $is_local;

    return $is_local ? date('Y-m-d_H-i-s') : '19';
}


  
/**
 * return current system operation
 */
function is_windows_os() {
    return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';
}

function debugUpload($log_msg)
{
    $log_time = date('Y-m-d h:i:sa');

    $wp_upload_dir = wp_upload_dir(); 

    // Cria o diretório se estiver no windows ou linux
    if(is_windows_os()) $debug_directory = $wp_upload_dir['basedir'] . '/debug\/';
    if(!is_windows_os()) $debug_directory = $wp_upload_dir['basedir'] . '/debug/';

    if (!is_dir($debug_directory)) mkdir($debug_directory, 0777, true);
    
    $log_file_data = $debug_directory.'/log_' . formatDateTime('now', 'Y-m-d_H-i-s') . '.log';
    file_put_contents($log_file_data, $log_msg . "\n", FILE_APPEND);
}

// Environment
function getWPEnvironment()
{
    global $is_local, $is_staging, $is_production;

    $env = 'unknown';

    if ($is_local) {
        $env = 'development';
    } else if ($is_staging) {
        $env = 'staging';
    } else if ($is_production) {
        $env = 'production';
    }

    return $env;
}










/**
 * 
 * get_wp_rwmb_image -> Pega as imagens do backend, que está no RWMB Meta Boxes
 * 
 */
function get_rwmb_image_advanced($props = [
    'field_id' => '',
    'size'     => '',
    'post_id'  => '',
]) {
    extract($props, EXTR_OVERWRITE, "wddx");

    $images = array();
    $all_images = rwmb_meta( $field_id, [ 'sizes' => $size ], $post_id );
    
    foreach($all_images as $image_sizes) {
        $image = $image_sizes['sizes'][$size]['url'];
        $images[] = is_null($image) ? $image_sizes['full_url'] : $image;
    }

    return $images;
}

function get_rwmb_file_advanced($props = [
    'field_id' => '',
    'post_id' => '',
]) {
    extract($props, EXTR_OVERWRITE, "wddx");

    $filename = array();
    $documents = rwmb_meta( $field_id, array(), $post_id );

    foreach ($documents as $document) {
        $filename[] = array(
            'title' => $document['title'],
            'url'   => $document['url']
        );
    }

    return $filename;
}

/**
 * 
 * My Custom Debugger -> wp_die()
 * 
 */
function wp_debugger($debug) {
    wp_die('<textarea style="font-size: 20px; height: 323px; width: 697px;">'.var_export($debug, true).'</textarea>');
}

function get_featured_image($pid, $pic = 'full')
{
    $out = wp_get_attachment_image_src(get_post_thumbnail_id($pid), $pic);

    return [
        'url' => trim( esc_url($out[0]) ),
        'width' => (int)$out[1],
        'height' => (int)$out[2]
    ];
}






function cleanNumbers($string)
{
    return preg_replace('/[^0-9]/', '', $string);
}

// FORMAT HTML

function formatEmail($content)
{
    $creditos = '';/* <<<HEREDOC
<br>
<br>
Estamos nas redes sociais.
<br>
<a href="https://www.facebook.com/rpfsociedadedeadv/" style="color: #545353;">Facebook</a> | <a href="https://www.instagram.com/rpfadvocacia/?hl=pt-br" style="color: #545353;">Instagram</a>
<br>
<br>
your-domain
HEREDOC; */

	$tratar = <<<HEREDOC
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
<!--[if gte mso 9]><xml>
<o:OfficeDocumentSettings>
<o:AllowPNG/>
<o:PixelsPerInch>96</o:PixelsPerInch>
</o:OfficeDocumentSettings>
</xml><![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="format-detection" content="date=no">
<meta name="format-detection" content="telephone=no">
<title>your-domain</title>
<style>body{margin:0;padding:0;-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}table{border-spacing:0;mso-table-lspace:0;mso-table-rspace:0}table td{border-collapse:collapse}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}.ReadMsgBody{width:100%;background-color:#ebebeb}img{-ms-interpolation-mode:bicubic}.yshortcuts a{border-bottom:none!important}@media screen and (max-width:599px){.container,.force-row{width:100%!important;max-width:100%!important}}@media screen and (max-width:400px){.container-padding{padding-left:12px!important;padding-right:12px!important}}.ios-footer a{color:#aaa!important;text-decoration:underline}a[href^="x-apple-data-detectors:"],a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.invoice{padding:10px;text-align:left;width:100%}.invoice th{padding:5px 10px 5px 0}.invoice .invoice-items td{font-size:12px;padding:5px 10px 5px 5px;border-top:#eee 1px solid}.invoice .total td{padding:5px 0 5px 5px;border-top:2px solid #333;border-bottom:2px solid #333;font-weight:700}</style>
</head>
<body style="margin:0; padding:0;" bgcolor="#eeeeee" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#eeeeee">
<tr>
<td align="center" valign="top" bgcolor="#eeeeee" style="background-color: #eeeeee;">
<br>
<table border="0" cellpadding="0" cellspacing="0" class="container" style="width: 90%;">
{$content}
{$creditos}
<br>
<br>
</div>
</td>
</tr>
</table>
</body>
</html>
HEREDOC;

    return str_replace(["\n", "\r"], '', $tratar);
}


// Content Type para e-mails

function wpdocs_set_html_mail_content_type($content_type)
{
    return 'text/html';
}

function textareaToEmails($a)
{
    $emails = [];

    $mtemp = array_map('trim', explode("\n", $a));

    foreach ($mtemp as $uemail)
    {
        if ( filter_var($uemail, FILTER_VALIDATE_EMAIL) ) $emails[] = $uemail;
    }

    return $emails;
}

function gpt($post_id)
{
    //get_the_permalink
    return '<a href="' . get_edit_post_link($post_id) . '" target="_blank">' . esc_html( get_the_title($post_id) ) . '</a>';
}

function getPodsField( $pod, $post_ID, $field_NAME )
{
    $pods = pods( $pod, $post_ID );
    return is_null($pods) ? '' : $pods->field( "{$field_NAME}" );
}

function categoriaProjetos($categoriaID)
{
    // https://wordpress.stackexchange.com/questions/213369/display-list-of-posts-containing-a-relationship-field-value-acf
    $projetos_na_categoria = (new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'projeto',
        'meta_query' => [
            [
                'key' => 'tipo',
                'value' => $categoriaID,
                'compare' => '='
            ],
        ]
    ]))->found_posts;
    wp_reset_postdata();

    return $projetos_na_categoria;
}

function categoriaHasProjetos($categoriaID)
{
    $projetos = categoriaProjetos($categoriaID);

    return ($projetos > 0);
}

function categoriaFeaturedProjects($categoriaID)
{
    // https://wordpress.stackexchange.com/questions/213369/display-list-of-posts-containing-a-relationship-field-value-acf
    $projetos_na_categoria = (new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'projeto',
        'meta_query' => [
            [
                'relation' => 'AND',
                [
                    'key' => 'tipo',
                    'value' => $categoriaID,
                    'compare' => '='
                ],
                [
                    'key' => 'destaque',
                    'value' => "1",
                    'compare' => '='
                ],
            ],
        ]
    ]))->found_posts;
    wp_reset_postdata();

    return $projetos_na_categoria;
}

function categoriaHasFeaturedProjects($categoriaID)
{
    $projetos = categoriaFeaturedProjects($categoriaID);

    return ($projetos > 0);
}

function anyCategoryHasProjects() {
    $categories = (new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'categoria'
    ]));

    $categoriesCount = $categories->found_posts;

    $hasCategories = $categoriesCount > 0;

    $anyCategoryHasProjects = false;

    while ( $categories->have_posts() )
    {
        $categories->the_post();

        $id = get_the_id();

        if (categoriaHasProjetos($id)) {
            $anyCategoryHasProjects = true;
        }
    }

    wp_reset_postdata();

    return $anyCategoryHasProjects;
}



/* function estadoUnidades($unidade_id)
{
    $unidades_no_estado = (new WP_Query(['posts_per_page' => -1, 'post_type' => 'unidade', 'meta_key' => 'estado_unidades', 'meta_value' => $unidade_id]))->found_posts;
    wp_reset_postdata();

    return $unidades_no_estado;
} */




function cidadeUnidades($cidade_id)
{
    // https://wordpress.stackexchange.com/questions/213369/display-list-of-posts-containing-a-relationship-field-value-acf
    $unidadesNaCidade = (new WP_Query([
        'posts_per_page' => -1,
        'post_type' => 'unidade',
        'meta_query' => [
            [
                'key' => 'cidade', // name of custom field
                'value' => '"' . $cidade_id . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
                'compare' => 'LIKE'
            ],
        ]
    ]))->found_posts;
    wp_reset_postdata();

    return $unidadesNaCidade;
}

function cidadeHasUnidades($estadoId)
{
    $cidades = cidadeUnidades($estadoId);

    return ($cidades > 0);
}




/* function cidadeHasUnidades($unidade_id)
{
    $unidades_no_cidade = (new WP_Query(['posts_per_page' => 1, 'post_type' => 'unidade', 'meta_key' => 'cidade_unidades', 'meta_value' => $unidade_id]))->found_posts;
    wp_reset_postdata();

    return ($unidades_no_cidade > 0);
}

function cidadeUnidades($unidade_id)
{
    $unidades_no_cidade = (new WP_Query(['posts_per_page' => -1, 'post_type' => 'unidade', 'meta_key' => 'cidade_unidades', 'meta_value' => $unidade_id]))->found_posts;
    wp_reset_postdata();

    return $unidades_no_cidade;
} */






function getApiKey($type) {
    // 'AIzaSyCh8InW-okCvi4CaJ38RDD-kJ_KtHUf_c4' // colucciimoveis.com/contato
    $chave['your-domain.test']['googlemaps'] = 'AIzaSyDykdWY3kHg04wtbdcIZsZUHYCKMOrFgLo';
    $chave['your-domain.your-domain.com.br']['googlemaps'] = 'AIzaSyDykdWY3kHg04wtbdcIZsZUHYCKMOrFgLo';
    $chave['your-domain.com.br']['googlemaps'] = 'AIzaSyDykdWY3kHg04wtbdcIZsZUHYCKMOrFgLo';
    $chave['www.your-domain.com.br']['googlemaps'] = 'AIzaSyDykdWY3kHg04wtbdcIZsZUHYCKMOrFgLo';

    return $chave["{$_SERVER['HTTP_HOST']}"]["{$type}"];
}




function is_user_in_role( $user_id, $role  )
{
    $user = get_userdata( $user_id );
    $get_user_roles_by_user_id = empty( $user ) ? array() : $user->roles;

    return in_array( $role, $get_user_roles_by_user_id );
}










function getBlogIcon($type)
{
    $icon = [
        'author' => getAsset('imagens/paginas/home/blog/icon-autor.png', 1),
        'views' => getAsset('imagens/paginas/home/blog/icon-visualizacoes.png', 1),
        'categories' => getAsset('imagens/paginas/home/blog/icon-categorias.png', 1),
    ];

    return $icon["{$type}"];
}

function translateUfToEstado($uf)
{
    $saida = [
        "AC" => "Acre",
        "ac" => "Acre",
        "AL" => "Alagoas",
        "al" => "Alagoas",
        "AP" => "Amapá",
        "ap" => "Amapá",
        "AM" => "Amazonas",
        "am" => "Amazonas",
        "BA" => "Bahia",
        "ba" => "Bahia",
        "CE" => "Ceará",
        "ce" => "Ceará",
        "DF" => "Distrito Federal",
        "df" => "Distrito Federal",
        "ES" => "Espírito Santo",
        "es" => "Espírito Santo",
        "GO" => "Goiás",
        "go" => "Goiás",
        "MA" => "Maranhão",
        "ma" => "Maranhão",
        "MT" => "Mato Grosso",
        "mt" => "Mato Grosso",
        "MS" => "Mato Grosso do Sul",
        "ms" => "Mato Grosso do Sul",
        "MG" => "Minas Gerais",
        "mg" => "Minas Gerais",
        "PA" => "Pará",
        "pa" => "Pará",
        "PB" => "Paraíba",
        "pb" => "Paraíba",
        "PR" => "Paraná",
        "pr" => "Paraná",
        "PE" => "Pernambuco",
        "pe" => "Pernambuco",
        "PI" => "Piauí",
        "pi" => "Piauí",
        "RJ" => "Rio de Janeiro",
        "rj" => "Rio de Janeiro",
        "RN" => "Rio Grande do Norte",
        "rn" => "Rio Grande do Norte",
        "RS" => "Rio Grande do Sul",
        "rs" => "Rio Grande do Sul",
        "RO" => "Rondônia",
        "ro" => "Rondônia",
        "RR" => "Roraima",
        "rr" => "Roraima",
        "SC" => "Santa Catarina",
        "sc" => "Santa Catarina",
        "SP" => "São Paulo",
        "sp" => "São Paulo",
        "SE" => "Sergipe",
        "se" => "Sergipe",
        "TO" => "Tocantins",
        "to" => "Tocantins",
    ];

    return isset($saida["{$uf}"]) ? $saida["{$uf}"] : $uf;
}

function translateEstadoToUF($estado)
{
    $saida = [
        "Acre" => "AC",
        "Alagoas" => "AL",
        "Amapá" => "AP",
        "Amazonas" => "AM",
        "Bahia" => "BA",
        "Ceará" => "CE",
        "Distrito Federal" => "DF",
        "Espírito Santo" => "ES",
        "Goiás" => "GO",
        "Maranhão" => "MA",
        "Mato Grosso" => "MT",
        "Mato Grosso do Sul" => "MS",
        "Minas Gerais" => "MG",
        "Pará" => "PA",
        "Paraíba" => "PB",
        "Paraná" => "PR",
        "Pernambuco" => "PE",
        "Piauí" => "PI",
        "Rio de Janeiro" => "RJ",
        "Rio Grande do Norte" => "RN",
        "Rio Grande do Sul" => "RS",
        "Rondônia" => "RO",
        "Roraima" => "RR",
        "Santa Catarina" => "SC",
        "São Paulo" => "SP",
        "Sergipe" => "SE",
        "Tocantins" => "TO",
    ];

    return isset($saida["{$estado}"]) ? $saida["{$estado}"] : $estado;
}



function generateRandomString($length = 10) {
    $characters = 'abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}



function tokenTruncate($string, $your_desired_width) {
    $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
    $parts_count = count($parts);

    $length = 0;
    $last_part = 0;
    for (; $last_part < $parts_count; ++$last_part) {
        $length += strlen($parts[$last_part]);
        if ($length > $your_desired_width) { break; }
    }

    return implode(array_slice($parts, 0, $last_part));
}



//https://stackoverflow.com/questions/3835636/php-replace-last-occurrence-of-a-string-in-a-string
function str_lreplace($search, $replace, $subject)
{
    return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
}

//http://www.danielmayor.com/php-how-to-replace-just-the-last-match-of-a-string
function lreplace($search, $replace, $subject){
    $pos = strrpos($subject, $search);
    if($pos !== false){
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

//https://www.designcise.com/web/tutorial/how-to-replace-only-the-first-occurance-of-a-string-in-php
function freplace($search, $replace, $subject){
    return preg_replace('/' . $search . '/', $replace, $subject, 1);
}



function getEndereco($slug)
{
    $base_url = home_url();
    $a = $slug . (($slug !== '') ? '/' : '');
    return "{$base_url}/{$a}";
}

function getEnderecoHash($hash)
{
    $base_url = home_url();
    return "{$base_url}/#{$hash}";
}

function getBase($file, $vers = '')
{
    $base_url = home_url();
    $vers = ($vers != "") ? "?{$vers}" : "";
    return "{$base_url}/{$file}{$vers}";
}

function getAsset($file, $vers = '')
{
    $base_url = home_url();
    $vers = ($vers != "") ? "?{$vers}" : "";
    return "{$base_url}/wp-content/themes/your-domain/assets/{$file}{$vers}";
}

function getTheme($file, $vers = '')
{
    $base_url = home_url();
    $vers = ($vers != "") ? "?{$vers}" : "";
    return "{$base_url}/wp-content/themes/your-domain/{$file}{$vers}";
}

function saveFile($file, $debug)
{
    return @file_put_contents(ABSPATH . "log/{$file}.json", json_encode([
        'timestamp' => formatDateTime('now', 'd/m/Y H:i:s'),
        'debug' => var_export($debug, true)
    ]) . PHP_EOL, FILE_APPEND);
}

/* 
define("LOGPATH",  __DIR__ . '/log');

function saveFile($action, $debug)
{
    return @file_put_contents(LOGPATH . "/{$action}.json", json_encode([
        'timestamp' => formatDateTime('now', 'd/m/Y H:i:s'),
        'debug' => json_encode($debug)
    ]) . PHP_EOL, FILE_APPEND);
}
 */
function formatDateTime($timestamp, $format)
{
    $timezone = new DateTimeZone(-3);
    return (new DateTime($timestamp))->setTimezone($timezone)->format("{$format}");
}

function getPostPicture($pid, $pic = 'full')
{
    $out = wp_get_attachment_image_src(get_post_thumbnail_id($pid), $pic);

    return [
        'url' => trim( esc_url($out[0]) ),
        'width' => (int)$out[1],
        'height' => (int)$out[2]
    ];
}







/* function getIconAsset($type = '')
{
    $icon = [
        'author' => getAsset('imagens/home/blog/icon-autor.png'),
        'views' => getAsset('imagens/home/blog/icon-visualizacoes.png'),
        'categories' => getAsset('imagens/home/blog/icon-categorias.png'),
    ];

    return $icon["{$type}"];
} */










/**
 * 
 * CONTADOR DE VISITAS (POSTS POPULARES)
 * 
 */

function wpb_set_post_views($meta, $id)
{
    $increment = get_post_meta($id, $meta, true);

    $increment++;
    update_post_meta($id, $meta, $increment);

    return $increment;
}

function wpb_get_post_views($meta, $postID)
{
    $count = (int)get_post_meta($postID, $meta, true);

    return $count;
}