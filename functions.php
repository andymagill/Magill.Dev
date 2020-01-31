<?php
/*
 *  Author: Andrew Magill andrew@magill.dev
 *  Description: based on html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

class magillDev {

	// get class name as theme name
	private $theme = '';

	function __construct() {
		add_action('after_setup_theme', array($this, 'init'));

		// Enqueue scripts and styles
		add_action('init' , array($this, 'enqueue_header_scripts'));
		add_action('wp_print_scripts', array($this, 'enqueue_conditional_scripts'));
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
		add_action('wp_enqueue_scripts', array($this, 'replace_core_jquery_version') );

		// Remove injected classes
		add_filter('nav_menu_css_class', array($this, 'filter_menu'), 100, 1);
		add_filter('nav_menu_item_id', array($this, 'filter_menu'), 100, 1);
		add_filter('page_css_class', array($this, 'filter_menu'), 100, 1);

		// Add slug to body class
		add_filter('body_class', array($this, 'add_page_name_class'));

		// Remove Admin bar for non-admins
		add_filter('after_setup_theme', array($this, 'hide_admin_bar'));

	}

	function init() {
		$theme = get_class($this);

		$this->enable_theme_support();
		$this->register_menu_locations();
		$this->register_sidebar_areas();
	}

	// Theme support
	function enable_theme_support() {

		if (function_exists('add_theme_support'))
		{
			add_theme_support('title-tag');
			add_theme_support('menus');
			add_theme_support('post-thumbnails');
		}
	}

	// Register Navigation
	function register_menu_locations() {

		register_nav_menus( array(
			'header-menu' => __('Header Menu', $theme), // Main Navigation
			'middle-menu' => __('Middle Menu', $theme),
			'sidebar-menu' => __('Sidebar Menu', $theme), // Sidebar Navigation
			'footer-menu' => __('Footer Menu', $theme)
		));
	}

	// Register Navigation
	function register_sidebar_areas() {

		// If Dynamic Sidebar Exists
		if (function_exists('register_sidebar'))
		{
			// Define Sidebar Widget Area
			register_sidebar(array(
				'name' => __('Sidebar', $theme),
				'description' => __('Sidebar widget area', $theme),
				'id' => 'sidebar',
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));
		}
	}


/*------------------------------------*\
	Action callbacks
\*------------------------------------*/

	// Load styles
	function enqueue_styles()
	{
		wp_register_style('theme-styles', get_theme_file_uri() . '/assets/css/styles.css', array(), '0.011', 'all');
		wp_enqueue_style('theme-styles');

		// google fonts
		wp_register_style('google-fonts', 'https://fonts.googleapis.com/css?family=Poppins:200,300,600|Merriweather:400,700&display=swap', array());
		wp_enqueue_style('google-fonts');

		// font awesome
		wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css', array());
		wp_enqueue_style('font-awesome');
	}

	// Load scripts
	function enqueue_header_scripts() {

		if ($GLOBALS['pagenow'] == 'wp-login.php' || is_admin()) {

			// admin JS
			wp_register_script('admin-scripts', get_theme_file_uri() . '/assets/js/admin-scripts.js', array('jquery'), '0.01'); // Custom scripts
			wp_enqueue_script('scripts'); // Enqueue it!

		}
		else {

			// main js file
			wp_register_script('theme-scripts', get_theme_file_uri() . '/assets/js/scripts.min.js', array('jquery'), '0.01');
			wp_enqueue_script('theme-scripts');
		}
	}

	// Load conditional scripts
	function enqueue_conditional_scripts()
	{
		// if (is_page('pagenamehere')) {
		// 	wp_register_script('scriptname', get_theme_file_uri() . '/assets/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
		// 	wp_enqueue_script('scriptname');
		// }
	}

	function replace_core_jquery_version() {
	    wp_deregister_script( 'jquery-core' );
	    wp_register_script( 'jquery-core', "https://code.jquery.com/jquery-3.1.1.min.js", array(), '3.1.1' );
	    wp_deregister_script( 'jquery-migrate' );
	    wp_register_script( 'jquery-migrate', "https://code.jquery.com/jquery-migrate-3.0.0.min.js", array(), '3.0.0' );
	}

	/*------------------------------------*\
			Filter callbacks
	\*------------------------------------*/

	// Remove Injected classes, ID's and Page ID's from Navigation <li> items
	function filter_menu( $var ) {

		if ( is_array( $var ) ) {

			foreach ( $var as $key => $val ) {
				if ( strpos( $val, 'item' ) > -1 && $val != 'current-menu-item' ) {
					unset( $var[$key] );
				}
			}
			return $var;
		}
		else {
			return '';
		}
	}

	// Add page name to body classes
	function add_page_name_class($classes)
	{
		global $post;
		if ( is_page() || is_singular() ) {
			$classes[] = sanitize_html_class($post->post_name);
		}
		return $classes;
	}

	// show Admin bar for admins only
	function hide_admin_bar()
	{
		if (!current_user_can('administrator') && !is_admin()) {
		  //show_admin_bar(false);
		}
		show_admin_bar(false);
	}

	/*------------------------------------*\
			Utility methods
	\*------------------------------------*/

	// Render menu markup
	function render_menus($menu, $class) {

		if ( has_nav_menu($menu) ) {
		?>
			<nav class="nav <?= $class; ?>" role="navigation">
				<?php wp_nav_menu(
					array(
						'theme_location'  => $menu ,
						'container'  => '' ,
						'link_before'  => '<span>' ,
						'link_after'  => '</span>' ,
					)
				); ?>
			</nav>
			<!-- /nav -->
		<?php
		}
	}
}

