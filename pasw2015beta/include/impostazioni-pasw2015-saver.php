<?php
	if(isset($_POST['Submit'])) { //Salvataggio Impostazioni
		$get_avcp_denominazione_ente = $_POST["avcp_denominazione_ente_n"];
        update_option( 'avcp_denominazione_ente', $get_avcp_denominazione_ente );
		$get_avcp_codicefiscale_ente = $_POST["avcp_codicefiscale_ente_n"];
        update_option( 'avcp_codicefiscale_ente', $get_avcp_codicefiscale_ente );


        // INFO SITO
        update_option( 'pasw_autore', $_POST["pasw_autore_n"] );
        update_option( 'pasw_recapito_scuola', $_POST["pasw_recapito_scuola_n"] );
        update_option( 'pasw_email_scuola', $_POST["pasw_email_scuola_n"] );
        update_option( 'pasw_indirizzo_scuola', $_POST["pasw_indirizzo_scuola_n"] );
        update_option( 'pasw_loghi_footer', htmlentities(stripslashes($_POST["pasw_loghi_footer_n"])) );

        $get_recapito_scuola = $_POST["pasw_recapito_scuola_n"];
        update_option( 'pasw_recapito_scuola', $get_recapito_scuola );

		if (isset($_POST['pasw2015_socialbuttons_n'])){
				update_option('pasw2015_socialbuttons', '1');
			} else {
				update_option('pasw2015_socialbuttons', '0');
		}

		if (isset($_POST['pasw_fluid_layout_n'])){
				update_option('pasw_fluid_layout', '1');
			} else {
				update_option('pasw_fluid_layout', '0');
		}

	}
?>