<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

// Funzione Elenca Files
function elencafiles($dirname,$estensione){
	$arrayfiles=Array();
	if(file_exists($dirname)){
		$handle = opendir($dirname);
		while (false !== ($file = readdir($handle))) { 
			if(is_file($dirname.$file) and strrchr($dirname.$file, '.')== '.'.$estensione and substr($file,0,6)=="stile_"){
				array_push($arrayfiles,$file);
			}
		}
		$handle = closedir($handle);
	}
	sort($arrayfiles);
	return $arrayfiles;
}


//require ( get_template_directory() . '/include/homeboxes.php'); 
function CaricaLogo(){
if ($_FILES['file']['tmp_name']==''){
	$messages= "Fine non selezionato Oppure operazione annullata";
}else{
	$EstensioniValide = array("png", "gif", "jpg", "jpeg");
	if (!in_array( end(explode(".", strtolower($_FILES["file"]["name"]))), $EstensioniValide)){
		$messages= "Tipo file non valido, devi caricae una immagine in formato Png - Gif - Jpeg";
	}else{
		if ($_FILES["file"]["error"] > 0){
			$messages= "Errore: " . $_FILES["file"]["error"];
    	}else{
			$destination_path = TEMPLATEPATH.'/images/';
			if(@move_uploaded_file($_FILES['file']['tmp_name'], $destination_path.$_FILES['file']['name'])) {
				$stato=0;
				$messages= "File caricato Nome: " . basename( $_FILES['file']['name'])." in: ".str_replace("\\","/",$destination_path);
	   		}else{
	   		 	$stato=1;
				$messages= "Il File non caricato: ". basename( $_FILES['file']['name'])." in: ".str_replace("\\","/",$destination_path)." Errore:".$_FILES['file']['error'];
			}
		}
  	} 
  }
$ret=array("stato =>" => $stato,
		   "messaggio" => $messages, 
		   "percorso" => $_FILES["file"]["name"]);
return $ret;
}


function memo_post_homeboxes_order() {
	$order = explode(',', $_POST['order']);
	$post = "";
 
	foreach ($order as $post_id) {
		$post.=$post_id.",";
	}
	if (strlen($post)>0)
		$post=substr( $post,0,-1);
	
	delete_option( 'Pasw_HomeBoxes');
	add_option('Pasw_HomeBoxes', $post );	
	die(1);
}
add_action('wp_ajax_post_homeboxes_sort', 'memo_post_homeboxes_order');
add_action('admin_menu', 'registra_aspetto_submenu_page_PorteAperteSulWeb');
add_action('wp_head','PorteAperteSulWeb_frontend_scripts' );

