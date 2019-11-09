<?php

$id				=	get_the_ID();
$intro 			= 	get_field('hp_hero_intro', $id);
$photo 			= 	get_field('hp_hero_photo', $id);
$background 	= 	get_field('hp_hero_background', $id);

if( !empty($background) ) {
?>
	<style>
		.asdfasdf{ background-image: url( <?= $background['url']; ?> ); }
	</style>

	<section class="hero">
		<span role="img" aria-label="<?= $background['alt']; ?>"></span>

		<div class="wrapper">
			<div class="intro"><?= $intro; ?></div>

			<div class="photo">
				<img src="<?= $photo["url"]; ?>" alt="<?= $photo["alt"]; ?>">
			</div>
		</div>
	</section>
<?php
}
?>

