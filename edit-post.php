<?php
	$args = array(
		'post_id' => $post->ID,
		'field_groups' => array( 28 ), 			// !!!change this to the field group name after exporting ACF php!!!
		'submit_value' => 'Edit Video',
		'return' => add_query_arg( 'updated', 'true', get_permalink() ),// return url
);
     
    acf_form( $args );
 
?>