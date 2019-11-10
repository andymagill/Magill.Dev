
<?php
	get_header();

	get_template_part('template-parts/hero');
?>
	<section class="middle-nav">
		<?php magillDev()->render_menus('middle-menu'); ?>
	</section>

	<main class="main" role="main">
		<section class="frontpage content">
			<div class="wrapper">
				<?php the_content(); ?>
			</div>
		</section>

		<section class="post-loop">
			<div class="wrapper">
				<?php get_template_part('template-parts/project-loop'); ?>
			</div>
		</section>
		<!-- /section -->
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
