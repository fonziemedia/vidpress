<?php
//registering scripts
function svs_scripts() {

        if (!is_admin()) { //If not WP Admin

            $template_url = get_bloginfo('template_url'); //Variable theme path below

            wp_deregister_script('jquery'); //Deregister default JQ

            wp_register_script('jquery', "http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js", '1.11');
                wp_enqueue_script('jquery'); //Enqueue Google JQ
				
			wp_register_script('bstrap', "$template_url/js/bootstrap.min.js", array('jquery'));
            wp_enqueue_script('bstrap'); //Enqueue your script(s)
			
			wp_register_script('jquery_val', "$template_url/js/jquery.validate.js", array('jquery')); //jquery validation plugin
            wp_enqueue_script('jquery_val'); 
			
			wp_register_script('jquery_form', "$template_url/js/jquery.form.js", array('jquery')); //jquery validation plugin
            wp_enqueue_script('jquery_form'); 
			
			wp_register_script('flexslider', "$template_url/js/jquery.flexslider.js", array('jquery')); //TBC!!!!!!!!!!!!!! NOT IN USE
            wp_enqueue_script('flexslider'); 

            wp_register_script('vscripts', "$template_url/js/vidscout.js", array('jquery'), '1.0'); //CHANGE NAME TO SEARCHFORM AND MINIFY !!!!!!!!
            wp_enqueue_script('vscripts'); 
			
        } 
    }

add_action('wp_enqueue_scripts', 'svs_scripts');



/* --------------------------------- INCLUDING PLUGINS ---------------------------------------------

//ACF
//define( 'ACF_LITE' , true ); // this hides ACF from menu
include_once('advanced-custom-fields/acf.php');
//ACF Validated Field
include_once('validated-field-for-acf/validated_field.php'); /////////////////////// DO WE REALLY NEED THIS ONE??? CHECK IF WE CAN USE THE JQUERY VALIDATION TO DO WHAT THIS DOES


//Register ACF fields
if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_add_video',
		'title' => 'Add_video',
		'fields' => array (
			array (
				'key' => 'field_53701ca623c65',
				'label' => 'Title',
				'name' => 'title',
				'type' => 'text',
				'required' => 1,
				'default_value' => '',
				'placeholder' => 'enter the title for your video',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 50,
			),
			array (
				'key' => 'field_537e8061c8a97',
				'label' => 'Description',
				'name' => 'description',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => 'what\'s your video about?',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => 100,
			),
			array (
				'key' => 'field_53b4955981c40',
				'label' => 'Category',
				'name' => 'category',
				'type' => 'taxonomy',
				'taxonomy' => 'category',
				'field_type' => 'select',
				'allow_null' => 1,
				'load_save_terms' => 1,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array (
				'key' => 'field_53b5bd3f42dd8',
				'label' => 'Link to your video',
				'name' => 'video_link',
				'type' => 'validated_field',
				'instructions' => 'SVS only supports YouTube, for support to other platforms get our premium version!',
				'required' => 1,
				'read_only' => 'false',
				'drafts' => 'true',
				'sub_field' => array (
					'type' => 'text',
					'key' => 'field_53b5bd3f42dd8',
					'name' => 'video_link',
					'_name' => 'video_link',
					'id' => 'acf-field-video_link',
					'value' => '',
					'field_group' => 'acf_add_video',
					'default_value' => '',
					'placeholder' => 'please enter a valid video url here',
					'prepend' => '',
					'append' => '',
					'formatting' => 'html',
					'maxlength' => '',
				),
				'mask' => '',
				'function' => 'regex',
				'pattern' => '^(?:https?://)?(?:www\\.)?(?:youtube\\.com|youtu\\.be)/watch\\?v=([^&]+)',
				'message' => 'The provided url is not a valid YouTube link',
				'unique' => 'non-unique',
				'unique_statuses' => array (
					0 => 'publish',
					1 => 'future',
				),
			),
			array (
				'key' => 'field_53701c4623c64',
				'label' => 'About your video',
				'name' => 'content',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => 'Write about your video',
				'maxlength' => 3000,
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'user_type',
					'operator' => '==',
					'value' => 'administrator',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			array (
				array (
					'param' => 'user_type',
					'operator' => '==',
					'value' => 'author',
					'order_no' => 0,
					'group_no' => 1,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (			//HIDE THE CONTENT AND TRY TO HIDE THE TITLE TOO HERE!!!!
			),
		),
		'menu_order' => 0,
	));
}

*/

