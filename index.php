
<?php
	get_header();

	get_template_part('template-parts/hero');

?>
	<section class="middle-nav">
		<?php magillDev()->render_menus('middle-menu'); ?>
	</section>

	<main role="main">
		<section class="post-loop">

			<?php get_template_part('template-parts/loop'); ?>
			<?php get_template_part('template-parts/pagination'); ?>

		</section>
		<!-- /section -->
	</main>
	<!-- /main -->

<?php get_footer(); ?>