function registra_aspetto_submenu_page_PorteAperteSulWeb() {
if ($_POST["operazione"]=="uploadFLP2013"){
	if($_FILES["file"]["size"]>0){
		$risultato=CaricaLogo();
		if ($risultato["stato"]==0){
			delete_option ( 'Pasw_Logo_img');
			add_option ( 'Pasw_Logo_img', $risultato["percorso"] );	
		}
		echo '<div id="message" class="updated  fade" style="margin-right:200px"><p>'.$risultato['messaggio'].'</p></div>';
	}else{
		delete_option ( 'Pasw_Logo_img');
		add_option ( 'Pasw_Logo_img', $_POST["file_logo_img"]);	
	}
	delete_option ( 'Pasw_Logo_alt');
	add_option ( 'Pasw_Logo_alt', $_POST["Logo_alt"] );	
}else{
if ( count($_POST) > 0 && isset($_POST['Passwd_Impostazioni']) )
	{
//print_r($_POST);exit;
		switch ($_POST['Submit']) {
			case "Memorizza Modifiche Testa":
				delete_option ( 'Pasw_Testa');
				add_option ( 'Pasw_Testa', $_POST["Testa"] );	
				break;
			case "Memorizza Modifiche Social":
				delete_option ( 'Pasw_Social');
				add_option ( 'Pasw_Social', $_POST["social"] );	
				break;
			case "Memorizza Modifiche Piede":
				delete_option ( 'Pasw_Piede');
				add_option ( 'Pasw_Piede', $_POST["Piede"] );	
				delete_option ( 'Pasw_Autore');
				add_option ( 'Pasw_Autore', $_POST["Autore"] );	
				break;
			case "Memorizza Modifiche Categorie Home Page":
				delete_option ( 'Pasw_InEvidenza');
				add_option ( 'Pasw_InEvidenza', $_POST["CategoriaInEvidenza"] );	
				delete_option ( 'Pasw_Comunicazioni');
				add_option ( 'Pasw_Comunicazioni', $_POST["CategoriaComunicazioni"] );	
				delete_option ( 'Pasw_CatHomeSinistra');
				if ($_POST["CategoriaHomeSinistra"]!=-1)
					add_option ( 'Pasw_CatHomeSinistra', $_POST["CategoriaHomeSinistra"] );	
				break;
			case "Memorizza Modifiche Stile":
				delete_option('Pasw_Stile');
				add_option ( 'Pasw_Stile', $_POST["Stile"] );	
		}
	}
}

$Pagina=add_submenu_page( 'themes.php', 'Tema Pasw','Tema Pasw','manage_options', 'TemaPasw','TemaPasw_Pagina_Opzioni'); 
add_action( 'admin_head-'. $Pagina,'PorteAperteSulWeb_admin_enqueue_scripts' );
}

function PorteAperteSulWeb_admin_enqueue_scripts() {
	wp_enqueue_style( 'PorteAperteSulWeb-theme-options', get_template_directory_uri() . '/include/theme-options.css', false, '1.0' );
	wp_enqueue_script( 'PorteAperteSulWeb-theme-options', get_template_directory_uri() . '/include/theme-options.js', array( 'jquery' ), '1.0' );
	wp_enqueue_script('jquery-ui-draggable');
	wp_enqueue_script('jquery-ui-sortable');
}

function PorteAperteSulWeb_frontend_scripts() {
	if (get_option('Pasw_Social')==1){
		echo '<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
		<link rel="stylesheet" href="'.get_bloginfo('template_directory').'/social.css" type="text/css" media="screen" />';
	}
}

