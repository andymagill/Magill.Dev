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

				$thumb 		= get_the_post_thumbnail($project->ID, 'medium');
				$tags 		= get_the_tags($project->ID);
				$edit_link	= get_edit_post_link($project->ID);
				$classes 	= implode(" ",get_post_class('', $project->ID));

				//
				if ( !$thumb ) {
					$default_thumb_id = $project->ID % count($default_thumbnails);
					$thumb = wp_get_attachment_image($default_thumbnails[$default_thumb_id], 'medium');
				}

				?>
				<li id="project-<?= $project->ID; ?>" class="<?= $classes; ?>">

					<?php if ( $project->ID ) : ?>
						<article class="project_inner">
							<span class="project_image">
								<?= $thumb; ?>
							</span>

							<span class="project_details">
								<h3 class="project_title"><?= $title; ?></h3>
								<span class="project_excerpt"><?= $excerpt; ?></span>
								<span class="project_content"><?= $content; ?></span>

								<?php

								if( current_user_can('administrator') ) {
								?>
									<div class="edit_link">
										<a class="btn" href="<?= $edit_link ?>">Edit Project</a>
									</div>
								<?php
								}

								if ( is_array($tags) ) {
								?>
									<span class="project_tags">
										<span class="project_tag_label"><?php _e( 'Built with : ' ); ?></span>
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
						</article>
						<span class="close">&times;</span>
					<?php endif; ?>
				</li>
				<!-- /project -->
			<?php endforeach; ?>

			</ul>
		</div>


		<!-- <div class="project_popup"> </div> /project_popup -->

	</section>
 	<!-- /projects -->
	<?php wp_reset_postdata();
endif;

?>
