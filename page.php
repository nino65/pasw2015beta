<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">
<!-- breadcrumbs -->
<div id="path">
<?php
if(function_exists('bcn_display'))
{
	bcn_display();
}
?>
</div>
<!-- fine breadcrumbs -->
<?php
$IdPagina=$post->ID;
$TitoloPagina=$post->post_title;
if ( get_post_meta($post->ID, 'usrlo_pagina_categoria', true)!=-1 ) {
	$categoria_pagina = get_post_meta($post->ID, 'usrlo_pagina_categoria', true);
}
if(!isset($categoria_pagina)){
 ?>
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Thanks Kubrick for this code ?>
<?php if (is_category()) { ?>				
		<h2><?php _e('Articoli in'); ?> <?php echo single_cat_title(); ?></h2>		
 	  	<?php } elseif (is_day()) { ?>
		<h2><?php _e('Articoli in'); ?> <?php the_time('F j, Y'); ?></h2>
	 	<?php } elseif (is_month()) { ?>
		<h2><?php _e('Articoli in'); ?> <?php the_time('F, Y'); ?></h2>
		<?php } elseif (is_year()) { ?>
		<h2><?php _e('Articoli in'); ?> <?php the_time('Y'); ?></h2>
		<?php } elseif (is_author()) { ?>
		<h2><?php _e('Articoli di'); ?></h2>
		<?php } elseif (is_search()) { ?>
		<h2><?php _e('Risultati ricerca'); ?></h2>
		<?php } ?>
		<?php while (have_posts()) : the_post(); ?>
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><?php the_title(); ?></h2>
				<p class="postmeta">
				<?php if (!is_page()) { ?>
				<span class="postauthor"><?php _e('Scritto da '); ?><?php the_author(); ?></span><?php _e(' ('); ?>
				<?php the_time('F j, Y') ?> <?php _e('alle'); ?> <?php the_time() ?><?php _e(')'); ?>
				<?php if ( is_callable(array('GeoMashup','show_on_map_link')) ) {
				  $linkString = GeoMashup::show_on_map_link('text=Map%20&show_icon=false');
				  if ($linkString != "")
				  {
				  	echo ' &#183; ';
				  	echo $linkString;
				  }
				} ?>
				&#183; <?php _e('Contenuto in'); ?> <?php the_category(', ') ?><?php if ( function_exists('get_the_tags') ) {if (get_the_tags()) the_tags(', ',', ','');} ?>
				<?php } ?>
				<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
				</p>
				<div class="postentry">
				<?php if (is_search()) { ?>
					<?php the_excerpt() ?>
				<?php } else { ?>
					<?php the_content(__('Leggi il resto &raquo;')); ?>
					<?php if (is_single()) { ?>
						<?php link_pages('', '', 'next') ?>
					<?php } ?>
				<?php } ?>
				</div>
				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
		<?php endwhile; ?>
		<p><?php posts_nav_link(' ', __(' '), __('&laquo; Articoli precedenti')); ?>
		<?php posts_nav_link(' &#183; ', __(' '), __(' ')); ?>
		<?php posts_nav_link(' ', __('Articolii successivi &raquo;'), __(' ')); ?></p>
	<?php else : ?>
		<h2><?php _e('Non trovato'); ?></h2>
		<p><?php _e('Spiacenti, ma nessun articolo corrisponde ai criteri'); ?></p>
	<?php endif; ?>
</div>
<?php
}else{
//Pagine collegate ad una categoria 
	if(get_post_meta($post->ID, "blogroll", $single = true) != "") :
		$blogroll = get_post_meta($post->ID, "blogroll", $single = true);
	endif;
	if(get_post_meta($post->ID, "boxdestra", $single = true) != "") :
		$boxdestra = get_post_meta($post->ID, "boxdestra", $single = true);
	endif;
	if(isset($categoria_pagina)) {
		$querystr = "
		SELECT wpostmeta.post_id
		FROM $wpdb->postmeta wpostmeta
		WHERE wpostmeta.meta_key = 'categoria'
		AND wpostmeta.meta_value = '". $categoria_pagina ."'
			";
		$name = $wpdb->get_var($querystr);
		$post_id = get_post($name); 
		$title = $post_id->post_title;
		$url = get_permalink($name);
	}
	if (have_posts()){ 
		while (have_posts()) : the_post(); 
?>			<div class="post" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><?php the_title(); ?></h2>
				<div class="postentry">
					<?php the_content(__('Leggi il resto &raquo;')); ?>
				</div>
				<!--
				<?php trackback_rdf(); ?>
				-->
			</div>
<?php   endwhile; 
	 }
	if (!is_paged()) {
			$paginazione = '&numberposts=100';
		// seconda pagina con offset
		} elseif($paged == 2) {
			$paginazione = '&offset=100';
		// tutte le altre pagine con offset
		} else {
			$offset = $ppp*($paged-2)+100;
			$paginazione = '&offset='.$offset; 
		}
	global $post;
	$mesecorrente = date(n);
	$annocorrente = date('Y');
//Modifica Tutti gli Articoli
	if ($_GET["q"]=="tutti")
		$myposts = get_posts('category='.$categoria_pagina.$paginazione);
	else
		$myposts = get_posts('monthnum='.$mesecorrente.'&year='.$annocorrente.'&category='.$categoria_pagina.$paginazione);
//Fine Modifica Tutti gli Articoli
	if ($myposts) { ?>
		<h3>Comunicazioni <?php echo $title;?></h3>
<?php
		foreach($myposts as $post) :
				setup_postdata($post);
				global $more;
				$more = 0;
?>
				<h4 class="piccino"><?php the_time('j M y'); ?> - 
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="piccolino">
					<?php the_excerpt(); ?>
				</div>
<?php   endforeach;?>
		<div class="nav">
		<div class="alignleft"><?php next_posts_link('&laquo; Comunicazioni precedenti') ?></div>
		<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
		<div style="clear:both"></div>
<?php } else { 
//	 	global $post;
        $myposts2 = get_posts('numberposts=3&category='.$categoria_pagina);
		if ($myposts2) { ?>
		<h3 class="posttitle"><?php single_cat_title(); ?>Ultimi 3 articoli dei mesi precedenti</h3>
	<?php
		foreach($myposts2 as $post) :
				setup_postdata($post);
				global $more;
				$more = 0;
?>
				<h4 class="piccino"><?php the_time('j M y'); ?> -
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="piccino">
					<?php the_excerpt(); ?>
				</div>
<?php   endforeach; ?>
	<div style="clear:both"></div>
	<?php }
	 }
?>
</div>
<?php
}
include(TEMPLATEPATH . '/rightsidebar.php'); 
get_footer(); 
?>