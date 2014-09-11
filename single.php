<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">
<div class="nascosto">
<strong> Navigazione veloce </strong>
<ul>
<li><a href="#wrapper">torna in cima</a></li>
<li><a href="#leftsidebar">vai alla navigazione principale</a></li>
<li><a href="#rightsidebar">vai alla navigazione contestuale</a></li>
</ul>
</div>
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">		
	
			<h2 class="posttitle"><?php the_title(); ?></h2>
			
			<?php if ( function_exists('previous_cat_post') ) { ?> 			
			<div id="postnavigation">
			<ul>
			<li class="navheader">Next Entries</li>
			<?php next_cat_post($beforeGroup='', $afterGroup='', $beforeEach='<li>', $afterEach='</li>', $showtitle=true, $textForEach='(%) '); ?>
			<li class="navheader">Previous Entries</li>
			<?php previous_cat_post($beforeGroup='', $afterGroup='', $beforeEach='<li>', $afterEach='</li>', $showtitle=true, $textForEach='(%) '); ?>
			</ul>
			</div>			
			<?php } ?>
			
			<p class="postmeta">
			<?php if (!is_page()) { ?>
			<span class="postauthor"><?php _e('Pubblicato il '); ?><?php the_time('j M y') ?> <?php _e('alle'); ?> <?php the_time() ?></span> 
			<?php if ( is_callable(array('GeoMashup','show_on_map_link')) ) {
				$linkString = GeoMashup::show_on_map_link('text=Map%20&show_icon=false');
				if ($linkString != "")
				{
					echo ' &#183; ';
					echo $linkString;
				}
			} ?>
			&#183; <?php _e('Contenuto in:'); ?> <?php the_category(', ') ?>
			<?php $posttags = get_the_tags($post->ID); 
							if ($posttags) { ?>
								<span>- Tag:</span>
								<?php 
								foreach($posttags as $tag) {
									echo '<a href="';
									echo get_tag_link($tag);
									echo '">';
									echo $tag->name . '';
									echo '</a> ';
								}
							}
			?>
			<?php } ?>
			<?php edit_post_link(__('Edit'), ' &#183; ', ''); ?>
			</p>	
		
<div class="postentry">
<?php if(!empty($post->post_excerpt)) {
//This post have an excerpt, let's display it
echo '<div class="riassunto">';
the_excerpt();
echo '</div>';
} else {
// This post have no excerpt
} ?>
<?php the_content(__('Leggi il resto &raquo;')); ?>
<?php wp_link_pages(); ?>
<?php if(get_option('Pasw_Social')==1) : ?>
	
	<ul class="socialnet">
	<li class="face">
		<a rel="nofollow" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php echo urlencode(get_the_title($id)); ?>" title="Condividi questo post su Facebook"><img src="<?php echo bloginfo("home");?>/wp-content/themes/Pasw2013/images/fb-20.png" alt="Condividi questo post su Facebook" /></a>
	</li>
	<li class="twit">
		<a href="https://twitter.com/share" class="twitter-share-button" title="Condividi con i tuoi followers di Twitter">Tweet</a>
		<script type="text/javascript">!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	</li>
	<li class="plusone">
		<div class="g-plusone"></div>
	</li>
	</ul>
<?php endif; ?>
</div>
			<p class="postfeedback">
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permalink a'); ?> <?php the_title(); ?>" class="permalink"><?php _e('Permalink'); ?></a>
			<?php // add support for wp-email 
				if(function_exists('wp_email')) { email_link('E-Mail to a friend', 'E-Mail to a friend', ' class="permalink"'); } ?>
			</p>
			
		</div>
		
		<?php comments_template(); ?>
				
	<?php endwhile; else : ?>
		<h2><?php _e('Non trovato'); ?></h2>
		<p><?php _e('Spiacenti, ma la pagina richiesta non � stata trovata.'); ?></p>
	<?php endif; ?>
</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>