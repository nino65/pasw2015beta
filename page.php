<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">

<!-- breadcrumbs -->
<div id="path">
<?php if(function_exists('bcn_display')) { bcn_display(); } ?>
</div>
<!-- fine breadcrumbs -->

<?php if (have_posts()){ 
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
<?php   endwhile; } ?>
</div>
<?php
include(TEMPLATEPATH . '/rightsidebar.php'); 
get_footer(); 
?>