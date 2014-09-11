<?php
/*
Template Name: Home page
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">
<div id="home-left">
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	<?php endwhile; endif; ?>
<!-- Via WP Posts in category Homeboxes -->
	<?php
	global $post;
	//$homeboxes = get_post_meta($post->ID, "homeboxes", $single = true);
	$homeboxes = get_option('Pasw_HomeBoxes');
	//$ultimecomunicazioni = get_post_meta($post->ID, "ultimecomunicazioni", $single = true);
	$homeboxes = get_option('Pasw_HomeBoxes');
	$ultimecomunicazioni = get_option('Pasw_Comunicazioni');
	$inevidenza = get_option('Pasw_InEvidenza');
	if(($homeboxes) != ""){
		$homepostsID = explode(',', $homeboxes);
		foreach($homepostsID as $postID){
			$post = get_post($postID);
			echo '<h2>'.$post->post_title.'</h2>
					'.$post->post_content;
		}
	}
?>
<!-- Via Text Snippets -->
<!--
	<?php // this will not work if you don't have the plugin installed, so it's commented out ?>
	<?php // get_textsnippet(1);?>
	<?php // get_textsnippet(2);?>
-->
</div>
<div id="home-right">
<?php
	if(($inevidenza) != "") :
	 ?>
<h2>News</h2>
	<?php
	global $post;
	$myposts = get_posts('numberposts=3&category='.$inevidenza);
	foreach($myposts as $post) :
			setup_postdata($post);
			global $more;
			$more = 0;
	?>
		<h3><?php the_time('j M y') ?> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
	<?php endforeach; ?>
	
	<p class="dx"><a href="news/">Tutte le news...</a></p>
<?php 
	endif;
?>
<?php
	if(($ultimecomunicazioni) != "") :
	 ?>
	<h2>Ultime circolari</h2>
	<?php
	global $post;
	$myposts = get_posts('numberposts=5&category='.$ultimecomunicazioni);
	foreach($myposts as $post) :
			setup_postdata($post);
			global $more;
			$more = 0;
	?>
		<h3><?php the_time('j M y') ?> - <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                  <?php the_excerpt(); ?>
	<?php endforeach; ?>
	
	<p class="dx"><a href="circolari/">Tutte le circolari...</a></p>
<?php 
	endif;
?>
<?php if ( function_exists('ec3_get_calendar') ){?>
<h2>Prossimi eventi</h2>
<?php
ec3_get_events(
   5,                               // limit
   '%DATE%: <a href="%LINK%">%TITLE%</a>', // template_event
   ''                                      // template_day
);
?>
<?php } ?>
</div>
<div id="sotto-hp">
<?php 
$sidebars_widgets = wp_get_sidebars_widgets();
if (count($sidebars_widgets['sidebar-3'])>0) :
?>
	<div class="col-com2">
		<ul>
<?php
	endif;
     	if ( function_exists('dynamic_sidebar') && dynamic_sidebar("sottohome1") ) : 
	endif;
	if (count($sidebars_widgets['sidebar-3'])>0) :
 ?>
		</ul>
	</div>
<?php endif;
if (count($sidebars_widgets['sidebar-4'])>0) :
?>
	<div class="col-com2">
		<ul>
<?php
	endif;
     	if ( function_exists('dynamic_sidebar') && dynamic_sidebar("sottohome2") ) : 
	endif;
	if (count($sidebars_widgets['sidebar-4'])>0) :
 ?>
		</ul>
	</div>
<?php endif;
if (count($sidebars_widgets['sidebar-5'])>0) :
?>
	<div class="col-com2">
		<ul>
<?php
endif;
     	if ( function_exists('dynamic_sidebar') && dynamic_sidebar("sottohome3") ) : 
	endif;
	if (count($sidebars_widgets['sidebar-5'])>0) :
 ?>
		</ul>
	</div>
<?php endif;?>
</div>
<p class="pulisci"><br /></p>
</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>