// --------------------------------- INCLUDING BOOTSTRAP NAV MENU ---------------------------------------------

// Register Custom Navigation Walker for bootstrap
require_once('wp-bootstrap-navwalker.php');


// ================================== NAV MENUS ===========================================

// Register Nav menu's including primary menu for bootstrap
add_theme_support( 'menus');
// Create Nav Menu
if (function_exists ('register_nav_menus')) {
	register_nav_menus( array(
    'visitors' => __( 'Visitors Menu', 'Super Video Scout' ),
	'members' => __( 'Members Menu', 'Super Video Scout' ),
) );
}



//update_option('menu_check', false); //uncomment to reset menu (run only once)
//Adding default menu items
$run_once = get_option('menu_check');
if (!$run_once){
    //give your menu a name
    $menu1_name = 'Visitors';
	$menu2_name = 'Members';
    //create the menu
    $menu1_id = wp_create_nav_menu($menu1_name);
    $menu2_id = wp_create_nav_menu($menu2_name);
    //then get the menu object by its name
    $menu1 = get_term_by( 'name', $menu1_name, 'nav_menu' );			//quite an useful WP function get_term_by();  investigate more
    $menu2 = get_term_by( 'name', $menu2_name, 'nav_menu' );

    //then add the actually link/ menu item and you do this for each item you want to add

		
	//create home menu item for visitors menu
	$home_1 = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __('HOME'),
		'menu-item-classes' => 'home',
		'menu-item-url' => home_url( '/' ), 
		'menu-item-status' => 'publish',
		'menu-item-position' => 1,
		));
		
	//create home menu item for members menu
	$home_2 = wp_update_nav_menu_item($menu2->term_id, 0, array( 
		'menu-item-title' =>  __('HOME'),
		'menu-item-classes' => 'home',
		'menu-item-url' => home_url( '/' ), 
		'menu-item-status' => 'publish',
		'menu-item-position' => 1,
		));
		
	
	$about_1 = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __('ABOUT'),
		'menu-item-url' => '#about', 
		'menu-item-status' => 'publish',
		'menu-item-position' => 2,
		));
		
	$about_2 = wp_update_nav_menu_item($menu2->term_id, 0, array( 
	'menu-item-title' =>  __('ABOUT'),
	'menu-item-url' => '#about', 
	'menu-item-status' => 'publish',
	'menu-item-position' => 2,
	));
		
	$login_1 = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __('LOG IN'),
		'menu-item-url' => '#loginto', 
		'menu-item-status' => 'publish',
		'menu-item-position' => 3,
		));
	
	$myvideos_url = get_permalink( get_page_by_path( 'sample-page' ) );
	$myvideos_2 = wp_update_nav_menu_item($menu2->term_id, 0, array( 
		'menu-item-title' =>  __('MY VIDEOS'),
		'menu-item-url' => $myvideos_url, 
		'menu-item-status' => 'publish',
		'menu-item-position' => 3,
		));
	
	
	$register_1 = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __('REGISTER'),
		'menu-item-url' => '#register',
		'menu-item-status' => 'publish',
		'menu-item-position' => 4,
		));
		
	$addvideo_2 = wp_update_nav_menu_item($menu2->term_id, 0, array( 
		'menu-item-title' =>  __('SUBMIT VIDEO'),
		'menu-item-url' => '#addvideo',
		'menu-item-status' => 'publish',
		'menu-item-position' => 4,
		));
		

		
	$search_1 = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __(''),
		'menu-item-classes' => 'svs-search-icon',
		'menu-item-url' => '#', 
		'menu-item-attr-title' => 'glyphicon-search', 
		'menu-item-status' => 'publish',
		'menu-item-position' => 5,
		));
		
	//Sub menu item (first child)
	$search_1_child = wp_update_nav_menu_item($menu1->term_id, 0, array( 
		'menu-item-title' =>  __('Search site'),
		'menu-item-classes' => 'svs-search',
		'menu-item-url' => '#', 
		'menu-item-status' => 'publish',
		'menu-item-parent-id' => $search_1,
		));
		
	$search_2 = wp_update_nav_menu_item($menu2->term_id, 0, array( 
		'menu-item-title' =>  __(''),
		'menu-item-classes' => 'svs-search-icon',
		'menu-item-url' => '#', 
		'menu-item-attr-title' => 'glyphicon-search', 
		'menu-item-status' => 'publish',
		'menu-item-position' => 5,
		));
		
	//Sub menu item (first child)
	$search_2_child = wp_update_nav_menu_item($menu2->term_id, 0, array( 
		'menu-item-title' =>  __('Search site'),
		'menu-item-classes' => 'svs-search',
		'menu-item-url' => '#', 
		'menu-item-status' => 'publish',
		'menu-item-parent-id' => $search_2,
		));
	
	/*Sub Sub menu item (first child)
	$search_2nd_child = wp_update_nav_menu_item($menu->term_id, 0, array( 
		'menu-item-title' =>  __('Second_Child'),
		'menu-item-classes' => 'home',
		'menu-item-url' => home_url( '/' ), 
		'menu-item-status' => 'publish',
		'menu-item-parent-id' => $first_child,
		));
	*/

    //then you set the wanted theme  location
    $locations = get_theme_mod('nav_menu_locations');
    $locations['visitors'] = $menu1->term_id;
    $locations['members'] = $menu2->term_id;
    set_theme_mod( 'nav_menu_locations', $locations );

    // then update the menu_check option to make sure this code only runs once
    update_option('menu_check', true);
	// this code will run only once to setup the menu. If you need to run it again remember to set this to false outside the if statement (see above code before this function)
}



