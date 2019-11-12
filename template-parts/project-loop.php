<?php


$projects = get_field('projects');

if( $projects ): ?>

	<section class="projects">
		<div class="wrapper">
			<ul>

			<?php foreach( $projects as $project): // variable must be called $project (IMPORTANT)

				setup_postdata($project);
				$title 		= get_the_title($project->ID);
				$excerpt 	= get_the_excerpt($project->ID);

				$content 	= $project->post_content;
				$content 	= apply_filters('the_content', $content);
				$content 	= str_replace(']]>', ']]&gt;', $content);

				$thumb 		= get_the_post_thumbnail($project->ID);
				$tags 		= get_the_tags($project->ID);
				$classes 	= implode(" ",get_post_class('', $project->ID));

				?>
				<li id="project-<?= $project->ID; ?>" class="<?= $classes; ?>">

					<?php if ( $project->ID ) : ?>
						<div class="project_inner">
							<?= $thumb; // Declare pixel size you need inside the array ?>
							<span class="overlay">
								<span class="project_title"><?= $title; ?></span>
								<span class="project_excerpt"><?= $excerpt; ?></span>
								<span class="project_content"><?= $content; ?></span>

								<?php
								if ( is_array($tags) ) {
								?>
									<span class="project_tags">
										<span class="project_tag_label"><?php _e( 'Powered by : ' ); ?></span>
										<ul>
										<?php
											foreach ($tags as $tag) {
											echo '<li><a href="#'.$tag->slug.'">' . $tag->name . '</a></li>';
										}
										?>
										</ul>
									</span>
								<?php
								}
								?>
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
