<?php 

//modifiche
require ( get_template_directory() . '/include/welcome-pasw2015.php' );
require (get_template_directory() . '/github/github-updater.php');

add_action(admin_init, "reg_set_p");

function reg_set_p() {
	register_setting( 'pasw2015_options', 'pasw2015_socialbuttons');
	register_setting( 'pasw2015_options', 'pasw_email_scuola');
	register_setting( 'pasw2015_options', 'pasw_recapito_scuola');
	register_setting( 'pasw2015_options', 'pasw_indirizzo_scuola');
	register_setting( 'pasw2015_options', 'pasw_increased_width');
}
//--
require ( get_template_directory() . '/include/theme-options.php' );
add_action( 'add_meta_boxes', 'UsrLo_meta_box_add_PaginaCategoria' );
function UsrLo_meta_box_add_PaginaCategoria()
{
	add_meta_box( 'usrlo-meta-box-id', 'Elenco Categorie', 'UsrLo_meta_box_PaginaCategoria', 'page', 'side', 'default' );
}
function UsrLo_meta_box_PaginaCategoria( $post )
{
	$values = get_post_custom( $post->ID );
	$selected = isset( $values['usrlo_pagina_categoria'] ) ? esc_attr( $values['usrlo_pagina_categoria'][0] ) : '';
	wp_nonce_field( 'usrlo_pagina_categoria_nonce', 'usrlo_pagina_categoria_meta_box_nonce' );
	?>
    <?php
    $selezionata = '';
	if ( get_post_meta($post->ID, 'usrlo_pagina_categoria', true) ) : $selezionata = get_post_meta($post->ID, 'usrlo_pagina_categoria', true); endif; ?>
	
	<p>
		<label for="usrlo_pagina_categoria"><strong>Categorie</strong></label><br />
        <em>seleziona una delle seguenti categorie per mostrare il suo contenuto in questa pagina</em>
        <?php
        $args = array('id'=>'usrlo_pagina_categoria','name'=>'usrlo_pagina_categoria','hide_empty'=> 0, 'orderby'=> 'name','order'=> 'ASC','hierarchical'=>1,'show_option_none'=>'- Pagina senza Categoria', 'selected'=>$selezionata);
		wp_dropdown_categories( $args ); ?>
	</p>
	<?php	
}
add_action( 'save_post', 'UsrLo_meta_box_save_PaginaCategoria' );
function UsrLo_meta_box_save_PaginaCategoria( $post_id )
{
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if( !isset( $_POST['usrlo_pagina_categoria_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['usrlo_pagina_categoria_meta_box_nonce'], 'usrlo_pagina_categoria_nonce' ) ) return;
	if( !current_user_can( 'edit_post' ) ) return;
	if( isset( $_POST['usrlo_pagina_categoria'] ) )
		update_post_meta( $post_id, 'usrlo_pagina_categoria', esc_attr( $_POST['usrlo_pagina_categoria'] ) );
}
add_theme_support('post-thumbnails');
/* Menu */
add_action('init', 'register_my_menus');
function register_my_menus() {
register_nav_menus(
	array(
		'menu-1' => __('Menu 1'),
		'menu-2' => __('Menu 2'),
		'menu-3' => __('Menu 3'),
	)
);
}
/* prima creo le sidebar per le barre laterali */
if ( function_exists('register_sidebars') )
	register_sidebars(2);
/* inserisco aree-widget nel footer e nell'header*/
if ( function_exists('register_sidebar') ){
register_sidebar(Array("name" => "sottohome1"));
register_sidebar(Array("name" => "sottohome2"));
register_sidebar(Array("name" => "sottohome3"));
    }
/* returns the count of comments or pings depending */ 
function comment_count_special($post_id, $comment_type)  
{
  	$the_post_comments = get_comments('post_id=' . $post_id);
  	$comments_by_type = &separate_comments($the_post_comments);
  	return count($comments_by_type[$comment_type]);  
}    
/* Only return comment counts */  
add_filter('get_comments_number', 'comment_count', 0); 
function comment_count( $count )   
{
  	global $id;
  	global $nearlysprung;
  	if ($nearlysprung->option['splitpings'] != "yes")
  	{
  	 	return $count;
  	}
  	else
  	{
 		return comment_count_special($id, 'comment');
  	} 
}  
function ns_comments($comment, $args, $depth) 
{
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php echo get_avatar($comment->comment_author_email, $size = '40', $comment->comment_author_link); ?>
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">said,</span>'), get_comment_author_link()) ?>
      </div>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br />
      <?php endif; ?>
      <div class="comment-meta commentmetadataa">
            <?php comment_date('F j, Y') ?> 
            @ <a href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a>
            <?php edit_comment_link(__("Edit"), ' &#183; ', ''); ?>
      </div>
      <?php comment_text() ?>
      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
<?php
}
function ns_trackbacks($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-trackbackping-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <div class="comment-author vcard">
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">said,</span>'), get_comment_author_link()) ?>
      </div>
      <div class="comment-meta commentmetadataa">
            <?php comment_date('F j, Y') ?> 
            @ <a href="#trackbackping-<?php comment_ID() ?>"><?php comment_time() ?></a>
            <?php edit_comment_link(__("Edit"), ' &#183; ', ''); ?>
      </div>
      <?php comment_text() ?>
     </div>
<?php
        }
//FUNZIONE PER ESCLUDERE ANNO CORRENTE DAGLI ARCHIVI
function escludi_archivi_anno_corrente ($sql) {
	global $mist_time;
	if (is_year()) {
		if (!isset($mist_time)) {
			$mist_time = date('Y');
			}
			$sql=$sql . ' AND YEAR(post_date) != ' . $mist_time;
		} else {
			$sql=$sql . ' AND YEAR(post_date) != ' . date('Y'); //< YEAR (CURRENT_DATE) ';
	}
	return $sql;
}
//FUNZIONE PER VISIONARE ARCHIVI PER L'ANNO CORRENTE
function archivi_anno_corrente ($sql) {
global $mist_time;
$post = $posts[0];
	if (is_year()) {
		if (!isset($mist_time)) {
			$mist_time = date('Y');
			}
			$sql=$sql . ' AND YEAR(post_date) = ' . $arc_year;
	} else {
			$sql=$sql . ' AND YEAR(post_date) = '. date('Y'); //YEAR (CURRENT_DATE) ';
	}
	return $sql;
}
//visualizzo archivio della categoria degli anni precedenti
function wpit_archivio_anni ( $category ) {
	
	add_filter ('getarchives_where','escludi_archivi_anno_corrente');
	
		$archivio_anni = wp_get_archives($category.'&type=yearly&echo=0');
	remove_filter ('getarchives_where','escludi_archivi_anno_corrente');
       	
return $archivio_anni;
}
//visualizzo archivio della categoria dell'anno corrente per mese
function wpit_archivio_anno_corrente ( $category ) {
	
	add_filter ('getarchives_where','archivi_anno_corrente');
		$archivio_anno = wp_get_archives($category .'&echo=0');
	remove_filter ('getarchives_where','archivi_anno_corrente');
	
return $archivio_anno;
}
function MeseAnnoCorrenti(&$Anno,&$Mese){
	$pezziUrl=explode('/',$_SERVER['REQUEST_URI']);
$Anno=$pezziUrl[count($pezziUrl)-2];
$Mese=0;
if(strlen($Anno)==2){
	$Mese=$Anno;
	$Anno=$pezziUrl[count($pezziUrl)-3];
}
if(!is_numeric($Anno))
	$Anno=date("Y");
if(!is_numeric($Mese))
	$Mese=0;
}
function Pasw13_MeseAnnoCorrenti(&$Anno,&$Mese){
	
	$pezziUrl=explode('/',$_SERVER['REQUEST_URI']);
$Anno=$pezziUrl[count($pezziUrl)-2];
$Mese=0;
if(strlen($Anno)!=4){
	$Mese=$Anno;
	$Anno=$pezziUrl[count($pezziUrl)-3];
}
if(!is_numeric($Anno))
	$Anno=date("Y");
if(!is_numeric($Mese))
	$Mese=0;
}
function Pasw13_ElencoAnniMesi($tipo,$Categoria,$Anno){
global $wpdb,$table_prefix;
$Ritorno="";
//echo $tipo."  ".$Categoria."  ".$Anno;
$mesi = array("Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno", "Luglio", "Agosto", "Settembre", "Ottobre","Novembre", "Dicembre");
if ($tipo=="anni"){
	$Sql='SELECT year('.$table_prefix.'posts.post_date) as anno  
		FROM '.$table_prefix.'posts JOIN '.$table_prefix.'term_relationships ON '.$table_prefix.'posts.ID = '.$table_prefix.'term_relationships.object_id
                   JOIN '.$table_prefix.'term_taxonomy ON '.$table_prefix.'term_taxonomy.term_taxonomy_id = '.$table_prefix.'term_relationships.term_taxonomy_id
		WHERE post_type="post" and post_status="publish" and '.$table_prefix.'term_taxonomy.term_id='.$Categoria.' And year('.$table_prefix.'posts.post_date)<>'.$Anno.' 
		group by year('.$table_prefix.'posts.post_date)
		order by year('.$table_prefix.'posts.post_date) DESC;';
	$AnniMesi=$wpdb->get_results($Sql,ARRAY_A );
		foreach( $AnniMesi as $AnnoMese){
			$Ritorno.='<li><a href="'.home_url().'/'.$AnnoMese["anno"].'/?catid='.$Categoria.'" title="link agli articoli dell\'anno '.$AnnoMese["anno"].'">'.$AnnoMese["anno"].'</a></li>
				';
		}
}else{
	$Sql='SELECT year('.$table_prefix.'posts.post_date) as anno  , month('.$table_prefix.'posts.post_date) as mese
		FROM '.$table_prefix.'posts JOIN '.$table_prefix.'term_relationships ON '.$table_prefix.'posts.ID = '.$table_prefix.'term_relationships.object_id
                   JOIN '.$table_prefix.'term_taxonomy ON '.$table_prefix.'term_taxonomy.term_taxonomy_id = '.$table_prefix.'term_relationships.term_taxonomy_id
		WHERE post_type="post" and post_status="publish" and '.$table_prefix.'term_taxonomy.term_id='.$Categoria.' And year('.$table_prefix.'posts.post_date)='.$Anno.' 
		group by year('.$table_prefix.'posts.post_date), month('.$table_prefix.'posts.post_date)
		order by year('.$table_prefix.'posts.post_date) DESC, month('.$table_prefix.'posts.post_date) DESC;';
	$AnniMesi=$wpdb->get_results($Sql,ARRAY_A );
		foreach( $AnniMesi as $AnnoMese){
			$Mese=$AnnoMese["mese"];
			$Ritorno.='<li><a href="'.home_url().'/'.$AnnoMese["anno"].'/'.$Mese.'/?catid='.$Categoria.'" title="link agli articoli di '.$mesi[$Mese-1].' del '.$AnnoMese["anno"].'">'.$mesi[$AnnoMese["mese"]-1].' '.$AnnoMese["anno"].'</a></li>
				';
		}
}
//echo $Sql;	
return $Ritorno;
}
?>