
<?php
	get_header();

	get_template_part('template-parts/hero');

?>
	<section class="middle-nav">
		<?php magillDev()->render_menus('middle-menu'); ?>
	</section>

	<main class="main" role="main">
		<section class="post-loop">
			<?php get_template_part('template-parts/loop'); ?>
			<?php get_template_part('template-parts/pagination'); ?>
		</section>
		<!-- /section -->
	</main>
	<!-- /main -->

	<section class="contact">
		<?= do_shortcode('[wpforms id="26" title="false" description="false"]'); ?>
	</section>
	<!-- /contact -->


<?php get_footer(); ?>
