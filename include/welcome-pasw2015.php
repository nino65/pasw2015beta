<?php

add_action('admin_menu', 'pasw2015_menu');

function pasw2015_menu() {
	require ( get_template_directory() . '/include/impostazioni-pasw2015.php' );

	add_menu_page('WordPress PASW 2015', 'Pasw 2015', 'manage_options', 'pasw2015', 'pasw2015_welcome', 'dashicons-screenoptions', 40);
	add_submenu_page('pasw2015', 'Supporto', 'Supporto', 'manage_options', 'pasw2015-supporto', 'pasw2015_supporto' );
	add_submenu_page('pasw2015', 'Plugin Consigliati', 'Plugin Consigliati', 'manage_options', 'pasw2015-plugin', 'pasw2015_plugin' );
	add_submenu_page('pasw2015', 'Impostazioni', 'Impostazioni', 'manage_options', 'pasw2015-impostazioni', 'pasw2015_impostazioni' );
}

function pasw2015_welcome() { ?>
	<div class="wrap about-wrap">
		<h1>Benvenuto in Pasw 2015</h1>
		<div class="about-text">Pasw2015 è il nuovo tema realizzato dalla Comunità di Pratica Porte Aperte sul Web.
		<br/>Bello, accessibile e innovativo.</div>
		<div class="wp-badge">Pasw2015 
		<?php echo get_option('pasw2015_version') . '<br/>';
		$filename = get_theme_root() . '/pasw2015beta/style.css';
		if (file_exists($filename)) {
    		echo date ("d M Y", filemtime($filename));
		}
   		?></div>
		<ul class="wp-people-group " id="wp-people-group-project-leaders">
<li class="wp-person" id="wp-person-matt">
	<a href="http://profiles.wordpress.org/matt"><img src="http://0.gravatar.com/avatar/767fc9c115a1b989744c755db47feb60?s=60" class="gravatar" alt="Matt Mullenweg"></a>
	<a class="web" href="http://profiles.wordpress.org/matt">Alberto Ardizzone</a>
	<span class="title">Cofounder, Project Lead</span>
</li>
<li class="wp-person" id="wp-person-nacin">
	<a href="http://profiles.wordpress.org/nacin"><img src="http://www.gravatar.com/avatar/f73d67c77f89c70ef303588aeab44ceb.jpg?s=60" class="gravatar" alt="Andrew Nacin"></a>
	<a class="web" href="http://profiles.wordpress.org/nacin">Ignazio Scimone</a>
	<span class="title">Lead Developer</span>
</li>
<li class="wp-person" id="wp-person-westi">
	<a href="http://marcomilesi.ml"><img src="http://www.gravatar.com/avatar/c70b8e378aa035f77ab7a3ddee83b892.jpg?s=60" class="gravatar" alt="Marco Milesi"></a>
	<a class="web" href="http://marcomilesi.ml">Marco Milesi</a>
	<span class="title">San Pellegrino Terme</span>
</li>
<li class="wp-person" id="wp-person-ryan">
	<a href="http://profiles.wordpress.org/ryan"><img src="http://0.gravatar.com/avatar/c22398fb9602c967d1dac8174f4a1a4e?s=60" class="gravatar" alt="Ryan Boren"></a>
	<a class="web" href="http://profiles.wordpress.org/ryan">Renata Durighello</a>
	<span class="title">Lead Developer</span>
</li>
<li class="wp-person" id="wp-person-azaozz">
	<a href="http://profiles.wordpress.org/azaozz"><img src="http://0.gravatar.com/avatar/4e84843ebff0918d72ade21c6ee7b1e4?s=60" class="gravatar" alt="Andrew Ozz"></a>
	<a class="web" href="http://profiles.wordpress.org/azaozz">Andrew Ozz</a>
	<span class="title">Lead Developer</span>
</li>
<li class="wp-person" id="wp-person-markjaquith">
	<a href="http://profiles.wordpress.org/markjaquith"><img src="http://0.gravatar.com/avatar/097a87a525e317519b5ee124820012fb?s=60" class="gravatar" alt="Mark Jaquith"></a>
	<a class="web" href="http://profiles.wordpress.org/markjaquith">Mark Jaquith</a>
	<span class="title">Lead Developer</span>
</li>
</ul>
		<h2 class="nav-tab-wrapper">
			<a href="about.php" class="nav-tab">
				Novità	</a><a href="credits.php" class="nav-tab nav-tab-active">
				Crediti	</a><a href="freedoms.php" class="nav-tab">
				Freedoms	</a>
		</h2>
	</div>
<?php }

?>