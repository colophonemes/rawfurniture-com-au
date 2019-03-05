<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
		
				<div id="main" class="col-sm-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
								
								<header>
									
									<div class="page-header"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
								
								</header> <!-- end article header -->
							
								<div class="row">
									<div class="col-sm-6">
										<section class="post_content clearfix" itemprop="articleBody">
											<?php the_content(); ?>
									
										</section> <!-- end article section -->
										
										<footer>
								
											<?php the_tags('<p class="tags"><span class="tags-title">' . __("Tags","wpbootstrap") . ':</span> ', ', ', '</p>'); ?>
											
										</footer> <!-- end article footer -->
									</div>
									<div id="sidebar" class="col-sm-6" role="complementary">
										<?php 
											$post_thumbnail_id = get_post_thumbnail_id();
											$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'featured-front-page' );
										?>
										<img src="<?=$featured_src[0]?>" class="img-responsive">
										<?php if( class_exists( 'kdMultipleFeaturedImages' ) && $featured_2_src = kd_mfi_get_featured_image_url( 'featured-image-2', 'page' ,'featured-front-page') ) : ?>
										<img src="<?=$featured_2_src?>" class="img-responsive" style="margin-top:30px;">
										<?php endif; ?>
									</div>
							</article> <!-- end article -->
							
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
    
    
			</div> <!-- end #content -->

<?php get_footer(); ?>