/*******************************
 Get Menu Item ID
 @since: v1.0
 @author: Tiaan Swart
 @params:
    $menu_id - The menu ID in which the item you are looking for is located
    $item_name - The name of the item which you are looking for
    $item_type - The type of menu item (ie. page, post, custom), the default is custom
********************************/
function ts_get_menu_item_id( $menu_id, $item_name, $item_type = 'custom' ) {

    //If there is no Menu ID or Item Name specified return false
    if ( empty($menu_id) ) {
        return FALSE;
    } elseif ( empty($item_name) ) {
        return FALSE;
    }

    //If the Item Type specified is not a normal item type change it to custom
    if ( in_array( $item_type, array( 'custom', 'page', 'post', 'default' ) ) ) {
		$item_type = $item_type;
	} else {
		$item_type = 'custom';
	}

    //Get the global wordpress database class
    global $wpdb;

    //build the query we are going to use to extract the id from the database
    //we only need the ID of the menu item, which is the ID of the nav_menu_item in the wp_posts table
    $query = 'SELECT ID ';
    //we are going to work with data from 3 tables wp_posts, wp_term_relationships and wp_postmeta lets add them to the mix
    $query .= 'FROM '.$wpdb->posts.', '.$wpdb->term_relationships.', '.$wpdb->postmeta.' ';
    //now lets specify the conditions
    $query .= 'WHERE ';
    //we need to refine our query to only show rows from the 3 tables where the ID's match
    $query .= 'ID = object_id AND ID = post_id ';
    //we also only want menu items from the given menu id
    $query .= 'AND term_taxonomy_id = "'.$menu_id.'" ';
    //we also only want menu items matching the given item name
    $query .= 'AND post_title = "'.$item_name.'" ';
    //return rows from wp_posts that are published only
    $query .= 'AND post_status = "publish" ';
    //return rows from wp_posts that are menu items only
    $query .= 'AND post_type = "nav_menu_item" ';
    //return rows from wp_postmeta where the meta key is menu item object
    $query .= 'AND meta_key = "_menu_item_object" ';
    //return rows from wp_postmeta where the meta value for menu item object matches the given item type
    $query .= 'AND meta_value = "'.$item_type.'" ';
    //the query is now complete

    //lets run the query and return the result as a variable

    return $wpdb->get_var( $query );
}




	

