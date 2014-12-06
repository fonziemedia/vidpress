  <div class="flexslider col-md-5">
	<ul class="slides">
		
		<?php
			$args = array('category_name' => 'Featured', 'posts_per_page' => 3);
			$query = new WP_Query( $args );
			while ($query->have_posts()) : $query->the_post(); 
		?>
	
		  <li >
				<div class="caption">
				<h4><a href="<?php the_permalink(); ?>" class="game-title"><?php the_title();?></a></h4>
				<div class="the-contents"><?php the_content(); ?></div>
				<p> <?php the_field('description'); ?> </p>
				<p> Posted by <strong><?php the_author();?></strong> on <strong><?php the_time('l j F Y'); ?></strong></p>					
					<div class="post-views"><?php echo getPostViews(get_the_ID());?></div>
				</div>
		  </li>
	  
		<?php
		    endwhile;
		?>
	</ul>
  </div>