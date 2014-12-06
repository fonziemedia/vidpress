<?php acf_form_head(); ?> <!-- this calls for ACF forms function for front end posting -->
<!DOCTYPE html>
<html>
	<head>
		<title>
		<?php
			wp_title('|', 'true', 'right');
			bloginfo('name');
		?>
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'template_url' );?>/style.css">
		<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/flexslider.css"/>
		<?php wp_head();?>
	</head>
	<body>
		<header>
			<div class="navbar navbar-inverse navbar-fixed-top">
				<?php 
				// Fix menu overlap bug..
				if ( is_admin_bar_showing() ) echo '<div style="min-height: 35px;"></div>';  // min height will control the admin navbar height
				?>
				
				<div class ="container">
					<div class ="navbar-inner">	
						<!-- Our logo & site description -->
						<?php $logo_image = get_theme_mod('logo_image'); ?> <!-- logo image can be controlled via admin panel -->
						
							<a href="<?php bloginfo( 'url' );?>" class="navbar-brand"><?php if (!empty($logo_image)):?><img src="<?php echo $logo_image;?>" alt="<?php bloginfo('name');?>" width="50" height="50" border="0"/><?php endif;?> </a>
						
							<a href="<?php bloginfo( 'url' );?>" class="navbar-brand"><?php bloginfo('name');?></a>
							
							<button class = "navbar-toggle" data-toggle = "collapse" data-target = ".navHeaderCollapse">
								<span class = "icon-bar"> </span>
								<span class = "icon-bar"> </span>
								<span class = "icon-bar"> </span>
							</button>
						
						
						<div class = "collapse navbar-collapse navHeaderCollapse">
						<?php
						//if the user is logged in, members only menu appears, if not, global menu appears
						if ( is_user_logged_in() ) :?>
						<?php
							wp_nav_menu( array(
							'menu'              => 'Members', //the menu's name as defined when creating the menu in functions.php
							'theme_location'    => 'members', // the theme's location that the menu's assigned to
							'depth'             => 2,
							'container_id'      => 'bs-example-navbar-collapse-1',
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
							);
						?>
						<?php else :?>
						<?php
							wp_nav_menu( array(
							'menu'              => 'Visitors',
							'theme_location'    => 'visitors',
							'depth'             => 2,
							'container_id'      => 'bs-example-navbar-collapse-1',
							'menu_class'        => 'nav navbar-nav navbar-right',
							'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
							'walker'            => new wp_bootstrap_navwalker())
							);
						?>
						<?php endif;?>
						</div>
					</div>			
				</div>
			</div>
		
					
		</header>
		<div class="container">
		