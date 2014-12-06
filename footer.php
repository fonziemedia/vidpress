		<footer class="col-md-12">
			<div class="container">
				<?php dynamic_sidebar('footer-widgets');?>
			</div>
		</footer>
				
		<!-- About modal -->
		<div class= "modal fade" id = "about" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>About Super Video Scout</h4>
					</div>
					<div class = "modal-body">
							
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Close</a>
					</div>
					
				</div>
			</div>
		</div>

		<!-- Register modal -->
		<div class= "modal fade" id = "register" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Super Video Scout Register Form</h4>
					</div>
					<div class = "modal-body">
							<form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" method="post">
								<input type="text" name="user_login" value="Username" id="user_login" class="input" />
								<input type="text" name="user_email" value="E-Mail" id="user_email" class="input"  />
								<?php do_action('register_form'); ?>
								<input type="submit" value="Register" id="register" />
								<p><h7>Already have an account?<a href="#loginto" data-toggle="modal" data-dismiss = "modal"> Login here</a></h7></p>
								</form> 						
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Cancel</a>
					</div>
					
				</div>
			</div>
		</div>

		<!-- Login modal -->
		<div class= "modal fade" id = "loginto" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>Super Video Scout Login</h4>
					</div>
					<div class = "modal-body">
							<?php wp_login_form();?>
							<p><h7>Don't have an account? <a href="#register" data-toggle="modal" data-dismiss = "modal">Register here</a></h7></p>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Cancel</a>
					</div>
					
				</div>
			</div>
		</div>	

		<!-- Edit video modal - NEEDS TO BE BEFORE ADD VIDEO MODAL BECAUSE OF CATEGORY BUG (JQUERY SCRIPT BELOW FIXING IT NEED TO POINT TO THIS ID (THIS NEEDS TO RUN FIRST) -->
		<div class= "modal fade" id = "editp" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>EDIT VIDEO</h4>
					</div>
					<div class = "modal-body">
							<?php include'edit-post.php' ?>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Cancel</a>
					</div>					
				</div>
			</div>
		</div>

		<!-- Add video modal -->
		<div class= "modal fade" id = "addvideo" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>ADD A NEW VIDEO</h4>
					</div>
					<div class = "modal-body">
							<?php include'add-post.php' ?>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Cancel</a>
					</div>
					
				</div>
			</div>
		</div>

		<!-- form success modal -->
		<div class= "modal fade" id = "success" role = "dialog" >
			<div class = "modal-dialog">
				<div class = "modal-content">
					<div class = "modal-header">
						<h4>YOUR VIDEO HAS BEEN SUBMITED!</h4>
					</div>
					<div class = "modal-body">
							<p>Thank you for your submission, click <a href = "<?php bloginfo( 'url' ); ?>/#addvideo" data-dismiss = "modal" data-toggle = "modal">here</a> if you wish to add another video</p>
					</div>
					<div class = "modal-footer">
						<a class = "btn btn-primary" data-dismiss = "modal">Close</a>
					</div>
					
				</div>
			</div>
		</div>

		<!-- check if form was submitted successfully and bringing up success modal -->			
		<script type="text/javascript">
		<?php
		$path=$_SERVER['REQUEST_URI'];
		if (strpos($path, '?updated=true') !== FALSE) {
		?> /* checking that the form has been submitted */
			$(function() {                       // On DOM ready
				$('#success').modal('show');     // Show the modal
			});
		<?php  } ?>                                    
		</script>
		
		
		<!-- infinite scrolling
		this ajax function will send the two variables we need for our pagination 
		
		function loadArticle(pageNumber) {
			$.ajax({
				url: "<#####?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
				type:'POST',
				data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop', 
				success: function(html){
					$("#popular").append(html);    // This will be the div where our content will be loaded
				}
			});
		return false;
		}
				
		<!-- To enable the infinite scroll pagination, we need to determine when the user hits the bottom of the page.
		This can be achieved easily via jQuery using the following code:
		
            $(window).scroll(function(){
                    if  ($(window).scrollTop() == $(document).height() - $(window).height()){
                          // run our call for pagination
                    }
            }); 
				
		<!-- Next we need to call the loadArticle function within the scroll function.
		I'm adding a counter to be used as the page number of our call. -->
		
		<!-- INFINITE LOOP RECENT AND MOST POPULAR -->
		


						<script type="text/javascript">
							jQuery(function($) {
							var count = 2; // var count will assume the value of the next page to be loaded thus it starts at 2
							var cat = '<?php if (isset($cat_id)) { echo $cat_id;}?>'; // defining the category if set, otherwise it will be empty
													
							
								/* ============================SCROLL DOWN PAGINATION ==================================
								
								
								$(window).scroll(function(){
										if  ($(window).scrollTop() != '' && $(window).scrollTop() == $(document).height() - $(window).height()){ //everytime we hit the bottom..
										// !!! this won't work if there's no scroll!!! can be problematic at high resolutions, 'posts_per_page' should be kept high enough to enable scrolling
											if (isCat) {
												loadCatPages(count, cat); //load next latest posts page
											}
											else if (!isCat) {
												loadVidPages(count); //load next latest posts page
											}
											count++; //increase count (next articles)
										}					
								});
								
								*/
								
								$(".cat-items").click(function() { 		//every time we click a category from our category menu in index.php...
									$('.cat-items').css('border', 'none');
									$(this).css('border', '2px solid black');
									$('#latest-tab').css('border', 'none');
									var cat = $(this).attr('value'); 				//redefine the value of cat so it loads the correct category (will be passed via onclick 'load more' cat posts function below) 								
									count =2; 										//reset our pagination counter so its ready to load page 2
									$("#latest-btn").hide();						//hiding the latest posts 'load more' button (we don't want to see this in our categories loop)
									$("#next-latest-btn").hide();					//doing the same for the 'looped' button				NOTE: the .cat-items in index.php has an onclick loadCat() function assigned to it so we can fetch the category values from the loop
								});
								
								$("#latest-tab").click(function() {				//every time we click the latest posts option...
									$(this).css('border', '2px solid black');
									$('.cat-items').css('border', 'none');
									$("#latest-btn").hide();						//hiding the original 'load more' button as we'll be using the looped one from now on
									loadLatest();									//call the loadLatest function to get our latest posts loop
									count = 2;										//reset our pagination counter so its ready to load page 2
								});
								
								
								$(document).on('click', '#latest-btn', function() {			//every time we click the load more button for latest posts...  !!!NOTE!!! the $(document).on('click', 'DOM ELEMENT' function will look for new dom elements every time it's called. This is very useful to look for new loop elements (in this case the load more button)
									loadVidPages(count);										//calling the loadVidPages function and passing on our page counter value
									count++;													//incrementing count every time we click 'load more' so it will load next page
									$(this).hide();												//hiding this button because we will be using #next-latest-btn from now on instead (built this way so we can update total posts variable on the fly)
								});
								
								$(document).on('click', '#next-latest-btn', function() {	//every time we click the load more button for latest posts...  !!!NOTE!!! the $(document).on('click', 'DOM ELEMENT' function will look for new dom elements every time it's called. This is very useful to look for new loop elements (in this case the load more button)
									$(this).hide();												//hide this button because we are about to load that same button again when loading loop-cat.php
									var totalPages = $(this).attr('value');						//obtaining the number of pages in the query from the load more button in index.php and adding it to a totalPages var  
									loadVidPages(count);										//calling the loadVidPages function and passing on our page counter value
									count++;													//incrementing count every time we click 'load more' so it will load next page
									if (count > totalPages) {									//if count reaches a value higher than total pages we won't need a 'load more' button anymore  !!!! do we need this here?????????????? MAYBE CHANGE THIS TO CAT METHOD
										$(this).hide();											//so we hide it
									}						
									return false;					
								});
								
								$(document).on('click', '#next-cat-btn', function() {			//every time we click the load more button for categories... 										
									$(this).hide();												//hide this button because we are about to load that same button again when loading loop-cat.php
									var totalPages = $(this).attr('pagesvalue');				//obtaining the number of pages in the query from the load more button in loop-cat.php and adding it to a totalPages var
									cat = $(this).attr('catvalue');								//fetching the cat value from #next-cat-btn 	
									loadCatPages(count, cat);									//calling our loadCatPages functions and passing count(pages) and cat			
									count++;													//incrementing count every time we click 'load more' so it will load next page									
									
								return false;					
								});
												
							});
														
						</script>
		

		<?php
		
			if ( is_home() || is_front_page() ) {				
				$active_div = "#latest";
				$loop_file = "loop-latest";
			
			}
			elseif ( is_page_template('user-vids.php') ) {
				$active_div = "#user-vids";
				$loop_file = "loop-user-vids";
			}			
			elseif ( is_author() ) {
				$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
				$curauthid = $curauth -> ID; // We need pass current author info to loop-author.php using $curauthid 
				$active_div = "#author-vids";
				$loop_file = "loop-author";				
			}
			else {				// TESTING CAT LOOP
				$active_div = "#latest";
				$loop_file = "loop-latest";
			
			}
		?>
		
		<script>
		
			function loadLatest(){
					$.ajax({
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: "action=infinite_scroll&page_no=1"<?php if ( is_author() ) :?> + '&author_id=<?php echo $curauthid;?>'<?php endif;?> + '&loop_file=loop-latest',
						beforeSend : function(){
								$("<?php echo $active_div; ?>").empty();
								$("<?php echo $active_div; ?>").append('<div id="temp_load" style="text-align:center">\
								<img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif" />\
								</div>');							
						},                        
											
						success: function(html){							
						$("<?php echo $active_div; ?>").append(html);   // This will be the div where our content will be loaded
						$("#temp_load").remove();
						$("html, body").animate({ scrollTop: $("#page1").offset().top }, 1000);
						}
					});					
				
				return false;
			}
			
			function loadCat(cat){
				$.ajax({
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: "action=infinite_scroll&page_no=1"<?php if ( is_author() ) :?> + '&author_id=<?php echo $curauthid;?>'<?php endif;?> + '&loop_file=loop-cat'+ '&cat=' +cat,
						beforeSend : function(){
								$("<?php echo $active_div; ?>").empty();
								$("<?php echo $active_div; ?>").append('<div id="temp_load" style="text-align:center">\
								<img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif" />\
								</div>');							
						},                        
											
						success: function(html){							
						$("<?php echo $active_div; ?>").append(html);   // This will be the div where our content will be loaded
						$("#temp_load").remove();						
						$("html, body").animate({ scrollTop: $("#page1").offset().top }, 1000);
						}						
					});					
				
				return false;
			}
			
										
			function loadVidPages(pageNumber){
					$.ajax({
						url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
						type:'POST',
						data: "action=infinite_scroll&page_no="+ pageNumber<?php if ( is_author() ) :?> + '&author_id=<?php echo $curauthid;?>'<?php endif;?> + '&loop_file=<?php echo $loop_file;?>',
						beforeSend : function(){
							if(pageNumber != 1){
									$("<?php echo $active_div; ?>").append('<div id="temp_load" style="text-align:center">\
									<img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif" />\
									</div>');
							}
						},                        
											
						success: function(html){							
						$("<?php echo $active_div; ?>").append(html);   // This will be the div where our content will be loaded
						$("#temp_load").remove();
						$("html, body").animate({ scrollTop: $("#page"+ pageNumber).offset().top }, 1000);	//pointing the first post of each page
						}
					});					
				
				return false;
			}
			
			function loadCatPages(pageNumber, cat){
				
				$.ajax({
					url: "<?php bloginfo('wpurl') ?>/wp-admin/admin-ajax.php",
					type:'POST',
					data: "action=infinite_scroll&page_no="+ pageNumber<?php if ( is_author() ) :?> + '&author_id=<?php echo $curauthid;?>'<?php endif;?> + '&loop_file=loop-cat'+ '&cat='+ cat,
					beforeSend : function(){
						if(pageNumber != 1){
								$("<?php echo $active_div; ?>").append('<div id="temp_load" style="text-align:center">\
								<img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif" />\
								</div>');								
						}
					},                        
										
					success: function(html){					
					$("<?php echo $active_div; ?>").append(html);   // This will be the div where our content will be loaded
					$("#temp_load").remove();
					$("html, body").animate({ scrollTop: $("#page"+pageNumber).offset().top }, 1000);	//pointing the first post of each page
					}
				});						
			return false;
			}
			
						
			</script>



		
		<!---------------- the scripts below can be added via functions.php using WP hooks - read more about this!!!
		<!-- ajaxing our featured posts -->
		<script>
		jQuery(function($) {
			$('#featured').on('click', '#featuredpg a', function(e){
			e.preventDefault();
			var link = $(this).attr('href');
			$('#featured').after('<div id="load-icon" style="text-align:center">\
									<img src="<?php bloginfo( 'template_url' );?>/images/ajax-loader.gif" />\
									</div>');	
			$('#featured').animate(
				{opacity: 0}, 500, function(){	
			
					$(this).load(link + ' #featured', function() {
						$(this).animate({opacity: 1}, 500								
						);
						$('#load-icon').remove();
					});	
					return false;
				});
			});
		});		
		</script>
		
		<!-- FIXING ACF CATEGORY BUG - This ajax bug is probably because we are using 2 forms on the same page with the same id -->
		<script>
		//whenever we change category there's an ajax action "acf%2Flocation%2Fmatch_field_groups_ajax" being called which adds the class 'acf-hiden' to the form making it disapear. The code below removes that class
		jQuery(document).ajaxComplete( function( event, XMLHttpRequest, ajaxOptions ){ //once the ajax runs
		var str = ajaxOptions.data;	//adding str var to simplify our code 
		var search_string = "acf%2Flocation%2Fmatch_field_groups_ajax"; //the ajax call we'll be looking for
		if (str.search(search_string) > 0) {	//if found i.e. if the call is made
		jQuery("#acf_69").removeClass("acf-hidden");	//remove the bug added class	
		}
		});
		</script>


		<!-- featured videos slider 
		<script type="text/javascript">
			// Can also be used with $(document).ready()
			jQuery(window).load(function() {
				jQuery('.flexslider').flexslider({
					animation: "slide"
				});
			});
		</script>
		-->
					

		<div class="credits col-md-7">
		<?php echo get_theme_mod('copyright_details');?>
		</div>

		<?php wp_footer();?>
		</div>
	</body>
</html>