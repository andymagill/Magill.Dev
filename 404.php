<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404">

				<h1><?php _e( '¯\_(ツ)_/¯ Oh no, page not found!', 'magillDev' ); ?></h1>

				<p><?php _e( 'What are you looking for ?', 'magillDev' ); ?></p>

				<a href="<?php echo home_url(); ?>" class="btn"><?php _e( 'Return to Homepage', 'magillDev' ); ?></a>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>

	<div class="double_divider" data-parallax-multiplier="1">
		<span></span>
		<span></span>
	</div>

<?php get_footer(); ?>
