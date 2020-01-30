<?php

$id				=	get_the_ID();
$intro 			= 	get_field('hp_hero_intro', $id);
$photo 			= 	get_field('hp_hero_photo', $id);

?>

<section class="hero">
	<div class="wrapper">
		<div class="intro"><?= $intro; ?></div>

		<div class="photo">
			<img src="<?= $photo["url"]; ?>" alt="<?= $photo["alt"]; ?>">
		</div>
	</div>
</section>

<div class="double_divider top" data-parallax-multiplier="-3">
	<span></span>
	<span></span>
</div>
