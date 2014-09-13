<?php 

//modifiche
require ( get_template_directory() . '/include/welcome-pasw2015.php' );
require (get_template_directory() . '/github/github-updater.php');

add_action('admin_init', "reg_set_p");

function reg_set_p() {
	register_setting( 'pasw2015_options', 'pasw_social');
	register_setting( 'pasw2015_options', 'pasw_email_scuola');
	register_setting( 'pasw2015_options', 'pasw_recapito_scuola');
	register_setting( 'pasw2015_options', 'pasw_indirizzo_scuola');
	register_setting( 'pasw2015_options', 'pasw_fluid_width');
  register_setting( 'pasw2015_options', 'pasw_loghi_footer');
  register_setting( 'pasw2015_options', 'pasw_logo');

	add_option( 'pasw2015_version');
	if (version_compare(get_option('pasw2015_version'), get_pasw2015_version(), "<")) {
		update_option('pasw2015_version', get_pasw2015_version());
		wp_safe_redirect(admin_url('/admin.php?page=pasw2015', 'http'), 301);
	}
}

function get_pasw2015_version() {
  return wp_get_theme()->get( 'Version' );
}

$defaults = array(
	'default-color'          => 'white',
	'default-image'          => '',
	'default-repeat'         => ''
);
add_theme_support( 'custom-background', $defaults );

$args = array(
	'width'         => 1150,
	'height'        => 125,
	'default-image' => ''
);
add_theme_support( 'custom-header', $args );

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

function pasw2015_widgets_init() {
  register_sidebar( array(
        'name' => 'Barra laterale (SX)',
        'id' => 'sidebar-1',
        'description' => 'Sidebar sinistra del sito web.'
    ) );
    register_sidebar( array(
        'name' => 'Barra laterale (DX)',
        'id' => 'sidebar-2',
        'description' => 'Sidebar destra del sito web.'
    ) );
    register_sidebar( array(
        'name' => 'Sotto home (SX)',
        'id' => 'sidebar-3',
        'description' => 'Area Widget (1) sotto la homepage.'
    ) );
    register_sidebar( array(
        'name' => 'Sotto home (CX)',
        'id' => 'sidebar-4',
        'description' => 'Area Widget (2) sotto la homepage.'
    ) );
    register_sidebar( array(
        'name' => 'Sotto home (DX)',
        'id' => 'sidebar-5',
        'description' => 'Area Widget (3) sotto la homepage.'
    ) );
    register_sidebar( array(
        'name' => 'Home (SX)',
        'id' => 'sidebar-6',
        'description' => 'Area Widget (1) della homepage.'
    ) );
    register_sidebar( array(
        'name' => 'Home (CX)',
        'id' => 'sidebar-7',
        'description' => 'Area Widget (2) della homepage.'
    ) );
    register_sidebar( array(
        'name' => 'Home (SX)',
        'id' => 'sidebar-8',
        'description' => 'Area Widget (3) della homepage.'
    ) );
}
add_action( 'widgets_init', 'pasw2015_widgets_init' );

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
?>