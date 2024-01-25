
			<div class="double_divider bottom" data-parallax-multiplier="-4">
				<span></span>
				<span></span>
			</div>

			<footer class="footer" role="contentinfo">
				<?php 
					get_template_part('template-parts/contact');
					magillDev()->render_menus('footer-menu', 'footer_nav');
				?>

				<div class="copyright">
					<?php dynamic_sidebar( 'footer_bottom' ); ?>
				</div>
				<!-- /copyright -->
			</footer>
			<!-- /footer -->

		</div>
		<!-- /page -->

		<?php wp_footer(); ?>
		
		<!--
			Answer : A Window
		-->

	</body>
</html>