function TemaPasw_Pagina_Opzioni($Show=false) {

	if (!isset($_REQUEST['settings-updated']))
		$_REQUEST['settings-updated'] = false;
	if (get_option('Pasw_Logo_img') != ''){
		if(file_exists(TEMPLATEPATH.'/images/'.basename(get_option('Pasw_Logo_img')))){ 
			$image_info = getimagesize(TEMPLATEPATH.'/images/'.basename(get_option('Pasw_Logo_img')));
			$scala = 65/$image_info[1];
			$width = $image_info[0] * $scala;
			$height = $image_info[1] * $scala;
		}else{
			$width = 0;
			$height = 0;
		}	
}	
	?>
    
    <div class="wrap" style="width:100%;">
        <h2>Porte Aperte Sul Web <br />Pannello di Configurazione</h2>
		<?php if (false !== $_REQUEST['settings-updated']) : ?>
		<div class="updated fade" style="margin-right:200px"><p><strong><?php _e('Options Saved', 'responsive'); ?></strong></p></div>
		<?php endif; ?>


            <div id="rwd" class="grid" style="">
	            <h3 class="rwd-toggle"><a href="#">Impostazioni Logo</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block"> 
	                 <div class="grid">
						 <form id="allegato" enctype="multipart/form-data" method="post" action="">
							<input type="hidden" name="operazione" value="uploadFLP2013" />
							<table class="form-table">
								<!-- General settings -->
								<tr valign="top">
									<th scope="row"><label for="logo_img">Immagine Logo</label></th>
									<td>
										<input name="file" type="file"  size="80" id="logo_img" value="<?php echo get_option('Pasw_Logo_img'); ?>" class="regular-text" /><br />
										<em>logo corrente:</em> <br /> 
										<input name="file_logo_img" type="text" id="file_logo_img" value="<?php echo get_option('Pasw_Logo_img'); ?>" class="regular-text" style="width:60em;"/> <br />
										<img src="<?php echo get_bloginfo("template_url").'/images/'.basename(get_option('Pasw_Logo_img')); ?>" alt="<?php echo get_option('Pasw_Logo_alt'); ?>"  width="<?php echo $width; ?>" height="<?php echo $height; ?>" />
									</td>
								</tr>
								<tr valign="top">
									<th scope="row"><label for="logo_alt">Logo ALT Text</label></th>
									<td>
										<input name="Logo_alt" type="text" id="logo_alt" value="<?php echo get_option('Pasw_Logo_alt'); ?>" class="regular-text" style="width:60em;"/>
									</td>
								</tr>
						 	</table>
							
							<p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Logo" />
								<input type="hidden" name="Passwd_Impostazioni_logo" value="save" style="display:none;" />
								</p>
						</form>	
					 </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->
	
	            <h3 class="rwd-toggle"><a href="#">Stile</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block">
	          	      <div class="grid">
						<form method="post" action="" name="opzioni">
							<table class="form-table">	
						    	<tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Seleziona lo Stile del tema, devi selezionare una delle combinazioni di colori che ti vengono proposti
										</label>
									</th>
									<td>
										<select name="Stile" id="Stile">	
								<?php	
								    $ElencoStili=elencafiles(get_theme_root().'/'.get_template().'/','css');
									foreach($ElencoStili as $Stile){
										echo '<option value="'.$Stile.'"';
										if (get_option("Pasw_Stile")==$Stile) 
											echo 'selected="selected"';
										echo ' >'.basename($Stile,".css").'</option>';		
									}
								?>
										</select> 
									</td>
								</tr>
						        </table>
							 <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Stile" />
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
							</p>
						</form>	
					  </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->

	            <h3 class="rwd-toggle"><a href="#">Social</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block">
	          	      <div class="grid">
						<form method="post" action="" name="opzioni">
							<table class="form-table">	
						    	<tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Vuoi inserire i pulsanti social?<br />
											Twitter - Facebook - Google +
										</label>
									</th>
									<td>
										<input type="checkbox" value="1" name="social"
										<?php if (get_option("Pasw_Social")==1) 
											echo 'checked="checked"';?>
											</input>
									</td>
								</tr>
						        </table>
							 <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Social" />
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
							</p>
						</form>	
					  </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->


	            <h3 class="rwd-toggle"><a href="#">Testa</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block">
	          	      <div class="grid">
						<form method="post" action="" name="opzioni">
								<table class="form-table">	
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Testo da visualizzare accanto al logo con i dati della scuola
										</label>
									</th>
									<td>
					<?php wp_editor( stripslashes(get_option('Pasw_Testa')), 'testa_text',
					array('textarea_name' => 'Testa',
						  'textarea_rows' => 8,
						  'teeny' => false,
						  'media_buttons' => false,
						  'tinymce' => array( 'theme_advanced_buttons1' => "bold,italic,abbr,acronym",
						  'theme_advanced_buttons2' =>  "")
						  )
						);?>
									</td>
								</tr>
						        </table>
							 <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Testa" />
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
							</p>
						</form>	
					  </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->
            
	            <h3 class="rwd-toggle"><a href="#">Piede</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block">
	          	      <div class="grid">
						<form method="post" action="">
								<table class="form-table">	
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Testo da visualizzare nel piede delle pagine
										</label>
									</th>
									<td>
				<?php wp_editor( stripslashes(get_option('Pasw_Piede')), 'piede_text',
					array('textarea_name' => 'Piede',
						  'textarea_rows' => 8,
						  'teeny' => false,
						  'media_buttons' => false,
						  'tinymce' => array( 'theme_advanced_buttons1' => "bold,italic,abbr,acronym",
						  'theme_advanced_buttons2' =>  "")
						  )
						);?>
									</td>
								</tr>
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Autore
										</label>
									</th>
									<td>
										<input name="Autore" type="text" id="Autore" value="<?php echo get_option('Pasw_Autore'); ?>" class="regular-text" style="width:40em;"/>				
									</td>
								</tr>
						        </table>
							 <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Piede" />
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
							</p>
						</form>	
					  </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->

	            <h3 class="rwd-toggle"><a href="#">Impostazione Home Page</a></h3>
	            <div class="rwd-container">
	                <div class="rwd-block">
	          	      <div class="grid">
						<form method="post" action="">
								<table class="form-table">	
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Categoria In Evidenza
										</label>
									</th>
									<td>
									<?php wp_dropdown_categories('orderby=name&hide_empty=0&name=CategoriaInEvidenza&id=InEvidenza&selected='.get_option('Pasw_InEvidenza'));?>
									</td>
								</tr>
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Categoria Comunicazioni
										</label>
									</th>
									<td>
									<?php wp_dropdown_categories('orderby=name&hide_empty=0&name=CategoriaComunicazioni&id=Comunicazioni&selected='.get_option('Pasw_Comunicazioni'));?>
									</td>
								</tr>
						         <tr valign="top">
									<th scope="row">
										<label for="contact_text">
											Categoria Home Sinistra
										</label>
									</th>
									<td>
									<?php wp_dropdown_categories('orderby=name&hide_empty=0&name=CategoriaHomeSinistra&id=home&show_option_none=Non Definita&selected='.get_option('Pasw_CatHomeSinistra'));?>
									</td>
								</tr>
						        </table>
							 <p class="submit">
								<input type="submit" name="Submit" class="button-primary" value="Memorizza Modifiche Categorie Home Page" />
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
							</p>
						</form>	
					  </div>
	                </div><!-- end of .rwd-block -->
	            </div><!-- end of .rwd-container -->

				<h3 class="rwd-toggle" id="HB"><a href="#">Articoli Home Page Colonna di Sinistra</a></h3>
	            <div class="rwd-container" id="contenitoreRp">
	                <div class="rwd-block">
				        <div class="grid" id="datiHomeBoxes">
<?php
global $wpdb,$table_prefix;
	$ElencoPost=get_option('Pasw_HomeBoxes');
?>
							<form method="post" action="">
								<input type="hidden" name="Passwd_Impostazioni" value="save" style="display:none;" />
								<input type="hidden" id="oldpost" name="oldpost" value="<?php echo $ElencoPost;?>" style="display:none;" />
								<div id="bloccoSx">
						        	<h3>Articoli disponibili</h3>
						        	<div id="bloccoSxlista">
									<ul id="ArticoliDisp"> 
<?php
	$args = array(
  		'post__not_in' =>  explode(",",$ElencoPost),
  		'cat' => get_option ( 'Pasw_CatHomeSinistra')
	);
	//$query = new WP_Query("cat=".get_option ( 'Pasw_CatHomeSinistra').'&post__not_in, );
	$query = new WP_Query($args);
	while( $query->have_posts() ) : $query->the_post();
		echo '<li id='.get_the_ID().">".the_title('','',false)."</li>";    
	endwhile;
	wp_reset_postdata();	

?>						</ul>
					</div>						    

					</div>
					<div id="bloccoDx">
						<h3>Articoli Inseriti<img src="<?php echo bloginfo('url');?>/wp-admin/images/loading.gif" id="loading-animation" /></h3>
   						<ul id="post-list">	
<?php
	if(strlen($ElencoPost)>0){
		$ElencoPost=explode(",", $ElencoPost);
		foreach ($ElencoPost as $Post){
			echo '<li id='.$Post.'>'.get_the_title($Post).'</li>';
		}
	}
?>
						</ul>
					</form>
						</div>
					</div>
				</div><!-- end of .rwd-block -->
            </div><!-- end of .rwd-container -->
	            			



			</div><!-- end of .grid-->
    </div><!-- end of .wrap-->

<div style="clear:both;"></div>


    <?php
}