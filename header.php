<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="it-IT" >

<head>

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php if ( function_exists('optimal_title') ) { ?><?php optimal_title(); ?><?php bloginfo('name'); ?><?php } else { ?><?php bloginfo('name'); ?> <?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?> <?php wp_title(); ?><?php } ?></title>

<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/print.css" type="text/css" media="print" />

<!-- <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script> -->

<link rel="shortcut icon" type="image/ico" href="<?php bloginfo('template_url'); ?>/favicon.ico" />

<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<?php wp_head(); ?>

<?php

$descrizione=get_post_meta($post->ID, 'DC.Description', true);

if ($descrizione) { ?>

                                <!-- Inizio requisiti Linee Guida Direttiva 8/2009 -->

                                <link rel="schema.DC" href="http://purl.org/dc/elements/1.1/" />

                                <link rel="schema.DCTERMS" href="http://purl.org/dc/terms/" />

                                <meta name="DC.Description" content="<?php echo $descrizione ?>"  />

                                <!-- Fine requisiti Linee Guida Direttiva 8/2009 -->

<?php } ?>

</head>

<body class="custom-background">

<div id="wrapper" <?php if (get_option('pasw_fluid_layout') == '0') { echo 'style="max-width: 1150px;"'; } ?>>

<div class="nascosto">

<strong> Navigazione veloce </strong>

<ul>

<li><a href="#centrecontent">vai al contenuto</a></li>

<li><a href="#leftsidebar">vai alla navigazione principale</a></li>

<li><a href="#rightsidebar">vai alla navigazione contestuale</a></li>

</ul>

</div>

<div id="header" style="background: url(<?php header_image(); ?>);color:#<?php header_textcolor(); ?>;"">


<?php wp_nav_menu( array( 'menu' => '', 'container' => 'ul', 'menu_class' => 'sito', 'theme_location' => 'menu-1' ) ); ?>
<div class="clear"></div>
<?php
if (get_option('Pasw_Logo_img') != ''){

	if(file_exists(TEMPLATEPATH.'/images/'.basename(get_option('Pasw_Logo_img')))){ 

			$image_info = getimagesize(TEMPLATEPATH.'/images/'.basename(get_option('Pasw_Logo_img')));

		$scala = 65/$image_info[1];

		$width = $image_info[0] * $scala;

		$height = $image_info[1] * $scala;

	}else{

	$width = 0;

	$height = 0;

	}

}	

?>

<div class="contatti">
<?php
	$site_url = get_site_url();
	if (get_option('pasw_email_scuola') != '') {
		echo get_option('pasw_email_scuola') . ' <img src="' . $site_url . '/wp-content/themes/pasw2015beta/icone/c-email.png' . '"/><br/>';
	}
	if (get_option('pasw_indirizzo_scuola') != '') {
		echo get_option('pasw_indirizzo_scuola') . ' <img src="' . $site_url . '/wp-content/themes/pasw2015beta/icone/c-indirizzo.png' . '"/><br/>';
	}
	if (get_option('pasw_recapito_scuola') != '') {
		echo get_option('pasw_recapito_scuola') . ' <img src="' . $site_url . '/wp-content/themes/pasw2015beta/icone/c-telefono.png' . '"/><br/>';
	}
?>
</div>

<a href="<?php bloginfo('url'); ?>"><img src="<?php echo get_bloginfo("template_url").'/images/'.basename(get_option('Pasw_Logo_img')); ?>" alt="<?php echo get_option('Pasw_Logo_alt'); ?>" class="logo" width="<?php echo $width; ?>" height="<?php echo $height; ?>" /></a>

<h1 style="color:#<?php header_textcolor(); ?>;"><?php bloginfo('name'); ?></h1><?php // echo stripslashes(get_option('Pasw_Testa')); ?>
<?php echo stripslashes(get_bloginfo('description')); ?>

</div>

<div id="topbar">

		<form name="Motore di ricerca interno" style="float:right;padding: 1px;" method="get" id="searchform" action='<?php echo bloginfo('url');?>' >
			<div><label class="screen-reader-text" for="s">Cerca:</label>
				<input type="text" value="" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Cerca" />
			</div>
		</form>

<?php

if(function_exists('wp_nav_menu')) {

wp_nav_menu( array( 'menu' => '', 'container' => '', 'menu_class' => '', 'theme_location' => 'menu-2' ) );

}

else

{

wp_list_pages('depth=1&title_li=');

}

?>

<ul>

<li>

<?php wp_loginout(); ?>

</li>

</ul>

</div>

<div id="container">