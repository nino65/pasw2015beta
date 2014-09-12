</div>
<div class="clear"></div>

	<div class="imglinks">
		
		<?php if (get_option('pasw_loghi_footer')!= '') { ?>
		<img src="<?php echo get_template_directory_uri() . '/images/footsep.png'; ?>"><br/>
		<?php echo html_entity_decode(get_option('pasw_loghi_footer')); ?>

		<br/><img src="<?php echo get_template_directory_uri() . '/images/footsep.png'; ?>">
	<div class="clear"></div>
	<?php } ?>

&copy; 2014 <?php bloginfo('name'); ?>
<br/>
<small>
	PEC: codicemecc@pec.istruzione.it - Cod.Mecc. codicemecc - Cod.Fisc. 12 345 678 901<br/>
</small>
</div>

<div id="footer">
	
		<div style="float:right;">
		<?php

		 $menu_name = 'menu-3'; // Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)

		    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $menu_name ] ) ) {
			    $menu = wp_get_nav_menu_object( $locations[ $menu_name ] );

			    $menu_items = wp_get_nav_menu_items($menu->term_id);

			    $i = 0;
			    echo '<p>';
			    foreach ( (array) $menu_items as $key => $menu_item ) {
			    	if ($i++ != 0) {
			    		echo ' &bull; ';
			    	}
			        echo  '<a href="' . $menu_item->url . '">' . $menu_item->title . '</a>';
			    }
			    echo '</p>';
		    }

		?>
		</div>
		<p>Sito realizzato<?php if (get_option('pasw_Autore')) { echo ' da ' . get_option('pasw_Autore'); }?> su modello dalla comunit&agrave; di pratica <a title="Porte Aperte sul Web" href="http://www.porteapertesulweb.it/">Porte aperte sul web</a><font title="PASW2015 v<?php echo get_option('pasw2015_version'); ?>"> <></font>
		</p>
	</p>
</div>
<?php do_action('wp_footer'); ?>
</div>
</body>
</html>