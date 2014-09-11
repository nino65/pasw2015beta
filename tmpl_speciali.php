<?
/*
Template Name: Speciale
*/
?>
<?php get_header(); ?>
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
				
				<?php
				$children = wp_list_pages('title_li=&depth=1&child_of='.$post->ID.'&echo=0');
				if ($children) { ?>
				<ul class="gerarchia">
				<?php echo $children; ?>
				</ul>
				<?php } ?>
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
	
	<h3>Esplora la categoria:</h3>
	<ul>
	
	<?php if (is_page(197)) wp_list_categories('title_li=&child_of=3'); ?>
	<?php if (is_page(25))  wp_list_categories('title_li=&child_of=9'); ?>
	<?php if (is_page(204)) wp_list_categories('title_li=&child_of16'); ?>
	<?php if (is_page(73))  wp_list_categories('title_li=&child_of=12'); ?>
	<?php if (is_page(93))  wp_list_categories('title_li=&child_of=6'); ?>
	</ul>
	</div>
<?php get_sidebar(); ?>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>