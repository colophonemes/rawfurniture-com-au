<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>

			<div id="content" class="clearfix row">
				<?php $referer = wp_get_referer(); if($referer && stristr($referer,'filter')) : ?>
					<div class="col-xs-12 back-to-filtered">
					<a href="<?=$referer?>" class="badge">&larr; back to filtered results</a>
					</div>
				<?php endif; ?>
				<div id="main" class="col col-lg-12 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">

						<header>

							<div class="page-header"><h1><?php the_title(); ?></h1></div>

						</header> <!-- end article header -->

						<section class="post_content">
							<div class="row">
							<div class="col-md-6 furniture-item">
								<script>
								jQuery(document).ready(function($){
									$(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
									    event.preventDefault();
									    $(this).ekkoLightbox();
									});
								});
								</script>

								<?php if (get_field('sold') === true ): ?>
									<span class="badge sold-flag sold-flag-single">sold</span>
								<?php endif; ?>
								<?php
								$output = "";

								$args = array( 'post_type' => 'attachment', 'numberposts' => -1, 'post_status' => null, 'post_parent' => $post->ID );
								$attachments = get_posts($args);

								if ($attachments) {
									if(count($attachments)>1){
										$output = '<div id="carousel-gallery" class="carousel slide" data-ride="carousel">';

										// carousel indicators
										$output.= '<ol class="carousel-indicators">';
											foreach(array_keys($attachments) as $attachment){
										    	$output.= '<li data-target="#carousel-gallery" data-slide-to="'.$attachment.'"'.($attachment==0 ? ' class="active"' : '').'></li>';
										    }
										$output.= '</ol>';

										//carousel items
										$output.= '<div class="carousel-inner">';
										foreach($attachments as $k=>$attachment){
											$img = wp_get_attachment_image_src( $attachment->ID , 'carousel' );
											$img_lg = wp_get_attachment_image_src( $attachment->ID , 'lightbox' );
											$output.= '<div class="item'.($k==0 ? ' active' : '').'">';
											$output.= '<a href="'.$img_lg[0].'" data-toggle="lightbox" data-title="'.get_the_title().'">';
										    $output.= '<img src="'.$img[0].'" alt="" class="">';
										    $output.= '</a>';
										    $output.= '</div>';
										}
										$output.= '</div>';

										// carousel controls
										$output.= '<a class="left carousel-control" href="#carousel-gallery" data-slide="prev">';
										$output.= '<span class="glyphicon glyphicon-chevron-left"></span>';
										$output.= '</a>';
										$output.= '<a class="right carousel-control" href="#carousel-gallery" data-slide="next">';
										$output.= '<span class="glyphicon glyphicon-chevron-right"></span>';
										$output.= '</a>';
										$output.= '</div>';
									} else {
										$img = wp_get_attachment_image_src( $attachments[0]->ID , 'carousel' );
											$img_lg = wp_get_attachment_image_src( $attachments[0]->ID , 'lightbox' );
										$output.= '<a href="'.$img_lg[0].'" data-toggle="lightbox" data-title="'.get_the_title().'">';
									    $output.= '<img src="'.$img[0].'" alt="" class="img-responsive">';
									    $output.= '</a>';

									}
								}
								?>
								<?php echo $output;  ?>
								<p style="text-align:center;"><em>click to enlarge</em></p>
							</div>
							<div class="col-md-6">
								<?php the_content(); ?>
								<?php if ( get_field('dimensions') ): ?>
									<p><strong class="h4">Dimensions:</strong> <?php the_field('dimensions'); ?></p>
								<?php endif; ?>
								<?php if ( get_field('price') ): ?>
									<p><strong class="h4">Price:</strong> $<?php echo number_format(get_field('price')); ?></p>
								<?php endif; ?>

								<?php if (get_field('sold') === true ): ?>
								<p class="sold h4">please note: this item has already been sold</p>
								<?php /*<?php else : ?>
								<hr>
								<h3>Make an enquiry about this piece</h3>
								<?php echo do_shortcode( '[contact-form-7 id="81" title="Furniture Enquiry"]' ); ?>*/?>
								<?php endif; ?>

							</div>
							</div>
						</section> <!-- end article section -->

						<footer>

							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>

						</footer> <!-- end article footer -->

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

				<?php //get_sidebar(); // sidebar 1 ?>

			</div> <!-- end #content -->

<?php get_footer(); ?>
