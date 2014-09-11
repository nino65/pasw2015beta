<div id="rightsidebar" class="column">
<ul>
	<li>
		<h2 class="motore">Motore di ricerca interno</h2>
		<form method="get" id="searchform" action='<?php echo bloginfo("home");?>' >
			<div><label class="screen-reader-text" for="s">Cerca:</label>
				<input type="text" value="" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Cerca" />
			</div>
		</form>
	</li>
<?php
if (is_single ()) {
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
		$args=array('tag__in' => $tag_ids,
					'post__not_in' => array($post->ID),
					'showposts'=>3, // Number of related posts that will be shown.
					'caller_get_posts'=>1);
		$my_query = new wp_query($args);
		if( $my_query->have_posts() ) {
			echo '<li><h2 class="widgettitle">Articoli correlati</h2><ul>';
			while ($my_query->have_posts()) {
				$my_query->the_post();
			?>
				<li>
					<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
				</li>
			<?php
			}
			echo '</ul></li>';
		}
	}
}
if (is_front_page ()||is_home ()) {
?>
      <?php if ( function_exists('ec3_get_calendar') ){?>
      <li>
          <h2>Calendario eventi</h2>
          <?php ec3_get_calendar(); ?>
      </li>
     <?php } ?>
<?php 
	if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : endif;
} 
if (is_page () and !is_front_page ()){ 
	$post->ID=$IdPagina;
	$post->post_title=$TitoloPagina;
	if ( function_exists('dynamic_sidebar') && dynamic_sidebar(2) ) : endif;
}
if (is_category ()||is_archive () || is_page() ) {
	//verifica se � una categoria
	if (isset($_GET['catid']) && !empty($_GET['catid'])) {
		$catid = $_GET['catid'];
	}else{
		$catid = $categoria_pagina;
	}
	if (!isset($catid)) {
		//$categoria = get_the_category(); 
		//$catid1 = $categoria[0]->cat_ID;
		$catid = get_query_var('cat'); 
	}
//echo $categoria."   ".$catid1."  ".$catid;
	$categoryname = get_cat_name($catid) . " ";
	$category = "catid=".$catid;
	$obj_cat = get_category ($catid);
	if (is_category()||is_archive()||is_tag()||is_page_template('page4miur.php')) {
		if(isset($catid)) {
			$cat = get_category($catid);
			$parent = $cat->category_parent;
			$querystr = "SELECT wpostmeta.post_id
			    		 FROM $wpdb->postmeta wpostmeta
			 			 WHERE wpostmeta.meta_key = 'categoria'
			 			 AND wpostmeta.meta_value = '". $catid ."'";
			$name = $wpdb->get_var($querystr);
			$post_id = get_post($name); 
			$title = $post_id->post_title;
			$url = get_permalink($name);
			if(!is_category() and !is_archive()){
				echo '<li><h2 class="widgettitle"><a href="'.$url. '">'.$title.'</a></h2><ul>';
				wp_list_pages('&title_li=&child_of='.$name);
// qui dobbiamo aggiungere la chiusura del ul e del li aggiunto due righe sopra :) -- ronny
// da notare che qui se fai la validazione ti da errore se non ci sono pagine listate perche apre e chiude un ul senza metterci dentro nulla -- ronny
		            echo '</ul></li>';
		    }
		}
	}
}
if (!empty($catid)) {
	$Anno=0;
	$Mese=0;
	Pasw13_MeseAnnoCorrenti(&$Anno,&$Mese);
	$ArchiviMesiAnno=Pasw13_ElencoAnniMesi("mesi",$catid,$Anno);
	$ArchiviAnni=Pasw13_ElencoAnniMesi("anni",$catid,$Anno);
	if (!empty($ArchiviMesiAnno) Or !empty($ArchiviAnni)){
?>
	<!-- Inizio Modifica Tutti gli articoli della categoria -->
		<li>
			<h2 class="widgettitle">Categoria <?php echo $categoryname?></h2>
			<ul>
				<li>
					<a href="<?php echo bloginfo( "url" )."/".$obj_cat->slug.'/?q=tutti';?>" >Tutti gli articoli</a>
				</li> 
			</ul>
		</li>
<?php 
		if(!empty($ArchiviMesiAnno)){?>
	<!--Fine Modifica tutti gli articoli della categoria -->
			<li>
				<h2 class="widgettitle">Archivio <?php echo $Anno;?></h2>
				<ul>
					<?php	echo $ArchiviMesiAnno; ?>
				</ul>
			</li>
<?php   } 
		if (!empty($ArchiviAnni)){?>
			<li>
				<h2 class="widgettitle">Archivio per anni</h2>
				<ul>
					<?php echo $ArchiviAnni; ?>
				</ul>
			</li>
<?php
		}
	}
}
if (!empty($catid)) {
	wp_list_categories('title_li=<h2 class="widgettitle">Categorie</h2>&orderby=id&child_of='.$catid);
	}
if (!empty($blogroll)) {
	wp_list_bookmarks('&categorize=0&category='.$blogroll. '&orderby=order&category_orderby=order');
   } 
if (!empty($boxdestra)) { 
	echo $boxdestra;
  } 
if (is_front_page ()||is_home ()) {
	if ( function_exists('wp_tag_cloud') ) : 
?>
	<li>
		<h2>Argomenti pi&Ugrave; popolari</h2>
		<?php wp_tag_cloud('smallest=8&largest=12&number=14&format=list'); ?>
	</li>
<?php 
	endif; 
 } 
 ?> 
</ul>
</div>