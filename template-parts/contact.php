
    <section class="contact">
		<div class="row wrapper">
			<div class="col email_text">
				<div class="col_inner">
					<?php dynamic_sidebar( 'contact_intro' ); ?>
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
