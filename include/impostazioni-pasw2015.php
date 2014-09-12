<?php

add_action('admin_enqueue_scripts', 'pasw2015_upload_admin_scripts');
 
function pasw2015_upload_admin_scripts() {
    if (isset($_GET['page']) && $_GET['page'] == 'pasw2015-impostazioni') {
        wp_enqueue_media();
        wp_register_script('pasw2015-upload-admin-js', get_template_directory_uri() . '/js/uploader.js', array('jquery'));
        wp_enqueue_script('pasw2015-upload-admin-js');
    }
}

function pasw2015_impostazioni() { ?>
	<div class="wrap">
		<h2>Impostazioni <a href="" class="add-new-h2">Pagina di Benvenuto</a> <a href="" class="add-new-h2">Supporto</a> <a href="" class="add-new-h2">Porte Aperte sul Web</a></h2>
			
			<?php require ( get_template_directory() . '/include/impostazioni-pasw2015-saver.php' ); ?>

			<form method="post" name="options" target="_self">
			<?php wp_nonce_field('update-options') ?>

		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>Generali</h3>
				<p class="about-description">Personalizza l'aspetto del sito</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Stile</h4>
						
						<input id="fluid" type="checkbox" name="pasw_fluid_layout_n"
						<?php $get_pasw_fluid_layout = get_option('pasw_fluid_layout');
						if ($get_pasw_fluid_layout == '1') { echo ' checked="checked" '; } ?>><label for="fluid">layout allargato (fluido)</label>
					<ul>
						<li><a href="themes.php?page=custom-background" class="welcome-icon welcome-view-site">Cambia immagine o colore di sfondo</a></li>
					</ul>
					</div>
					<div class="welcome-panel-column">
						<h4>Social</h4>
						
						<input id="social" type="checkbox" name="pasw_social_n"
						<?php $get_pasw_social = get_option('pasw_social');
						if ($get_pasw_social == '1') { echo ' checked="checked" '; }?>><label for="social">Abilita Pulsanti Sociali</label>

					</div>
					<div class="welcome-panel-column welcome-panel-last">
						
					</div>
				</div>
			</div>
		</div>

		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>Header</h3>
				<p class="about-description">Personalizza la <strong>testata</strong> di <?php bloginfo('name'); ?>.</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Logo</h4>
						<label for="upload_image">
						    <input id="pasw_logo_n" type="text" size="36" name="pasw_logo_n" value="<?php if (get_option('pasw_logo') != '') { echo get_option('pasw_logo'); } else { echo 'http://'; } ?>" /> 
						    <input id="pasw_logo_upload" class="button" type="button" value="Carica" />
						    <br />Inserisci un URL o carica un'immagine
						</label>
					</div>
					<div class="welcome-panel-column">
						<h4></h4>
						<ul>
							<li><a href="options-general.php" class="welcome-icon welcome-edit-page">Modifica il titolo o la descrizione del sito</a></li>
							<li><a href="themes.php?page=custom-header" class="welcome-icon welcome-view-site">Cambia immagine o colore della testata</a></li>
						</ul>	
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						<h4>Loghi Footer</h4>
						<textarea name="pasw_loghi_footer_n">
						<?php echo html_entity_decode(get_option('pasw_loghi_footer')); ?></textarea>
					</div>
				</div>
			</div>
		</div>

		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>Footer</h3>
				<p class="about-description">Personalizza il <strong>piede</strong> di <?php bloginfo('name'); ?>.</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Autore</h4>

						<label for="author">webmaster:</label>
						<input id="author" type="text" name="pasw_autore_n" value="<?php echo get_option('pasw_autore'); ?>" class="regular-text">


					</div>
					<div class="welcome-panel-column">
						<h4>Info Scuola</h4>
						<label for="phone">numero di telefono:</label>
						<input id="phone" type="text" name="pasw_recapito_scuola_n" value="<?php echo get_option('pasw_recapito_scuola'); ?>" class="regular-text">
						<label for="address">indirizzo:</label>
						<input id="address" type="text" name="pasw_indirizzo_scuola_n" value="<?php echo get_option('pasw_indirizzo_scuola'); ?>" class="regular-text">
						<label for="email">e-mail:</label>
						<input id="email" type="text" name="pasw_email_scuola_n" value="<?php echo get_option('pasw_email_scuola'); ?>" class="regular-text">
					</div>
				</div>
			</div>
		</div>

		<p class="submit"><input type="submit" class="button-primary" name="Submit" value="Salva Impostazioni" /></p>
		</form>

	</div>

<?php }

?>