//adding data-toggle=modal attribute to custom wordpress menu items
add_filter( 'nav_menu_link_attributes', 'wp_addvideo_menuitem_atts', 10, 3 );
function wp_addvideo_menuitem_atts( $atts, $item, $args )
{
  //Obtaining the ID of the target menu item

  //Defining our menu names
    $name1 = 'Visitors';
    $name2 = 'Members';
	
  //then get the menu object by its name
    $menu1 = get_term_by( 'name', $name1, 'nav_menu' );
    $menu2 = get_term_by( 'name', $name2, 'nav_menu' );
	
  //!!! This might be problematic, the reference to name should not be case sensitive and user might want to customize menu items
  //Any way to get the menu item name into a variable?? investigate this !!!
	$item_about = 'ABOUT';
	$item_register = 'REGISTER';
	$item_loginto = 'LOG IN';
	$item_addvideo = 'SUBMIT VIDEO';
	  
	$about1_id = ts_get_menu_item_id( $menu1->term_id, $item_about, $item_type = 'custom' );
	$about2_id = ts_get_menu_item_id( $menu2->term_id, $item_about, $item_type = 'custom' );   
	$register_id = ts_get_menu_item_id( $menu1->term_id, $item_register, $item_type = 'custom' ); 
	$loginto_id = ts_get_menu_item_id( $menu1->term_id, $item_loginto, $item_type = 'custom' ); 
	$addvideo_id = ts_get_menu_item_id( $menu2->term_id, $item_addvideo, $item_type = 'custom' );   
	  
   
  
  $menu_target = array(
        'addvideo' => $addvideo_id,
		'loginto' => $loginto_id,
		'register' => $register_id,
		'about' => $about1_id, $about2_id 	
		);
		
  // inspect $item
  if (in_array($item->ID, $menu_target)) {
    $atts['data-toggle'] = 'modal';
  }
  return $atts;
}

//Renaming the default 'posts' to 'video/s'
function revcon_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Videos';
    $submenu['edit.php'][5][0] = 'All Videos';
    $submenu['edit.php'][10][0] = 'Add Video';
    $submenu['edit.php'][16][0] = 'Video Tags';
    echo '';
}
function revcon_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Videos';
    $labels->singular_name = 'Video';
    $labels->add_new = 'Add Video';
    $labels->add_new_item = 'Add Video';
    $labels->edit_item = 'Edit Video';
    $labels->new_item = 'Video';
    $labels->view_item = 'View Video';
    $labels->search_items = 'Search Video';
    $labels->not_found = 'No Videos found';
    $labels->not_found_in_trash = 'No Videos found in Trash';
    $labels->all_items = 'All Videos';
    $labels->menu_name = 'Videos';
    $labels->name_admin_bar = 'Videos';
}
 
add_action( 'admin_menu', 'revcon_change_post_label' );
add_action( 'init', 'revcon_change_post_object' );



// Hiding the original add post field (check if it's possible to do this via ACF exported options !!! ALSO, THE BELOW IS A GOOD EXAMPLE ON HOW TO USE ADD ACTIONS TO CHANCE APPEARANCE/CSS !!!
add_action('admin_head', 'hide_edit_title_admin_css'); //hooking to admin-head
function hide_edit_title_admin_css() {


global $pagenow;
global $post_type;						//!! very useful global variables for ADMIN SECTION ONLY!

	
	if ( ($pagenow == 'post-new.php'  || $pagenow == 'post.php') && $post_type == 'post' ) : 	//on add post and edit post admin pages only
		?>
		<style type="text/css">			
		#title, #title-prompt-text
		{
			display: none;				<!-- hidding the elements we don't want to see, the orignal title field needs to be populated otherwise it won't post, thus the js code below -->
		}
		</style>
		<?php
	endif;
}
	


