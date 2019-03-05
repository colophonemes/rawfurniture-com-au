<?php
/*
Template Name: Front page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				
						
						<section class="row post_content">
							<div class="col-sm-6">
								<?php the_content(); ?>
							</div>
							<?php 
								$post_thumbnail_id = get_post_thumbnail_id();
								$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'featured-front-page' );
							?>
							<div id="front-page-featured" class="col-sm-6">
								<img src="<?=$featured_src[0]?>" class="img-responsive"  />
							</div>
													
						</section> <!-- end article header -->
						<hr>
						<section class="row post_content">
							<div class="col-sm-12">
						
								
								
								<!-- latest items -->
								
								<?php 
								$args = array(
										'post_type'		=>	'furniture',
										'posts_per_page'=>	4,
								);
								$furniture = get_posts($args);?>

								<?php if($furniture): ?>
									<h3>Latest items</h3>
									<div class="row">
									<?php foreach($furniture as $post): setup_postdata($post); ?>
										<div class="col-sm-6 col-md-3">
											<a href="<?php the_permalink(); ?>">
												<h4><?php the_title(); ?></h4>
											<?php 
												$post_thumbnail_id = get_post_thumbnail_id();
												$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'thumb-furniture-front-page' );
											?>
											<img src="<?=$featured_src[0]?>" class="img-responsive"  /></a>
										</div>
									<?php endforeach; wp_reset_postdata(); ?>
									</div>
								<?php endif; ?>

							</div>
						</section>


						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>