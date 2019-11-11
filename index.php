
<?php
	get_header();

	get_template_part('template-parts/hero');
?>
	<?php magillDev()->render_menus('middle-menu', 'middle-nav primary_nav'); ?>

	<main class="main" role="main">

		<section class="frontpage_content">
			<div class="wrapper">
				<?php the_content(); ?>
			</div>
		</section>
		<!-- /frontpage_content -->

		<section class="post_loop">
			<div class="wrapper">
				<?php //get_template_part('template-parts/loop'); ?>
			</div>
		</section>
		<!-- /project_loop -->

		<section class="project_loop">
			<div class="wrapper">
				<?php get_template_part('template-parts/project-loop'); ?>
			</div>
		</section>
		<!-- /project_loop -->
	</main>
	<!-- /main -->

	<section class="contact">
		<div class="row wrapper">
			<div class="col email_text">
				<div class="col_inner">
					<h2>Interested in working together?</h2>
					<p>Are you one of those strange people that loves to talk about work?  What a coincidence, me too! I would love to hear from you so lets start a discussion.</p>
				</div>
			</div>

			<div class="col">
				<div class="col_inner">
					<?= do_shortcode('[wpforms id="26" title="false" description="false"]'); ?>
				</div>
			</div>
		</div>
	</section>
	<!-- /contact -->

<?php get_footer(); ?>
