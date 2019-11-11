<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<?php
		magillDev()->render_menus('sidebar-menu', 'side_nav');

		get_template_part('searchform');
	?>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar')) ?>
	</div>

</aside>
<!-- /sidebar -->