// Populating original add post field so we can submit the form (if we don't do this the post won't be created !!!! ALSO, THE BELOW IS A GOOD EXAMPLE ON HOW TO HOOK AND USE JQUERY TO OWN WP !!!
add_action('admin_footer', 'add_jquery_to_admin_footer'); //hooking to admin-footer
function add_jquery_to_admin_footer() {

global $pagenow;
global $post_type;						//!! very useful global variables for ADMIN SECTION ONLY!

	
	if ( ($pagenow == 'post-new.php'  || $pagenow == 'post.php') && $post_type == 'post' ) : 	//on add post and edit post admin pages only
		?>
		<script>													//adding jquery code to populated original title field before submiting our form
		jQuery(function($) {
			$('#publish').click(function() {						//on submit click
				var acfValue = $('#acf-field-post_title').val(); 	//get the value of our acf title field
				$('#title').val(acfValue);						 	//and add it to the original title field value (which we've hidden before)
			});
		});
		</script>
		<?php
	endif;
}


/*Editing custom post name field to 'Enter the title for your video' (in admin form only)
add_filter('gettext','custom_enter_title');

function custom_enter_title( $input ) {

    global $post_type;

    if( is_admin() && 'Enter title here' == $input && 'post' == $post_type )
        return "Enter the title for your video";

    return $input;
}
*/


//adding thumbnails to posts
if (function_exists ('add_theme_support')) {
	add_theme_support( 'post-thumbnails');
}

//adding different thumbnail sizes
if (function_exists ('add_image_size')) {
	add_image_size( 'featured', 400, 250, true );
	add_image_size( 'post-thumb', 200, 75, true );
}



/* function for getting and showing view count on posts */
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 Views";
    }
    return $count.' Views';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

/* this function is to bring the widgets to our admin area and our site
Note: the call for widgets in wordpress is register_sidebar even though we can add them anywhere we want */
/**
 * Register our sidebars and widgetized areas.
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Footer Widgets',
		'id' => 'footer-widgets',
		'description' => 'Place widgets for the footer here.',
		'before_widget' => '<div class="col-md-4">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
	
	register_sidebar( array(
		'name' => 'Sidebar Widgets',
		'id' => 'sidebar-widgets',
		'description' => 'Place widgets for the sidebar here.',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );



//adding the bootstrap glyph class to the wp next prev posts function (for our featured posts buttons)
add_filter('next_posts_link_attributes','example_add_next_link_class');
function example_add_next_link_class($attr) {
  return $attr . ' class="glyphicon glyphicon-chevron-right"';
}

add_filter('previous_posts_link_attributes','example_add_previous_link_class');
function example_add_previous_link_class($attr) {
  return $attr . ' class="glyphicon glyphicon-chevron-left"';
}


// Customizing comments
function custom_comments ($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
      <header class="comment-header">
         <?php echo get_avatar($comment,$size='48',$default='' ); ?>
         <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
         <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
      </header>
      <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('Your comment is awaiting moderation.') ?></em>
         <br>
      <?php endif; ?>

      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
    <?php
}


function my_pre_save_post( $post_id ){ //this function will get $post_id from add_post.php or edit_post.php
    
		
	if( $post_id != 'new' )	{	// check if this is to be an edit instead of a new post	
    	
	//If it's an edit
	$editpost = array(
		'ID' => $post_id,
		'post_status'  => 'publish',
		'post_title'  =>  $_POST['fields']['field_53701ca623c65'],				//!!!!!!!!!!! Check if there's another way to do this - I don't think these fields will remain the same
		'post_content' => $_POST['fields']['field_53701c4623c64'],				//even if the plugin is added to the theme
		'post_category'	=> array($_POST['fields']['field_53b4955981c40']),
		'post_type'  => 'post'
    );
		
        $post_id = wp_update_post( $editpost ); // update the post 		
    }
	else {  
	
		// Create the post
	$addpost = array(
		'post_status'  => 'publish',
		'post_title'  =>  $_POST['fields']['field_53701ca623c65'],				//!!!!!!!!!!! Check if there's another way to do this - I don't think these fields will remain the same
		'post_content' => $_POST['fields']['field_53701c4623c64'],				//even if the plugin is added to the theme
		'post_category'	=> array($_POST['fields']['field_53b4955981c40']),
		'post_type'  => 'post'
    );
    
		$post_id = wp_insert_post( $addpost ); // insert the post
	}
  
  return $post_id;	// return the post (new or edited)
}
  
add_filter('acf/pre_save_post' , 'my_pre_save_post' );


// fixing ACF acf_form_head(); conflict
add_action( 'wp_print_styles', 'my_deregister_styles', 100 );
 
function my_deregister_styles() {
	wp_deregister_style( 'wp-admin' );
}


/* ===================================== LOGOUT ==========================*/