// create theme object
$magillDev = new magillDev();

// expose theme object via function
function magillDev() {
	global $magillDev;
	return $magillDev;
}


/*------------------------------------*\
	Functions
\*------------------------------------*/



// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
	global $wp_widget_factory;
	remove_action('wp_head', array(
		$wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
		'recent_comments_style'
	));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function magillDev_pagination()
{
	global $wp_query;
	$big = 999999999;
	echo paginate_links(array(
		'base' => str_replace($big, '%#%', get_pagenum_link($big)),
		'format' => '?paged=%#%',
		'current' => max(1, get_query_var('paged')),
		'total' => $wp_query->max_num_pages
	));
}

// Custom Excerpts
function magillDev_index($length) // Create 20 Word Callback for Index page Excerpts, call using magillDev_excerpt('magillDev_index');
{
	return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using magillDev_excerpt('magillDev_custom_post');
function magillDev_custom_post($length)
{
	return 40;
}

// Create the Custom Excerpts callback
function magillDev_excerpt($length_callback = '', $more_callback = '')
{
	global $post;
	if (function_exists($length_callback)) {
		add_filter('excerpt_length', $length_callback);
	}
	if (function_exists($more_callback)) {
		add_filter('excerpt_more', $more_callback);
	}
	$output = get_the_excerpt();
	$output = apply_filters('wptexturize', $output);
	$output = apply_filters('convert_chars', $output);
	$output = '<p>' . $output . '</p>';
	echo $output;
}


// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
	$html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
	return $html;
}

// Threaded Comments
function enable_threaded_comments()
{
	if (!is_admin()) {
		if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script('comment-reply');
		}
	}
}
function dmcg_allow_nbsp_in_tinymce( $init ) {
    $init['entities'] = '160,nbsp,38,amp,60,lt,62,gt';
    $init['entity_encoding'] = 'named';
    return $init;
}

/**
* Remove ‘hentry’ from post_class()
*/
function magillDev_remove_hentry( $class ) {
	$class = array_diff( $class, array( 'hentry' ) );
	return $class;
}

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/
add_filter( 'tiny_mce_before_init', 'dmcg_allow_nbsp_in_tinymce' );
/**
* Remove ‘hentry’ from post_class()
*/
add_filter( 'post_class', 'magillDev_remove_hentry' );
// Add Actions
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
//add_action('init', 'magillDev_register_menus'); // Add menu locations
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'magillDev_pagination'); // Add Pagination


// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Remove the XHTML generator
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
//remove oembed tags
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');
// Add Filters
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)

add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// excerpts
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)

?>
