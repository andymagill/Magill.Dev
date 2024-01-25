
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
	
<?php get_footer(); ?>
