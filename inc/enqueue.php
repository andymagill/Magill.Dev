<?php

// Load scripts (header.php)
function magillDev_header_scripts()
{
	if ($GLOBALS['pagenow'] == 'wp-login.php' || is_admin()) {

		// main JS
		wp_register_script('magillDev_scripts', get_theme_file_uri() . '/assets/js/admin-scripts.js', array('jquery'), '0.01'); // Custom scripts
		wp_enqueue_script('magillDev_scripts'); // Enqueue it!

	}
	else {

		// main js file
		wp_register_script('magillDev_scripts', get_theme_file_uri() . '/assets/js/scripts.js', array('jquery'), '0.01');
		wp_enqueue_script('magillDev_scripts');

		// jquery
		wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1');
		wp_enqueue_script('jquery');

		// jquery validate
		wp_register_script('jquery-validate', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js', array(), '1.15');
		wp_enqueue_script('jquery-validate');

		// google fonts
		wp_register_script('google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,400|Roboto+Slab:300,400', array(), '0.01');
		wp_enqueue_script('google-fonts');
	}
}
add_action('init', 'magillDev_header_scripts'); // Add Custom Scripts to wp_head

// Load conditional scripts
function magillDev_conditional_scripts()
{
	if (is_page('pagenamehere')) {
		wp_register_script('scriptname', get_theme_file_uri() . '/assets/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
		wp_enqueue_script('scriptname'); // Enqueue it!
	}
}
add_action('wp_print_scripts', 'magillDev_conditional_scripts'); // Add Conditional Page Scripts

// Load styles
function magillDev_styles()
{
	wp_register_style('magillDev_styles', get_theme_file_uri() . '/assets/css/styles.css', array(), '0.01', 'all');
	wp_enqueue_style('magillDev_styles'); // Enqueue it!
}
add_action('wp_enqueue_scripts', 'magillDev_styles'); // Add Theme Stylesheet

?>