//styling wp_loginout
add_filter('loginout', 'loginout_selector');
function loginout_selector($text) {

$current_user = wp_get_current_user();
$selector = '<span class="glyphicon glyphicon-user"></span>';
$text = str_replace('>Log out</a>', '>' . $selector . ' LOG OUT (' . $current_user->user_login . ') </a>', $text);
return $text;
}

//adding wp_loginout to nav menu (only when logged in of course)
/* I've added an if statement here so it only shows Logout button. This because Login button must be a custom menu item so we can use a modal on it */
if ( is_user_logged_in() ) :
/* LogIn - LogOut*/
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);
function add_login_logout_link($items, $args) {

		ob_start();								//intercepting mother-ship's frequency
		wp_loginout('index.php');				//outputing the logout function to the buffer? - redirects to index.php
		$loginoutlink = ob_get_contents();		//ob_get_contents simply gets the contents of the output buffer since you called ob_start(), we add those contents to a variable 
		ob_end_clean();							//shutting down our sonar
		
		$items .= '<li class="logout-btn">' . $loginoutlink . '</li>';

	return $items;								//returning our capitalised logout button
	
}
endif;
/* LogIn - LogOut END */



/* Disable Admin Bar for All Users Except for Administrators*/
add_action('after_setup_theme', 'remove_admin_bar');

function remove_admin_bar() {
if (!current_user_can('administrator') && !is_admin()) {
show_admin_bar(false);
}
}


//========================= VIDEO CONTROLS =================================
 
//YouTube 
// Filter video output
add_filter('oembed_result','lc_oembed_result', 10, 3);
function lc_oembed_result($ythtml, $yturl, $ytargs) {
 
    // $args includes custom argument
 
	$ytnewargs = $ytargs;
	// get rid of discover=true argument
	array_pop( $ytnewargs );
 
	$ytparameters = http_build_query( $ytnewargs );
 
	// Modify video parameters
	$ythtml = str_replace( '?feature=oembed', '?feature=oembed'.'&amp;'.$ytparameters, $ythtml );
 
    return $ythtml;
} 

//Vimeo
add_filter( 'oembed_fetch_url','add_param_oembed_fetch_url', 10, 3);
add_filter( 'oembed_result', 'add_player_id_to_iframe', 10, 3);

/** add extra parameters to vimeo request api (oEmbed) */
function add_param_oembed_fetch_url( $vmprovider, $vmurl, $vmargs) {
    // unset args that WP is already taking care
    $vmnewargs = $vmargs;
    unset( $vmnewargs['discover'] );
    unset( $vmnewargs['width'] );
    unset( $vmnewargs['height'] );

    // build the query url
    $vmparameters = urlencode( http_build_query( $vmnewargs ) );

    return $vmprovider . '&'. $vmparameters;
}

/** add player id to iframe id on vimeo */
function add_player_id_to_iframe( $vmhtml, $vmurl, $vmargs ) {
    if( isset( $vmargs['player_id'] ) ) {
        $vmhtml = str_replace( '<iframe', '<iframe id="'. $vmargs['player_id'] .'"', $vmhtml );
    }
    return $vmhtml;
}

//========================= REDIRECTS =================================

