<?php get_header();?>


<section class="top-content col-md-8">
<h1>SEARCH RESULTS:</h1>
	<ul class="row">
	
	<?php
	global $query_string;

	$query_args = explode("&", $query_string);
	$search_query = array();

	foreach($query_args as $key => $string) {
		$query_split = explode("=", $string);
		$search_query[$query_split[0]] = urldecode($query_split[1]);
		} // foreach

	$wp_query = new WP_Query($search_query);
	if($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();
				
				
													
	?>		
			<li class="video-thumb col-md-4">
				<div class="video-thumb-content">
				<h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
				<div><?php the_content(); ?></div>
					<p id="description"> <?php the_field('description'); ?> </p>					
					<p> Posted by <strong><?php the_author();?></strong> on <strong><?php the_time('l j F Y'); ?></strong></p>					
					<div class="post-views"><?php echo getPostViews(get_the_ID());?></div>
					<div class="edit-post"><a href="<?php the_permalink(); ?>"><?php if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>
					EDIT /<?php endif; ?> COMMENT</a>
					</div>											
				</div>
			</li>
					
	<?php endwhile;	else : ?>
	<h3>Sorry, your search hasn't returned any results :(</h3>
	<?php endif; ?>
	 <?php next_posts_link(); ?>
	 <?php previous_posts_link(); ?>
	 <?php wp_reset_query(); ?>
	
	</ul>	


</section>
	

<?php get_footer();?>
