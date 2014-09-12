<?php

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
						if ($get_pasw_fluid_layout == '1') { echo 'checked="checked" '; } ?>><label for="fluid">layout allargato (fluido)</label>
					<ul>
						<li><a href="themes.php?page=custom-background" class="welcome-icon welcome-view-site">Cambia immagine o colore di sfondo</a></li>
					</ul>
					</div>
					<div class="welcome-panel-column">
						
					</div>
					<div class="welcome-panel-column welcome-panel-last">
						
					</div>
				</div>
			</div>
		</div>

		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>Header</h3>
				<p class="about-description">Personalizza la testata del tuo sito istituzionale</p>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
					
					</div>
					<div class="welcome-panel-column">
						<h4>Indirizzo Scuola</h4>
						<ul>
							<li><a href="http://127.0.0.1/pasw2015beta/wp-admin/post.php?post=5&amp;action=edit" class="welcome-icon welcome-edit-page">Modifica la descrizione del sito</a></li>
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
				<h3>Informazioni sul Sito</h3>
				<p class="about-description">Pasw 2015 è progettato per mostrare automaticamente alcuni dati.</p>
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

		<div id="welcome-panel" class="welcome-panel">
			<div class="welcome-panel-content">
				<h3>Social</h3>
				<div class="welcome-panel-column-container">
					<div class="welcome-panel-column">
						<h4>Pulsanti</h4>

						<th><label>Abilita Pulsanti Sociali</label></th>
						<td><input type="checkbox" name="pasw2015_socialbuttons_n"
						<?php $get_pasw2015_socialbuttons = get_option('pasw2015_socialbuttons');
							if ($get_pasw2015_socialbuttons == '1') {
								echo 'checked="checked" ';
							}
						?>'></td><span class="description">Facebook, Twitter, Google+</span>
					
					</div>
				</div>
			</div>
		</div>

		<p class="submit"><input type="submit" class="button-primary" name="Submit" value="Salva Impostazioni" /></p>
		</form>

	</div>

<?php }

?>