/*redirect when deleting posts !!!! NOT WORKING ON BACK END!!! 
add_action( 'trashed_post', 'wpse132196_redirect_after_trashing', 10 );
function wpse132196_redirect_after_trashing() {
	wp_redirect( home_url('/?page_id=2?deleted=true') );
    exit;
}
*/


/**
 * Redirect user after successful login.
 *
 * @param string $redirect_to URL to redirect to.
 * @param string $request URL the user is coming from.
 * @param object $user Logged user's data.
 * @return string
 */
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			return $redirect_to;
		} else {
			return home_url();
		}
	} else {
		return $redirect_to;
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


//========================= Pagination =================================

//infinite loop - pagination
function wp_infinitepaginate(){

	$loopFile		= $_POST['loop_file'];
	$paged			= $_POST['page_no'];		
	$posts_per_page	= get_option('posts_per_page');

	# Load the posts
	query_posts(array('paged' => $paged ));
	get_template_part( $loopFile );

exit;

}
// Adding the above to wp_ajax	
// The default action for WordPress ajax would be wp_ajax_(our action name), hence why the name infinite_scroll being used below, this is what we're calling it.
// We need to add two actions, one for logged in users and another is for users that are not logged in.
add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate'); //for logged in user
add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate'); //if user not logged in




//========================= SET THE NUMBER OF POSTS TO DISPLAY ON CAT PAGES ==================

function main_query_mods( $query ) {
    // check http://codex.wordpress.org/Conditional_Tags to play with other queries
    if(!$query->is_main_query()) {
        return;
    }
    if(is_category()) { // is_tag can be used here for tags
        $query->set('posts_per_page',8);
    }
}
add_action( 'pre_get_posts', 'main_query_mods' );




//========================= THEME CUSTOMIZATION ======================


$defaults = array(
	'default-image'          => '/images/logo.png',
	'random-default'         => false,
	'width'                  => 50,
	'height'                 => 50,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);
add_theme_support( 'custom-header', $defaults );

//registering our customisation section(s), settings and controls
function svs_customizer_register ($wp_customize){

//removing default customisation settings
	//title_tagline - Site Title & Tagline
	//colors - Colors
	//header_image - Header Image
	//background_image - Background Image
	//nav - Navigation
	//static_front_page - Static Front Page
	
	$wp_customize->remove_section('nav'); //removing this section as we don't want our users to mess up our bootstrap menu with modals
	$wp_customize->remove_section('header_image'); //removing this section as we're going to have it as a display option
	$wp_customize->remove_section('colors'); //removing this section as we're going to have it as a display option
	
	
//adding our own customisation settings

	//the theme colors customisation section 
	$wp_customize->add_section('svs_colors', array(
		'title' => __('Colors', 'Super Video Scout'),
		'description' => 'Modify Theme Colors',
		'priority'   => 2
		
	));
		//customise the background color
		$wp_customize->add_setting('background_color', array(
			'default' => '#ffffff'
		));
			//background color control
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'background_color', array(
			'label' => __('Edit Background Color', 'Super Video Scout'),
			'section' => 'svs_colors',
			'settings' => 'background_color'
			)));
			
		//customise our headers color
		$wp_customize->add_setting('headers_color', array(
			'default' => '#4b4b4b'
		));
			//links color control
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headers_color', array(
			'label' => __('Edit Headers Color', 'Super Video Scout'),
			'section' => 'svs_colors',
			'settings' => 'headers_color'
			)));
		
		//customise our links color
		$wp_customize->add_setting('link_color', array(
			'default' => '#428BCA'
		));
			//links color control
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
			'label' => __('Edit Link Color', 'Super Video Scout'),
			'section' => 'svs_colors',
			'settings' => 'link_color'
			)));
		
		//customise our links hover color
		$wp_customize->add_setting('link_hover_color', array(
			'default' => '#2a6496'
		));	
			//links hover color control
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
			'label' => __('Edit Link Hover Color', 'Super Video Scout'),
			'section' => 'svs_colors',
			'settings' => 'link_hover_color'
			)));
	
	
	//the theme's logo customisation section
	$template_url = get_bloginfo('template_url'); //Variable theme path for our default img
	$def_logo_path = $template_url."/images/thumbnail01.png";
	
	
	$wp_customize->add_section('title_tagline', array(
			'title' => __('Title, Tagline & Logo', 'Super Video Scout'),
			'description' => 'Edit Site Title, Tagline & Logo',
			'priority'   => 1
		));
	
		//enabling logo image customisation under title_tagline options
		$wp_customize->add_setting('logo_image', array(
			'default' => $def_logo_path
		));
			//image control
			$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo_image', array(
			'label' => __('Logo Image', 'Super Video Scout'),
			'section' => 'title_tagline',
			'settings' => 'logo_image'
			)));
	
	//the theme's copyright customisation section				
		$wp_customize->add_section('svs_copyright', array(
			'title' => __('Copyright Details', 'Super Video Scout'),
			'description' => 'Add/Edit Copyright Information',
			'priority'   => 9999
		));
			//customise our logo image
			$wp_customize->add_setting('copyright_details', array(
				'default' => '&copy; 2014 Super Video Scout all rights reserved (v.0.4)'
			));
				//image control
				$wp_customize->add_control('copyright_details', array(
				'label' => __('Copyright Information', 'Super Video Scout'),
				'section' => 'svs_copyright',
				'settings' => 'copyright_details'
				));
				
	//the theme's layout settings				
		$wp_customize->add_section('svs_layout', array(
			'title' => __('Layout Settings', 'Super Video Scout'),
			'description' => "Change Theme's Layout Configuration",
			'priority'   => 3
		));
			//our default top layout setting
			$wp_customize->add_setting('top_layout_setting', array(
				'default' => 'featured'
			));		
				//radio button options
				$wp_customize->add_control('top_layout_control', array(
				'label' => __('Top Section Display', 'Super Video Scout'),
				'section' => 'svs_layout',
				'settings' => 'top_layout_setting',
				'type' => 'radio',
				'choices' => array(
					'featured' => 'Featured Videos',
					'banner' => 'Site Logo/Banner Image',
					)
				));
				
			//our default content layout setting
			$wp_customize->add_setting('content_layout_setting', array(
				'default' => 'thumbs'
			));		
				//radio button options
				$wp_customize->add_control('content_layout_control', array(
				'label' => __('Content Display', 'Super Video Scout'),
				'section' => 'svs_layout',
				'settings' => 'content_layout_setting',
				'type' => 'radio',
				'choices' => array(
					'thumbs' => 'Thumbnails',
					'compressed' => 'Compressed',
					)
				));
			
}

