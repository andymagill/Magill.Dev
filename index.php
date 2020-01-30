
<?php
	get_header();

	get_template_part('template-parts/hero');

	magillDev()->render_menus('middle-menu', 'middle_nav'); ?>

	<main class="main" role="main">

		<?php
		if ( have_posts() ) : ?>
			<section class="frontpage_content">
				<div class="wrapper">
					<?php
					while ( have_posts() ) : the_post();
						the_content();
					endwhile;
					?>
				</div>
			</section>
			<!-- /frontpage_content -->
			<?php
		endif;

		get_template_part('template-parts/project-loop'); ?>

	</main>
	<!-- /main -->

	<div class="double_divider bottom" data-parallax-multiplier="-2">
		<span></span>
		<span></span>
	</div>

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
