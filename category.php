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
	<h2 class="posttitle"><?php single_cat_title(); ?></h2>
	<h3>Archivio</h3>
	
					
		<?php while (have_posts()) : the_post(); ?>		
		
		<h4 class="piccino"><?php the_time('j M y'); ?> -
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
				<div class="piccino">
					<?php the_excerpt(); ?>
				</div>
		<?php endwhile; ?>
	<?php else : ?>
		<h2><?php echo single_cat_title(); ?></h2>
		<p><?php _e('Spiacenti, ma non ci sono articoli per questa categoria.'); ?></p>
	<?php endif; ?>
	</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>