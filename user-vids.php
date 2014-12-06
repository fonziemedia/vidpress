<?php
/*
Template Name: User Videos
*/
?>
<?php get_header();?>

<section class="section-border <?php if (is_dynamic_sidebar('sidebar-widgets')) :?>col-md-8<?php else :?>col-md-12<?php endif;?>"> <!-- the width of this section will vary if sidebar-widgets are active -->
	<h1>MY VIDEOS</h1>
		<ul class="row">
			<div id="user-vids"> <!-- This id will be triggered by jquery to create an infinite scroll -->
			<?php
			if (isset($_POST['page_no'])){
				$page_number = $_POST['page_no'];
			} else {
				$page_number = 1;
			}
			
	global $wp_query, $paged;
						
						if( get_query_var('paged') ) {
							$paged = get_query_var('paged');
						}
							else if ( get_query_var('page') ) {
									$paged = get_query_var('page');
							}
						else{
							$paged = 1;
						}
						
						$wp_query = null;
						
						$content_layout = get_theme_mod('content_layout_setting'); 	//content layout settings - thumbs or compressed posts
						
						if (is_dynamic_sidebar('sidebar-widgets')) { // the number of posts per page will vary if sidebar-widgets are active
								$args = array(
										'posts_per_page' => 6, 
										'posts_type' => 'post', 
										'orderby' => 'date',
										'order' => 'DESC',
										'author' => $current_user->ID,
										'paged' => $paged
										);
						}
						else {
								$args = array(
										'posts_per_page' => 10, 
										'posts_type' => 'post', 
										'orderby' => 'date',
										'order' => 'DESC',
										'author' => $current_user->ID,
										'paged' => $paged
										);
						}
							
						$wp_query = new WP_Query( $args );	/* for pagination to work this must be called wp_query for some reason */
						
						$current_user = wp_get_current_user();
						
						$x=1; // our x variable will be used to signal the first post on each page
						
						while ($wp_query->have_posts()) : $wp_query->the_post();								
						
						$vid_link = get_post_meta( $post->ID, 'video_link', true );
						$video_embed_code = wp_oembed_get( $vid_link, array( 'width' => 120, 'height' => 90, 'controls' => 2, 'showinfo' => 0) );
						
						?>		
							<li id="page<?php if ($x==1) { echo $page_number; $x++;}?>" class="the-post col-md-4" style="width: <?php if (is_dynamic_sidebar('sidebar-widgets')) :?>33%<?php else :?>20%<?php endif;?>"><!-- using $x to signal our first post -->
								
								<div class="vid-col">
									<div class="zed<?php the_id(); ?> content-layout">
										<div class="vid-thumb">
											<?php echo $video_embed_code ?>
										</div>
									</div>
									
									<div class="vid-title">
										<h8>
										<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
										<?php if ($content_layout == 'compressed'):?>
										<button type = "button" class = "content-show" id = "show-nav<?php the_id(); ?>">
											<span class = "glyphicon glyphicon-plus"> </span>
										</button>
										<button type = "button" class = "content-hide" id = "hide-nav<?php the_id(); ?>">
											<span class = "glyphicon glyphicon-minus"> </span>
										</button>
										<?php endif;?>
										</h8>
									</div>
									
									<div class="vid-desc">
											<?php the_field('description'); ?> </p>
										</div>
									
									<div class="vid-meta-top">
										<div class="vid-meta-auth">
											Posted by <a><?php the_author_posts_link(); ?></a>
										</div>
										<div class="vid-meta-views">
											<?php echo getPostViews(get_the_ID());?>
										</div>
									</div>
									<div class="vid-meta-bottom">
										<div class="vid-meta-date">
											On <?php the_time('j F Y'); ?>
										</div>	
										<div class="vid-meta-edit">
											<a href="<?php the_permalink(); ?>"><?php if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>Edit /<?php endif; ?> Comment</a></p>
										</div>	
									</div>
								</div>
							</li>
										
							
							<script>
								jQuery("#show-nav<?php the_id(); ?>").click(function () {
									jQuery(".zed<?php the_id(); ?>").toggle("slow");
									jQuery("#show-nav<?php the_id(); ?>").hide();
									jQuery("#hide-nav<?php the_id(); ?>").show();
								});
								jQuery("#hide-nav<?php the_id(); ?>").click(function () {
									jQuery(".zed<?php the_id(); ?>").toggle("slow");
									jQuery("#hide-nav<?php the_id(); ?>").hide();
									jQuery("#show-nav<?php the_id(); ?>").show();
								});
							</script>
							
						<?php 
						endwhile;						
						
						$total_posts = $wp_query->found_posts;  //obtaining the total number of posts in our query
							
							if (is_dynamic_sidebar('sidebar-widgets')) {
									$total_pages = ceil($total_posts / 6);	// calculating the number of pages based on the posts per page /// ADD COMPRESSED POSTS CONDITION
								}
							else {
									$total_pages = ceil($total_posts / 10);
							}
							
							$pages_left = ($total_pages - 1) - ($page_number - 1);							
						
						if ($page_number < $total_pages && $total_pages > 1) : ?> <!-- disabling the 'more posts' button if there are no more pages or if there's only 1 page -->
	
						<div class="col-md-12">
						<button type="button" id="next-latest-btn" class="btn btn-primary pagination" value="<?php echo $total_pages;?>">
						Load More (<?php echo $pages_left;?>)
						</button>
						<!-- ADD AN IF PAGE > 3 BACK TO TOP / COLLAPSE BUTTON -->
						</div>
					<?php
					else :?>
						<div>
						</div>
					<?php
					endif;
					if ($total_posts == 0) : ?>
						<div>
						<p> SORRY, IT SEEMS YOU HAVEN'T SUBMITTED ANY POSTS YET
						</div>
					<?php
					endif;
				
										
							wp_reset_query();
							
?>
			</div> <!-- <div id="user-vids"> -->
		</ul>
</section>	

	

<?php get_footer();?>
