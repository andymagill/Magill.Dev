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
							<span class="project_image">
								<?= $thumb; ?>
							</span>

							<span class="project_details">
								<span class="project_title"><?= $title; ?></span>
								<span class="project_excerpt"><?= $excerpt; ?></span>
								<span class="project_content"><?= $content; ?></span>

								<?php
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
						</a>
					<?php endif; ?>
				</li>
				<!-- /project -->
			<?php endforeach; ?>

			</ul>
		</div>

		<div class="project_popup">













<div class="project_inner">
							<span class="project_image">
								<img alt="" data-srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-150x150.png 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-325x325.png 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-768x768.png 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-700x700.png 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-120x120.png 120w" sizes="(max-width: 900px) 100vw, 900px" data-src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image ls-is-cached lazyloaded" src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png" srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-150x150.png 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-325x325.png 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-768x768.png 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-700x700.png 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-120x120.png 120w"><noscript><img   alt="" data-srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-150x150.png 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-325x325.png 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-768x768.png 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-700x700.png 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-120x120.png 120w" sizes="(max-width: 900px) 100vw, 900px" data-src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyload" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" /><noscript><img src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify.png 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-150x150.png 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-325x325.png 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-768x768.png 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-700x700.png 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-spotify-120x120.png 120w" sizes="(max-width: 900px) 100vw, 900px" /></noscript>							</span>

							<span class="project_details">
								<span class="project_title">Spotify for Artists – Co.Lab.Events</span>
								<span class="project_excerpt">This is an event promotion website for Spotify's artist engagement operations. </span>
								<span class="project_content">
<p>This is an event promotion website for Spotify’s artist engagement operations. Built on WordPress the site displays event information and collects invitee and RSVP’s via unique links.</p>
</span>

																	<span class="project_tags">
										<span class="project_tag_label">Built with : </span>
										<ul>
										<li><a href="#front-end">Front-end</a></li><li><a href="#wordpress">WordPress</a></li>										</ul>
									</span>
															</span>

									</div>





















		</div>
	</section>
 	<!-- /projects -->
	<?php wp_reset_postdata();
endif;

?>
