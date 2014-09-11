<?
/*
Template Name: Mappa
*/
?>
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
	<?php if (have_posts()) : ?>
	
	
		<?php while (have_posts()) : the_post(); ?>
		
			<div class="post" id="post-<?php the_ID(); ?>">
				<h2 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<p class="postmeta">				
				<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
				</p>		
				
				<div class="postentry">
				
					<?php the_content(__('Leggi il resto &raquo;')); ?>
					
				</div>
			
								
				<!--
				<?php trackback_rdf(); ?>
				-->
			
			</div>
				
		<?php endwhile; ?>
	<?php endif; ?>
<div id="left">	
<h3>Pagine</h3>
<ul>	
<?php
wp_list_pages ("sort_column=menu_order&title_li=");
?>
</ul>
</div>
<div id="right">
<h3>Categorie</h3>
<ul>
<?php
wp_list_categories ("hide_empty=0&sort_column=menu_order&title_li=");
 ?>
</ul>
</div>
	</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>