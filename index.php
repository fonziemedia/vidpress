		<?php get_header();?>
</div> <!-- closing the container div from header.php - this will allow us to have a full width for our featured posts/banner background-->				
		<?php
		$layout_setting = get_theme_mod('top_layout_setting');
		
		if ($layout_setting == 'featured'):
		?>

<!-- ================================== FEATURED POSTS ================================================= -->		
		<section class="container-fluid">
			<div class="row">
				<div class="container">
					<div class="row">
							<h1>FEATURED VIDEOS</h1>
								<ul class="row col-md-12">
									<div class="featured-container col-md-12">
										<div id="featured" class="featured-posts col-md-12">
											<!-- loop below will show only vids with category = featured but other args can be used such as: title, date, etc -->	
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
													'posts_per_page' => 3, /* for pagination to work properly remember to change 'settings>reading>show at most x posts' - investigate this further */
													'post_type' => 'post',
													'orderby' => 'date',
													'order' => 'DESC',
													'paged' => $paged,
													'category_name' => 'featured'
											);		
											
											$wp_query = new WP_Query( $args );
											
											while ($wp_query->have_posts()) : $wp_query->the_post(); 
											
											$vid_link = get_post_meta( $post->ID, 'video_link', true );
											$video_embed_code = wp_oembed_get( $vid_link, array( 'width' => 320, 'height' => 180, 'controls' => 2, 'showinfo' => 0) );
											
											?>	
												<li class="the-post featured col-md-4">
													<div class="vid-col featured">
														<div class="content-layout featured">
															<div class="vid-thumb">
																<?php echo $video_embed_code ?>
															</div>
														</div>									
														<div class="vid-title">
															<h8>
															<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
															</h8>
														</div>									
														<div class="vid-desc">
																<?php the_field('description'); ?> </p>
															</div>
														
														<div class="vid-meta-top featured">
															<div class="vid-meta-auth">
																Posted by <a><?php the_author();?></a>
															</div>
															<div class="vid-meta-views">
																<?php echo getPostViews(get_the_ID());?>
															</div>
														</div>
														<div class="vid-meta-bottom featured">
															<div class="vid-meta-date">
																On <?php the_time('j F Y'); ?>
															</div>	
															<div class="vid-meta-edit">
																<a href="<?php the_permalink(); ?>"><?php if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>Edit /<?php endif; ?> Comment</a></p>
															</div>	
														</div>
													</div>
												</li>				
											<?php endwhile; ?>
												
												<div id="featuredpg" class="feat-page-links col-md-12">						
														<span class="prev-posts"><?php next_posts_link('') ?></span>
														<span class="next-posts"><?php previous_posts_link('') ?></span>
												</div>
													
												<?php wp_reset_query(); ?>
												
										</div>
									</div>
								</ul>
					</div>
				</div>
			</div>
		</section>
		<?php elseif ($layout_setting == 'banner'):
		
		$logo_image = get_theme_mod('logo_image');
		
		if ( ! empty( $logo_image ) ) :
		?>


		<!-- all the containers below are - apparently - necessary so we can have a full width background color -->
		<section class="container-fluid">	
			<div class="row">						
				<div class="container">
					<div class="row">				
						<div class="banner col-md-12">
							<div class="title col-md-6">
							<a href = "<?php bloginfo( 'url' );?>" class ="banner-title"><?php bloginfo('name');?></a>
							</div>
							<div class="logo col-md-6">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="banner-img"><img src="<?php echo esc_url( $logo_image ); ?>" class="header-image" width="150" height="150" alt="" /></a>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</section>
		<?php endif; endif; ?>
		
				

<!-- ================================== LATEST POSTS =========================================== -->		



