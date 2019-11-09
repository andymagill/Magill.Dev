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

		// Register action callbacks
		add_action('init' , array($this, 'enqueue_header_scripts')); // Add Custom Scripts to wp_head
		add_action('wp_print_scripts', array($this, 'enqueue_conditional_scripts')); // Add Conditional Page Scripts
		add_action('wp_enqueue_scripts', array($this, 'enqueue_styles')); // Add Theme Stylesheet

		// Register filter callbacks
	}

	function init() {
		$theme = get_class($this);

		$this->register_menu_locations();
		$this->register_sidebar_areas();
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
			// Define Sidebar Widget Area 1
			register_sidebar(array(
				'name' => __('Widget Area 1', $theme),
				'description' => __('Description for this widget-area...', $theme),
				'id' => 'widget-area-1',
				'before_widget' => '<div id="%1$s" class="%2$s">',
				'after_widget' => '</div>',
				'before_title' => '<h3>',
				'after_title' => '</h3>'
			));

			// Define Sidebar Widget Area 2
			register_sidebar(array(
				'name' => __('Widget Area 2', $theme),
				'description' => __('Description for this widget-area...', $theme),
				'id' => 'widget-area-2',
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

	// Load scripts
	function enqueue_header_scripts() {

		if ($GLOBALS['pagenow'] == 'wp-login.php' || is_admin()) {

			// admin JS
			wp_register_script('admin-scripts', get_theme_file_uri() . '/assets/js/admin-scripts.js', array('jquery'), '0.01'); // Custom scripts
			wp_enqueue_script('scripts'); // Enqueue it!

		}
		else {

			// main js file
			wp_register_script('theme-scripts', get_theme_file_uri() . '/assets/js/scripts.js', array('jquery'), '0.01');
			wp_enqueue_script('theme-scripts');

			// jquery
			// wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1');
			// wp_enqueue_script('jquery');

			// jquery validate
			wp_register_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js', array(), '1.15');
			wp_enqueue_script('jquery-validate');

			// google fonts
			wp_register_script('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400|Roboto+Slab:300,400', array(), '0.01');
			wp_enqueue_script('google-fonts');
		}
	}

	// Load conditional scripts
	function enqueue_conditional_scripts()
	{
		if (is_page('pagenamehere')) {
			wp_register_script('scriptname', get_theme_file_uri() . '/assets/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
			wp_enqueue_script('scriptname');
		}
	}

	// Load styles
	function enqueue_styles()
	{
		wp_register_style('theme-styles', get_theme_file_uri() . '/assets/css/styles.css', array(), '0.01', 'all');
		wp_enqueue_style('theme-styles');
	}


	/*------------------------------------*\
			Filter callbacks
	\*------------------------------------*/


	/*------------------------------------*\
			Utility methods
	\*------------------------------------*/

	// Render menu markup
	function render_menus($menu) {

		if ( has_nav_menu($menu) ) {
		?>
			<nav class="nav" role="navigation">
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
	External Modules/Files
\*------------------------------------*/

//include 'inc/enqueue.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
	$content_width = 900;
}

if (function_exists('add_theme_support'))
{
	// Add Menu Support
	add_theme_support('menus');

	// Add Thumbnail Theme Support
	add_theme_support('post-thumbnails');
	add_image_size('large', 700, '', true); // Large Thumbnail
	add_image_size('medium', 250, '', true); // Medium Thumbnail
	add_image_size('small', 120, '', true); // Small Thumbnail
	add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

	// Add Support for Custom Backgrounds - Uncomment below if you're going to use
	/*add_theme_support('custom-background', array(
	'default-color' => 'FFF',
	'default-image' => get_theme_file_uri() . '/img/bg.jpg'
	));*/

	// Add Support for Custom Header - Uncomment below if you're going to use
	/*add_theme_support('custom-header', array(
	'default-image'			=> get_theme_file_uri() . '/img/headers/default.jpg',
	'header-text'			=> false,
	'default-text-color'		=> '000',
	'width'				=> 1000,
	'height'			=> 198,
	'random-default'		=> false,
	'wp-head-callback'		=> $wphead_cb,
	'admin-head-callback'		=> $adminhead_cb,
	'admin-preview-callback'	=> $adminpreview_cb
	));*/

	// Enables post and comment RSS feed links to head
	//add_theme_support('automatic-feed-links');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/




// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function magillDev_filter_menu( $var ) {

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

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
	return str_replace('rel="category tag"', 'rel="tag"', $thelist);
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

// show Admin bar for admins
function magillDev_show_admin_bar()
{
	if( current_user_can('administrator') ) {
		return true;
	}
	else {
		return false;
	}
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

// Custom Comments Callback
function magillDev_comments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<!-- heads up: starting < for the html tag (li or div) in the next line: -->
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }


/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
//add_action('init', 'magillDev_register_menus'); // Add menu locations
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'magillDev_pagination'); // Add Pagination

add_filter('nav_menu_css_class', 'magillDev_filter_menu', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
add_filter('nav_menu_item_id', 'magillDev_filter_menu', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
add_filter('page_css_class', 'magillDev_filter_menu', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)

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

// Add Filters
add_filter('body_class', 'add_page_name_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)

add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('show_admin_bar', 'magillDev_show_admin_bar'); // Remove Admin bar
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


?>