//changing our css according to our admin settings
function svs_css_customizer() {
	?>
	<style type = "text/css">
	
		body { background-color: #<?php echo get_theme_mod('background_color'); ?>;}
		
		h1,h2,h3,h4,h5,h6,h7,h8 {color: <?php echo get_theme_mod('headers_color'); ?>;}
		
		a {	color: <?php echo get_theme_mod('link_color'); ?>;}
		
		a:hover, a:focus { color: <?php echo get_theme_mod('link_hover_color'); ?>;}
	
	<?php
	$content_layout = get_theme_mod('content_layout_setting');

	if ($content_layout == 'compressed') : ?>
		
		.the-post {
			width: 95%;
			height: 100%; <!-- important!!! -->
			margin: 5px 0 15px 0;
			border-bottom: 1px solid #eee;
		}
		
		.vid-col {
			width: 100%;

		}
		
		.vid-title {
			margin-bottom: 5px;
		}
		
		.content-show, .content-hide {
			font-size: 11px;
			float: right;
		}

		.content-layout{ display: none;}
		
	
	<?php endif;?>
		
	</style>
	
	<?php
}

add_action('wp_head', 'svs_css_customizer'); //Adding svs_css_customizer to the WP wp_head function 
add_action('customize_register', 'svs_customizer_register'); //Adding svs_customizer_register to the WP customize_register function



?>