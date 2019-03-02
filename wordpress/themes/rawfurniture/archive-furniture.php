<?php
/*
Template Name: Full Width Page
*/
?>

<?php get_header(); ?>
			
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-12 clearfix" role="main">
					<div class="row">
					<?php
						//$furniture_baseurl = get_bloginfo('url').'/'.$wp->request.'/';
						$furniture_baseurl = get_post_type_archive_link('furniture');
						$current_filter = (isset($_GET['filter']) ? $_GET['filter'] : false);
						if($current_filter){
							$current_filter = sanitise_filter($current_filter);
						}
						$args = array(
							'hide_empty'=> 1,
							'orderby'	=> 'count',
							'order'		=> 'DESC'
						);
						$categories = get_categories( $args );
						//echo '<pre>'.print_r().'</pre>'; 
						?>
						<div class="well col-sm-12">
							<h3 style="margin:0 auto 10px; border-bottom: 1px solid #333;">
								Filter furniture
								<?php if($current_filter) : ?>
								<a href="<?=$furniture_baseurl?>" class="label label-default"><strong>clear filters &times;</strong></a>
								<?php endif; ?>
							</h3>
								<div class="row" style="margin-bottom: 10px">
									
									<?php if($categories) : ?>
										<div class="col-md-6">
											<span class="h4">Category:</span><span class="visible-xs"></span>
											<?php $i=0; foreach($categories as $category) : ?>
												<?=($i==0 ? '' : ' / ')?>
												<?php if(isset($current_filter['category']) && in_array($category->slug,explode(',',$current_filter['category'])) ): ?>
													<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(remove_filter_criterion(array('category'=>$category->slug),$current_filter))?>" class="badge"><?=$category->cat_name?></a>
												<?php else : ?>
													<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(add_filter_criterion(array('category'=>$category->slug),$current_filter))?>"><?=$category->cat_name?></a>
												<?php endif;?>
					
											<?php $i++; endforeach; ?>
										</div>
									<?php endif; ?>
										<div class="col-md-6">
											<span class="h4">Sold?</span><span class="visible-xs"></span>
											<?php if(isset($current_filter['sold']) && $current_filter['sold']==='false' ) : ?>
													<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(remove_filter_criterion('sold',$current_filter))?>" class="badge">Unsold only</a>
											<?php else : ?>
												<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(replace_filter_criterion(array('sold'=>'false'),$current_filter))?>">Unsold only</a> / 
											<?php endif; ?>
											<?php if(isset($current_filter['sold']) && $current_filter['sold']!=='false' ) : ?>
													<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(remove_filter_criterion('sold',$current_filter))?>" class="badge">Sold only</a>
											<?php else : ?>
												<a href="<?=$furniture_baseurl.'?filter='.collapse_filter(replace_filter_criterion(array('sold'=>'true'),$current_filter))?>">Sold only</a>
											<?php endif; ?>
										</div>
								</div>
							</div>
						</div>
					<div class="row">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<a href="<?php the_permalink(); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix col-sm-6 col-md-4'); ?> role="article">
						<div class="furniture-archive-item-wrapper">
							<header>
								
								<div class="page-header">
									
										<h1><?php the_title(); ?></h1>
									
								</div>
							
							</header> <!-- end article header -->
						
							<section class="post_content furniture-item">
								<?php if (get_field('sold') === true ): ?>
									<span class="sold-flag badge">sold</span>
								<?php endif; ?>
								<?php the_post_thumbnail('thumb-furniture',array('class'=>'img-responsive'));?>
								<div class="furniture-archive-item-description">
									<?php the_excerpt(); ?>
								</div>
								
						
							</section> <!-- end article section -->
							
							<footer>
				
								<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>
								
							</footer> <!-- end article footer -->
						</div>
					</article> <!-- end article -->
					</a>
					<?php endwhile; ?>
					</div>

						<?php $num_pages = $wp_query->max_num_pages; if ( $num_pages  > 1 ) : ?>

						  <div class="pagination-wrapper">
						  	<ul class="pagination">
								<?php $prev = get_previous_posts_link('&laquo;'); if($prev): ?>
								<li><?=$prev?></li>
								<?php else : ?>
								<li class='disabled'><span>&laquo;</span></li>
								<?php endif; ?>								<?php
									//global $wp_rewrite;
									 
									$pagination_args = array(
									 'base' => @add_query_arg('paged','%#%'),
									 'format' => '',
									 'total' => $num_pages,
									 'current' => $current,
									 'show_all' => true,
									 'type' => 'array',

									);
									 
									 $pagination_args['base'] = user_trailingslashit( trailingslashit( remove_query_arg('filter',get_pagenum_link(1) ) ) . 'page/%#%/', 'paged');
									 
									if( !empty($_GET['filter']) )
									 $pagination_args['add_args'] = array('filter'=>$_GET['filter']);
									

									$pagination = paginate_links($pagination_args);
								


									foreach($pagination as $page){
										$a = explode('\'>',$page);
										$a = explode('</a>',$a[1],1);
										$a = $a[0];

										echo '<li'.($paged==$a || ($a==1 && !is_paged()) ? ' class="active"' : '').'>'.$page.'</li>';
									}
								?>
								<?php $next = get_next_posts_link('&raquo;'); if($next): ?>
								<li><?=$next?></li>
								<?php else : ?>
								<li class='disabled'><span>&raquo;</span></li>
								<?php endif; ?>
							</ul>
						  </div> <!-- end #navigation -->

						<?php endif; ?>
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, no furniture matches that criteria. Please <a href="<?=$furniture_baseurl?>">reset the filter</a>, or try different filter settings.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>