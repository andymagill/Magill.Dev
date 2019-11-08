<!-- sidebar -->
<aside class="sidebar" role="complementary">

	<?php
		magillDev()->render_menus('sidebar-menu');
		get_template_part('searchform');
	?>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
	</div>

	<div class="sidebar-widget">
		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
	</div>

</aside>
<!-- /sidebar -->
