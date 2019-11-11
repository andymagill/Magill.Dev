<?php


$projects = get_field('projects');

if( $projects ): ?>

	<section class="projects">
		<div class="wrapper">
			<ul>

			<?php foreach( $projects as $project): // variable must be called $project (IMPORTANT)

				setup_postdata($project);
				$title = get_the_title($project->ID);
				$thumb = get_the_post_thumbnail($project->ID);
				?>
				<li id="project-<?= $project->ID; ?>" <?php post_class(); ?>>

					<?php if ( $project->ID) : // Check if thumbnail exists ?>
						<a href="#project-<?= $project->ID; ?>" title="<?= $title; ?>">
							<?= $thumb; // Declare pixel size you need inside the array ?>
							<span class="overlay">
								<span class="project_title"><?= $title; ?></span>
								<span class="project_content"><?php the_content(); ?></span>
								<span class="project_tags"><?php the_tags(); ?></span>
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
