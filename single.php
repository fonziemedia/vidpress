<?php get_header();?>
<section class="col-md-8">
		<?php 
		if ( have_posts() ) : while ( have_posts() ) : the_post();
		echo setPostViews(get_the_ID());
		
		$vid_link = get_post_meta( $post->ID, 'video_link', true );
		$video_embed_code = wp_oembed_get( $vid_link, array( 'width' => 480, 'height' => 360, 'controls' => 2, 'showinfo' => 0) );

		
		?>		
	
	
	<div class="top-content row">
		<div class="col-md-8">
			<h1><?php the_title(); ?></h1>
			<div><?php echo $video_embed_code ?></div>
			<p class="video-description"><?php the_field('description'); ?></p>	
			<p> Posted by <strong><?php the_author();?></strong> on <strong><?php the_time('l j F Y'); ?></strong></p>
			<p><?php echo getPostViews(get_the_ID()); ?></p>
			<?php if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>
					<p><a onclick="return confirm('Are you SURE you want to delete this post?')" href="<?php echo get_delete_post_link( $post->ID ) ?>">Delete</a></p>
										
					<p><a href="#editp" data-toggle="modal">Edit Video</a></p>
					<?php endif; ?>	
			
			<?php previous_post_link('<h2>%link</h2>', 'Previous Video'); ?>
			<?php next_post_link('<h2>%link</h2>', 'Next Video'); ?>

			<?php comments_template(); ?> <!-- this will check if there's a comments.php in the theme's directory and use it, if not it will check the default WP files -->
		</div>
		<?php endwhile; endif; ?>
		</section>		
		
		<aside class="col-md-4 main-sidebar">
			<div class="x-container"><?php dynamic_sidebar('sidebar-widgets');?></div>
		</aside>
	</div>
	

	

<?php get_footer();?>
