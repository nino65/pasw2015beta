<?php
	if(isset($_POST['Submit'])) { //Salvataggio Impostazioni

        // INFO SITO
        update_option( 'pasw_autore', $_POST["pasw_autore_n"] );
        update_option( 'pasw_recapito_scuola', $_POST["pasw_recapito_scuola_n"] );
        update_option( 'pasw_email_scuola', $_POST["pasw_email_scuola_n"] );
        update_option( 'pasw_indirizzo_scuola', $_POST["pasw_indirizzo_scuola_n"] );
        update_option( 'pasw_logo', $_POST["pasw_logo_n"] );
        update_option( 'pasw_loghi_footer', htmlentities(stripslashes($_POST["pasw_loghi_footer_n"])) );

        $get_recapito_scuola = $_POST["pasw_recapito_scuola_n"];
        update_option( 'pasw_recapito_scuola', $get_recapito_scuola );

		if (isset($_POST['pasw_social_n'])){
				update_option('pasw_social', '1');
			} else {
				update_option('pasw_social', '0');
		}

		if (isset($_POST['pasw_fluid_layout_n'])){
				update_option('pasw_fluid_layout', '1');
			} else {
				update_option('pasw_fluid_layout', '0');
		}

	}
?>