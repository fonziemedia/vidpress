<?php 
    $args = array(
        'post_id' => 'new',
		'field_groups' => array( 28 ),			// !!!change this to the field group name after exporting ACF php!!!
		'submit_value' => 'Add Video',
		'return' => add_query_arg( 'updated', 'true', get_site_url()),// return url
		);     
    acf_form( $args ); 
?>