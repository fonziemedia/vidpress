<!-- The loop for our popular posts -->
<?php
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
	
	$args = array(
				'posts_per_page' => 2,
				'post_type' => 'post',
				'orderby' => 'meta_value_num',
				'order' => 'DESC',
				'meta_key' => 'post_views_count',
				'paged' => $paged
				);
			
	$wp_query = new WP_Query( $args );
	
	$current_user = wp_get_current_user();
		
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
	?>		
		<li class="video-thumb col-md-4">
			<div class="video-thumb-content">
				<h4>
				<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
				</h4> 
				<div><?php the_content(); ?></div>
				<p id="description"> <?php the_field('description'); ?> </p>					
				<p> Posted by <strong><?php the_author();?></strong> on <strong><?php the_time('l j F Y'); ?></strong></p>
				<div class="post-views"><?php echo getPostViews(get_the_ID());?></div>
				<div class="edit-post">
					<a href="<?php the_permalink(); ?>"><?php if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>EDIT /<?php endif; ?> COMMENT</a>
				</div>											
			</div>
		</li>			
	<?php
	endwhile;
	wp_reset_query();
?>