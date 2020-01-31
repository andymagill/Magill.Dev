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
						<article class="project_inner">
							<span class="project_image">
								<?= $thumb; ?>
							</span>

							<span class="project_details">
								<h3 class="project_title"><?= $title; ?></h3>
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
						</article>
						<span class="close">&times;</span>
					<?php endif; ?>
				</li>
				<!-- /project -->
			<?php endforeach; ?>

			</ul>
		</div>

		<div class="project_popup">

























<article class="project_inner">
							<span class="project_image">
								<img alt="portfolio mtpa" data-srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-150x150.jpg 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-325x325.jpg 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-768x768.jpg 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-700x700.jpg 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-120x120.jpg 120w" sizes="(max-width: 900px) 100vw, 900px" data-src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image lazyloaded" src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg" srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-150x150.jpg 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-325x325.jpg 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-768x768.jpg 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-700x700.jpg 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-120x120.jpg 120w"><noscript><img src="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="portfolio mtpa" srcset="https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa.jpg 900w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-150x150.jpg 150w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-325x325.jpg 325w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-768x768.jpg 768w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-700x700.jpg 700w, https://staging2.magill.dev/wp-content/uploads/2019/11/portfolio-mtpa-120x120.jpg 120w" sizes="(max-width: 900px) 100vw, 900px" /></noscript>							</span>

							<span class="project_details">
								<h3 class="project_title">Mitsubishi Tanabe Pharma America</h3>
								<span class="project_excerpt">Having won FDA approval for it's ALS drug Radicava, MTPA needed a platform to communicate with patients, doctors and caregivers.</span>
								<span class="project_content">
<p>Having won FDA approval for it’s ALS drug Radicava, MTPA needed a platform to communicate with patients, doctors and caregivers. Enabling the website to grow with the organization, flexible layout and content features were built into the templates and the WordPress CMS. </p>
</span>

																	<span class="project_tags">
										<span class="project_tag_label">Built with : </span>
										<ul>
										<li><a href="#front-end">Front-end</a></li><li><a href="#wordpress">WordPress</a></li>										</ul>
									</span>

							</span>
						</article>
						<span class="close">×</span>





















		</div>
	</section>
 	<!-- /projects -->
	<?php wp_reset_postdata();
endif;

?>
