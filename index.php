
<?php
	get_header();
	get_template_part('template-parts/hero');
?>
	<main role="main">
		<!-- section -->
		<section>

			<h1><?php _e( 'Projects' ); ?></h1>

			<?php get_template_part('template-parts/loop'); ?>

			<?php get_template_part('template-parts/pagination'); ?>

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
