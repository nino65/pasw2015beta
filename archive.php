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
<?php 
//verifica se ? una categoria
if (isset($_GET['catid']) && !empty($_GET['catid'])) {
$catid = $_GET['catid'];
$categoryname = get_cat_name($catid) . " ";
$category = "catid=".$catid;
}
?>
<!-- fine breadcrumbs -->
<?php if (is_category()) { ?>
<p>RSS: <a href ="<?php echo get_category_link($cat);?>feed">
sottoscrivi '<?php single_cat_title(); ?>' post</a></p>
<?php } ?>
	<?php if (have_posts()) : ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* If this is a category archive */ if (is_category()) { ?>	
		<h2 class="pagetitle">Archivio per la categoria  '<?php echo single_cat_title(); ?>'</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Archivio <?php echo $categoryname ?>del <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Archivio <?php echo $categoryname ?> <?php the_time('F Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Archivio <?php echo $categoryname ?> anno <?php the_time('Y'); ?></h2>
	<?php /* If this is a search */ } elseif (is_search()) { ?>
		<h2 class="pagetitle">Risultati della ricerca</h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h2 class="pagetitle">Archivio autore</h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Archivi</h2>
	<?php /* If this is a tag archive */ } elseif (is_tag()){ ?>
		<h2 class="pagetitle">Archivi per argomento (tag) '<?php single_tag_title(); ?>'</h2>
	<?php } ?>
	<!--<h3 class="posttitle"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e('Permanent link to'); ?> <?php single_cat_title(); ?>"><?php single_cat_title(); ?></a></h3>
	-->
		<?php
		
		
		$ppp = get_option('posts_per_page');
		//echo $ppp;
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
		if (is_month()) {
			$mese = get_the_time('m');
			$anno = get_the_time('Y');
			$rand_posts = get_posts('monthnum='.$mese.'&year='.$anno.'&category='.$catid.$paginazione);
			//echo 'monthnum='.$mese.'&year='.$anno.'&category='.$catid.$paginazione;
		} elseif (is_year()) {
			$anno = get_the_time('Y');
			$rand_posts = get_posts('year='.$anno.'&category='.$catid.$paginazione);	
			//echo 'year='.$anno.'&category='.$catid.$paginazione;
		} else if (is_tag()) {
			$rand_posts = get_posts('tag='.get_query_var('tag').$paginazione);
		} else {
			$rand_posts = get_posts('category='.$catid.$paginazione);
			//echo 'category='.$catid.$paginazione;
		}
		
		foreach( $rand_posts as $post ) :
		
		//while (have_posts()) : the_post(); ?>
		
<h3 class="piccino"><?php the_time('j M y'); ?> - 
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="piccolino">
				<?php the_excerpt(); ?>
				</div>
			<?php endforeach; ?>
<div class="nav">
<div class="alignleft"><?php next_posts_link('&laquo; Comunicazioni precedenti') ?></div>
<div class="alignright"><?php previous_posts_link('Comunicazioni successive &raquo;') ?></div>
</div>
<div style="clear:both"></div>
<!--<h3>Archivio <?php echo get_the_time('Y')?></h3>
 <ul>
 --><?php
/*function archivi_anno_corrente ($sql) {
global $mist_time;
$post = $posts[0];
if (is_year()) {
if (!isset($mist_time)) {
$mist_time = get_the_time('Y');
}
$sql=$sql . ' AND YEAR(post_date) = ' . $mist_time;
} else {
$sql=$sql . ' AND YEAR(post_date) = '. get_the_time('Y'); //YEAR (CURRENT_DATE) ';
}
return $sql;
}
//echo $category.'&limit='.date("m");
//wp_get_archives($category.'&limit='.date("m"));
add_filter ('getarchives_where','archivi_anno_corrente');
wp_get_archives($category);
remove_filter ('getarchives_where','archivi_anno_corrente');
/*/?>
<!-- </ul>
 -->
<!-- <h3>Archivio per anni</h3>
<ul>
 --><?php
/*
function escludi_archivi_anno_corrente ($sql) {
	global $mist_time;
	if (is_year()) {
		if (!isset($mist_time)) {
			$mist_time = get_the_time('Y');
			}
			$sql=$sql . ' AND YEAR(post_date) != ' . $mist_time;
		} else {
			$sql=$sql . ' AND YEAR(post_date) != ' . get_the_time('Y'); //< YEAR (CURRENT_DATE) ';
	}
	return $sql;
}
add_filter ('getarchives_where','escludi_archivi_anno_corrente');
wp_get_archives($category.'&type=yearly');
remove_filter ('getarchives_where','escludi_archivi_anno_corrente');
*/?>
<!-- </ul>
 -->
	<?php endif; ?>
	</div>
<?php include(TEMPLATEPATH . '/rightsidebar.php'); ?>
<?php get_footer(); ?>