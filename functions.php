<?php

/*-----------------------------------------------------------------------------------*/
/* Start WooThemes Functions - Please refrain from editing this section */
/*-----------------------------------------------------------------------------------*/

// Set path to WooFramework and theme specific functions
$functions_path = get_template_directory() . '/functions/';
$includes_path = get_template_directory() . '/includes/';

// Don't load alt stylesheet from WooFramework
if ( ! function_exists( 'woo_output_alt_stylesheet' ) ) {
	function woo_output_alt_stylesheet () {}
}

// Define the theme-specific key to be sent to PressTrends.
define( 'WOO_PRESSTRENDS_THEMEKEY', 'tnla49pj66y028vef95h2oqhkir0tf3jr' );

// WooFramework
require_once ( $functions_path . 'admin-init.php' );	// Framework Init

if ( get_option( 'woo_woo_tumblog_switch' ) == 'true' ) {
	//Enable Tumblog Functionality and theme is upgraded
	update_option( 'woo_needs_tumblog_upgrade', 'false' );
	update_option( 'tumblog_woo_tumblog_upgraded', 'true' );
	update_option( 'tumblog_woo_tumblog_upgraded_posts_done', 'true' );
	require_once ( $functions_path . 'admin-tumblog-quickpress.php' );  // Tumblog Dashboard Functionality 
}

/*-----------------------------------------------------------------------------------*/
/* Load the theme-specific files, with support for overriding via a child theme.
/*-----------------------------------------------------------------------------------*/

$includes = array(
				'includes/theme-options.php', 			// Options panel settings and custom settings
				'includes/theme-functions.php', 		// Custom theme functions
				'includes/theme-actions.php', 			// Theme actions & user defined hooks
				'includes/theme-comments.php', 			// Custom comments/pingback loop
				'includes/theme-js.php', 				// Load JavaScript via wp_enqueue_script
				'includes/sidebar-init.php', 			// Initialize widgetized areas
				'includes/theme-widgets.php',			// Theme widgets
				'includes/theme-advanced.php',			// Advanced Theme Functions
				'includes/theme-shortcodes.php',	 	// Custom theme shortcodes
				'includes/woo-layout/woo-layout.php',	// Layout Manager
				'includes/woo-meta/woo-meta.php',		// Meta Manager
				'includes/woo-hooks/woo-hooks.php'		// Hook Manager
				);

// Allow child themes/plugins to add widgets to be loaded.
$includes = apply_filters( 'woo_includes', $includes );

foreach ( $includes as $i ) {
	locate_template( $i, true );
}

// Load WooCommerce functions, if applicable.
if ( is_woocommerce_activated() ) {
	locate_template( 'includes/theme-woocommerce.php', true );
}

/*-----------------------------------------------------------------------------------*/
/* You can add custom functions below */
/*-----------------------------------------------------------------------------------*/

// Add header container
add_action( 'woo_header_before', 'header_container_start' );
function header_container_start() { ?>
	<div id="jefferson-header">
		<div id="main-logo">
    		<a class="logohref" href="http://www.jeffersonhospital.org/" title="Home"><img alt="Jefferson University Hospitals" src="http://blogs.jeffersonhospital.org/assets/logo.png" /></a>
    	</div>
    	<div id="jeff-blog-logo">
    		<span id="jeff-blog-title">
    			<a href="http://blogs.jeffersonhospital.org/atjeff"><img src="/wp-content/themes/JeffCanvas/images/at-jeff.png" alt="@ Jeff logo" /></a>
    		</span>
    	</div>
    	<div class="fix"></div>
	</div>
	<div id="app-form">
		<div class="form">
			<script type="text/javascript" src="http://as00.estara.com/as/InitiateCall2.php?accountid=200106297953"></script>
			<ul>
				<li><a class="click-to-call" href="javascript:webVoicePop('Template=725299');">Click to call JEFF NOW&reg;</a></li>
				<li><a class="appointment" href="https://appointments.jeffersonhospital.org/">Request an appointment online</a></li>
				<li><a class="refer" href="http://www.jeffersonhospital.org/healthcare-professionals/physicians/refer-patient.aspx">Refer a Patient</a></li>
			</ul>
		</div>
		<a class="app-link" href="#">Appointments and Referrals</a>
	</div>
	<script>
		jQuery('.app-link').click(function() {
  			jQuery('.form').slideToggle('fast');
  			jQuery('.app-link').toggleClass('app-link-clicked');
  		});
	</script>

<?php	
}
add_action( 'woo_header_after', 'header_container_end', 8 );
function header_container_end() {}


// Add search to navbar
// Reference: http://www.woothemes.com/tutorials/adding-a-search-box-to-the-primary-navigation-in-canvas/
add_action( 'woo_nav_inside', 'woo_custom_add_searchform', 10 );
 
function woo_custom_add_searchform () {
    echo '<div id="nav-search" class="nav-search fr">' . "
";
    get_template_part( 'search', 'form' );
    // get_search_form(); // wordpress default search

    echo '</div><!--/#nav-search .nav-search fr-->' . "
";
} // End woo_custom_add_searchform()

// Remove website from comments form
// Reference: http://www.woothemes.com/tutorials/modify-default-comment-form-fields-in-canvas/
add_filter( 'comment_form_default_fields', 'woo_custom_comment_form_fields', 20 );
 
function woo_custom_comment_form_fields ( $fields ) {
 
    $commenter = wp_get_current_commenter();
 
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
 
        $fields =  array(
            'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" class="txt" tabindex="1" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' />' .
                        '<label for="author">' . __( 'Your Name', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>',
            'email'  => '<p class="comment-form-email"><input id="email" name="email" type="text" class="txt" tabindex="2" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />' .
                        '<label for="email">' . __( 'Your E-mail (will not be published)', 'woothemes' ) . ( $req ? ' <span class="required">(' . __( 'required', 'woothemes' ) . ')</span>' : '' ) . '</label> ' . '</p>'
        );
 
    return $fields;
 
} // End woo_custom_comment_form_fields()

// Make images not link by default
// http://wordpress.org/support/topic/why-are-images-linked-by-default
update_option('image_default_link_type','none');



/*-----------------------------------------------------------------------------------*/
/* Don't add any code below here or the sky will fall down */
/*-----------------------------------------------------------------------------------*/
?>