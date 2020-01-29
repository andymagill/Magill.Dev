<?php get_header(); ?>

	<main role="main">
		<!-- section -->
		<section>

			<!-- article -->
			<article id="post-404">

				<h1><?php _e( '¯\_(ツ)_/¯ Oh no, page not found!', 'magillDev' ); ?></h1>
				<p><?php _e( 'What are you looking for ?', 'magillDev' ); ?></p>
				<h2>
					<a href="<?php echo home_url(); ?>" class="btn"><?php _e( 'Return to Homepage', 'magillDev' ); ?></a>
				</h2>

			</article>
			<!-- /article -->

		</section>
		<!-- /section -->
	</main>

<?php get_footer(); ?>