<div class="container">		<!-- opening back our container div -->	

		<section class="main-section <?php if (is_dynamic_sidebar('sidebar-widgets')) :?>col-md-8<?php else :?>col-md-12<?php endif;?>"> <!-- the width of this section will vary if sidebar-widgets are active -->
			<h1>LATEST VIDEOS</h1>
				<ul class="row">
				<?php

					$categories = get_categories(); //getting our categories from the database
					
					$cat_color = array ( 			//the different colours for our categories
						'1' => 'powderblue',
						'2' => 'orange',
						'3' => 'paleGreen ',
						'4' => 'cornsilk ',
						'5' => 'moccasin ',
						'6' => 'mistyRose ',
						'7' => 'violet',					
					);

					$i = 1;	//for our cat colour loop

				?>
					

					<ul id="vids-menu">	
						<li id="latest-tab"><a href="#latest">Latest</a></li>										
						<?php foreach ( $categories as $cat ) : ?>		<!-- assigning different colours to our categories -->
						<li id="cat-<?php echo $cat->term_id;?>" class="cat-items" style="background-color:<?php echo $cat_color[$i];?>"><a class="cat-class" value="<?php echo $cat->term_id; ?>" onclick="loadCat('<?php echo $cat->term_id; ?>');" href="#latest"> <?php echo $cat->name;?></a></li>
						<?php
						if ($i >= 7) { $i = 1;} else {$i++;}
						endforeach; ?>
					</ul>
					
					<div id="loading-animation" style="display: none;"><img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif"/></div>
					<div id="latest-container">	<!-- need this div so that scroll won't jump when we remove the div below with ajax queries - div height set to 600px --> 
						<div id="latest" >  <!-- need this div for our infinite loop and categories ???? can we use an include here instead?? --> 
							
							
							
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
							
							$content_layout = get_theme_mod('content_layout_setting');	//content layout settings - thumbs or compressed posts
							
							
							
							if (is_dynamic_sidebar('sidebar-widgets')) { // the number of posts per page will vary if sidebar-widgets are active
								$args = array(
										'posts_per_page' => 6, 
										'posts_type' => 'post', 
										'orderby' => 'date',
										'order' => 'DESC',
										'paged' => $paged
										);
							}
							else {
								$args = array(
										'posts_per_page' => 10, 
										'posts_type' => 'post', 
										'orderby' => 'date',
										'order' => 'DESC',
										'paged' => $paged
										);
							}
													
							$wp_query = new WP_Query( $args );	/* for pagination to work this must be called wp_query for some reason */
							
							while ($wp_query->have_posts()) : $wp_query->the_post();								
							
							$vid_link = get_post_meta( $post->ID, 'video_link', true );
							
							/*
							parse_url takes a string and cuts it up into an array that has a bunch of info. You can work with this array, or you can specify the one item you want as a second argument. In this case we're interested in the query, which is PHP_URL_QUERY.
							Now we have the query, which is v=C4kxS1ksqtw&feature=relate, but we only want the part after v=. For this we turn to parse_str which basically works like GET on a string. It takes a string and creates the variables specified in the string. In this case $v and $feature is created. We're only interested in $v.
							To be safe, you don't want to just store all the variables from the parse_url in your namespace (see mellowsoon's comment). Instead store the variables as elements of an array, so that you have control over what variables you are storing, and you cannot accidentally overwrite an existing variable.
							Putting everything together, we have:
							*/
							
							parse_str( parse_url( $vid_link, PHP_URL_QUERY ), $my_array_of_vars ); /*parsing url from the query (everything after the ?) and creating a new variable with the info, but before we parsed string which allows us to create an array containing the variables inside the parsed url, in this case 'v', we'll isolate 'v' in the next line of code*/
							$youtube_id = $my_array_of_vars['v'];  // will be someting like C4kxS1ksqtw
							$youtube_link = 'http://img.youtube.com/vi/' . $youtube_id;
							
							/*capturing the youtube thumbnails into an array
							$you_thumb = array (							
										'0' =>	$youtube_link . '/0.jpg',
										'1' =>	$youtube_link . '/1.jpg',
										'2' =>	$youtube_link . '/2.jpg',
										'3' =>	$youtube_link . '/3.jpg',
										'4' =>	$youtube_link . '/maxresdefault.jpg',
										
										);
							*/
							
										
							//youtube							
							$ytvideo_embed_code = wp_oembed_get( $vid_link, array( 'width' => 120, 'height' => 90, 'controls' => 2, 'showinfo' => 0, 'theme' => 'light') );
							
							
							//vimeo
								$vmembed_args = array(
									'title' => 0,
									'byline' => 0,
									'portrait' => 0,
									'color' => 'eb145b',
									'width' => '200',
									'height' => '120',
									'player_id' => 'my_player',
								);
							
								$vmvideo_embed_code = wp_oembed_get( $vid_link , $vmembed_args );
							?>
							
							
								<li class="the-post col-md-2" style="width: <?php if (is_dynamic_sidebar('sidebar-widgets')) :?>33%<?php else :?>225px<?php endif;?>"> <!-- the width of our posts will vary if sidebar-widgets are active -->								
									<div class="vid-col">
										<div class="zed<?php the_id(); ?> content-layout">
											<div class="vid-thumb youtube" id="<?php echo $youtube_id ?>"   style="width: 196px; height: 110px;">
											<!-- <img src=" <-php echo $you_thumb[4];?>" width="196" height="110"> -->
											<!--?php
											/*checking video link 
											if (strpos($vid_link, 'youtube') !== false){
							
												echo $ytvideo_embed_code;*/
												
											
											}/* elseif (strpos($vid_link, 'vimeo') !== false){
											
												echo $vmvideo_embed_code;																																						
											}
											else {
												echo 'Video Link Not Supported';
											}
											?>	*/
											-->
											</div>											
										</div>									
										<div class="vid-title">
											<h8>
											<a href="<?php the_permalink(); ?>"><?php the_title();?></a>
											<?php if ($content_layout == 'compressed'):?>
											<button type = "button" class = "content-show" id = "show-nav<?php the_id(); ?>">
												<span class = "glyphicon glyphicon-play"> </span>
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
												Posted by <?php the_author_posts_link(); ?></a>
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
												<?php
													comments_popup_link( '0 comments', '1 comment', '% comments', 'comments-link', 'Comments closed');
												?>
												<?php
												if ($post->post_author == $current_user->ID || current_user_can( 'manage_options' ))  : ?>
												<a href="<?php the_permalink(); ?>"> / Edit</a>
												<?php endif; ?>
											</div>	
										</div>
									</div>
								</li>
											
								<?php
								if ($content_layout == 'compressed') : ?>
								<script> // expanding and collapsing navs according to Theme display options
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
								endif;						
								endwhile;
							?>
						</div>
						
							<?php
								$total_posts = $wp_query->found_posts;  //obtaining the total number of posts in our query
								if (is_dynamic_sidebar('sidebar-widgets')) {
									$total_pages = ceil($total_posts / 6);	// calculating the number of pages based on the posts per page /// ADD COMPRESSED POSTS CONDITION
								}
								else {
									$total_pages = ceil($total_posts / 10);
								}
								$pages_left = $total_pages-1;
						
								if ($total_pages > 1) :								
								?>
								
							<div class="col-md-12">
							<a id ="latest-btn" class ="btn btn-primary pagination" value="<?php echo $total_pages;?>">Load More (<?php echo $pages_left;?>)</a>
							</div>
							
					</div>	
						<?php
							endif;			
							wp_reset_query();
							
						?>
						
		</ul>
		</section>	

	
			<section class="sidebar-list col-md-4">
				<div>		
					<?php dynamic_sidebar('sidebar-widgets');?>
				</div>
			</section>				
						
								<script src="https://labnol.googlecode.com/files/youtube.js"></script>		
		<?php get_footer();?>
