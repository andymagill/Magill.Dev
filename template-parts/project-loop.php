<?php


$projects = get_field('projects');
$default_thumbnails = get_field('default_thumbnails');

if( $projects ): ?>

	<section class="projects">
		<div class="wrapper">

			<h2><?php _e( 'PROJECTS' ); ?></h2>

			<ul>

			<?php foreach( $projects as $project):

				setup_postdata($project);
				$title 		= get_the_title($project->ID);
				$excerpt 	= get_the_excerpt($project->ID);

				$content 	= $project->post_content;
				$content 	= apply_filters('the_content', $content);
				$content 	= str_replace(']]>', ']]&gt;', $content);

				$thumb 		= get_the_post_thumbnail($project->ID);
				$tags 		= get_the_tags($project->ID);
				$classes 	= implode(" ",get_post_class('', $project->ID));

				//
				if ( !$thumb ) {
					$default_thumb_id = $project->ID % count($default_thumbnails);
					$thumb = wp_get_attachment_image($default_thumbnails[$default_thumb_id]);
				}

				?>
				<li id="project-<?= $project->ID; ?>" class="<?= $classes; ?>">

					<?php if ( $project->ID ) : ?>
						<div class="project_inner">
							<?= $thumb; ?>
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

	<?php wp_reset_postdata();
endif;

?>
