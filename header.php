<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
        <!--link href="<?php echo get_template_directory_uri(); ?>/img/icons/favicon.ico" rel="shortcut icon">
        <link href="<?php echo get_template_directory_uri(); ?>/img/icons/touch.png" rel="apple-touch-icon-precomposed"-->

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>

	</head>
	<body <?php body_class(); ?>>


		<!--
			Hey there!  I'm thrilled you are interested enough to look at my code.
			Who knows what crazy stuff I could have put in here if you didn't check!

			Do you like riddles?
			There is an ancient invention still used in some parts of the world today that allows people to see through walls.
			What is it?

			Scroll down for the answer.
		-->

		<div class="page">
			<header class="header primary_nav clear" role="banner">
				<?php magillDev()->render_menus('header-menu'); ?>
			</header>
			<!-- /header -->
