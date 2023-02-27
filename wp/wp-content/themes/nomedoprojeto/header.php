<?php 
    // https://realfavicongenerator.net/ (o que eu uso é esse)
    // https://www.favicon-generator.org/
    global $wp;

    $vers = getVers(); 
                                
    $sitename = trim( esc_html( get_bloginfo("name") ) );
    $pagetitle = trim( esc_html( wp_title('', false) ) );
    $metadata['titulo'] = !is_front_page() ? $pagetitle . " | {$sitename}" : $sitename;
    $metadata['descricao'] = trim( esc_html( get_bloginfo('description') ) );
    $metadata['og:url'] = home_url($wp->request);

    $metadata['og:image'] = getBase('facebook.png', 2);
    $metadata['og:image:width'] = 500;
    $metadata['og:image:height'] = 500;
    $metadata['og:image:alt'] = $metadata['titulo'];
?>
<!doctype html>
<html>
<!--[if IE 7 ]>    <html lang="pt-BR" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="pt-BR" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="pt-BR" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="pt-BR" class="no-js"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
    <!-- TITLE -->
    <title><?php echo $metadata['titulo']; ?></title>
	<meta name="description" content="<?php echo $metadata['descricao']; ?>"/>

     <!-- META DATA -->
     <link rel="apple-touch-icon" sizes="180x180" href="<?php echo getBase('apple-touch-icon.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo getBase('favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo getBase('favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo getBase('site.webmanifest'); ?>">
    <link rel="mask-icon" href="<?php echo getBase('safari-pinned-tab.svg" color="#5bbad5'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">

    <!-- META DADOS FACEBOOK -->
    <meta property="fb:app_id" content="499686294964234" />
	<meta property="og:url" content="<?php echo $metadata['og:url']; ?>/"/>
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="<?php echo $metadata['titulo']; ?>"/>
	<meta property="og:description" content="<?php echo $metadata['descricao']; ?>"/>
	<meta property="og:image" content="<?php echo $metadata['og:image']; ?>"/>
	<meta property="og:image:alt" content="<?php echo $metadata['og:image:alt']; ?>"/>
	<meta property="og:image:width" content="<?php echo $metadata['og:image:width']; ?>"/>
	<meta property="og:image:height" content="<?php echo $metadata['og:image:height']; ?>"/>

     <!-- META DADOS TWITTER -->
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:title" content="<?php echo $metadata['titulo']; ?>"/>
	<meta name="twitter:description" content="<?php echo $metadata['descricao']; ?>"/>
    
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- **Favicon** -->
    <!-- <link href="<?php /* echo getBase('favicon.ico'); */ ?>" rel="shortcut icon" type="image/x-icon" /> -->
    
    <!-- Style.css -->
    <link id="default-css" href="<?php echo getTheme('style.css', $vers); ?>" rel="stylesheet" media="all" />
 
</head>

<body>
	<header>
		<h1>Header</h1>
	</header>