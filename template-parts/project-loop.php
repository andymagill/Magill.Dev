<?php


$projects = get_field('projects');

if( $projects ): ?>

	<section class="projects">
		<div class="wrapper">
			<ul>

			<?php foreach( $projects as $project): // variable must be called $project (IMPORTANT)

				setup_postdata($project);
				$title 		= get_the_title($project->ID);
				$thumb 		= get_the_post_thumbnail($project->ID, 'medium');
				$excerpt 	= get_the_excerpt($project->ID);
				$tags 		= get_the_tags($project->ID);
				$str_tags 	= '';

				foreach ($tags as $tag) {
				  $str_tags .= $tag->slug.' ';
				}

				?>
				<li id="project-<?= $project->ID; ?>" <?php post_class($str_tags); ?>>

					<?php if ( $project->ID ) : ?>
						<a href="#project-<?= $project->ID; ?>" title="<?= $title; ?>">
							<?= $thumb; // Declare pixel size you need inside the array ?>
							<span class="overlay">
								<span class="project_title"><?= $title; ?></span>
								<span class="project_excerpt"><?= $excerpt; ?></span>
								<span class="project_content"><?php the_content(); ?></span>
								<span class="project_tags">
									<ul>
									<?php
									foreach ($tags as $tag) {
										echo '<li class="'.$tag->slug.'">' . $tag->name . '</li>';
									}
									?>
									</ul>
								</span>
							</span>
						</a>
					<?php endif; ?>
				</li>
				<!-- /project -->
			<?php endforeach; ?>

			</ul>
		</div>
	</section>

	<?php wp_reset_postdata(); // IMPORTANT - reset the $project object so the rest of the page works correctly ?>
<?php endif;

?>
