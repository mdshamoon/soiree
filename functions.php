<?php
function themeslug_enqueue_style() {
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css',false,'1.1','all');
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap.min.css',false,'1.1','all');
}


add_action( 'wp_enqueue_scripts', 'themeslug_enqueue_style' );

function include_javascript()
{
	wp_enqueue_script( 'javas', get_template_directory_uri() . '/jquery-3.2.1.min.js',false);

	wp_enqueue_script( 'javass', get_template_directory_uri() . '/styl.js',false);
   
}

add_action( 'wp_enqueue_scripts', 'include_javascript' );


function add_guest_request()
{
	$name= $_POST['name'];
	$email= $_POST['email'];
	$phone= $_POST['phone'];
$postarr = array(
        
        'post_content' => $email,
        
        'post_title' => $name,
        
        'post_status' => 'publish',
        'post_type' => 'pending_req',
       
    );
 $id=wp_insert_post( $postarr ) ;

   update_post_meta( $id , 'phone', $phone );
 
   
 
    

	
	wp_send_json_success($name);


}

add_action('wp_ajax_add_guest_request','add_guest_request');
add_action('wp_ajax_nopriv_add_guest_request','add_guest_request');

function create_posttype() {
 
    register_post_type( 'Event',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Events' ),
                'singular_name' => __( 'Event' ),
                 'add_new_item'        => __( 'Add New Events' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Event'),
              'menu_icon'           => 'dashicons-admin-customizer',
        )
    );
    
    register_post_type( 'Guest',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Guests' ),
                'singular_name' => __( 'Guest' ),
                'add_new_item'        => __( 'Add New Guest' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'Guest'),
              'menu_icon'           => 'dashicons-admin-users',
            
        )
    );
    

    register_post_type( 'pending_req',
    // CPT Options
        array(
            'labels' => array(
                'name' => __( 'pending_reqs' ),
                'singular_name' => __( 'pending_req' ),
                'add_new_item'        => __( 'Add New pending request' ),
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'pending_req'),
              'menu_icon'           => 'dashicons-info',
            
        )
    );
    

    flush_rewrite_rules(false);
}
// Hooking up our function to theme setup
add_action( 'init', 'create_posttype' );


function wpdocs_register_meta_boxes() {
    add_meta_box( 'venue','venue', 'venue_callback', 'event' );
     add_meta_box( 'date', __( 'date', 'textdomain' ), 'date_callback', 'event' );
      add_meta_box( 'theme', __( 'theme', 'textdomain' ), 'theme_callback', 'event' );
     /* add_meta_box( 'photo', 'photo', 'photo_callback', 'event' );
*/       add_meta_box( 'Action', 'Action Request', 'request_callback', 'pending_req', 'advanced','high');
        add_meta_box( 'Phone', 'Phone', 'phone_callback', 'pending_req' );
         add_meta_box( 'Gender', 'Gender', 'gender_callback', 'pending_req' );

}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );
 
function request_callback( $post)
{
	echo "would yo like to accept :- ";
	
	
    echo '<input type="submit"  style="background-color:green;border-color:green;border-radius:4px" name="accept" id="accept" value="accept" /><input type="submit" style="background-color:red;border-color:red" name="reject" id="reject" value="reject" />';
 


}


function phone_callback( $post)
{
	echo "phone no : ";
	
	
    echo get_post_meta( $post->ID , 'phone',true);
 


}

function gender_callback( $post)
{
	echo "Gender : ";
	
	
    echo get_post_meta( $post->ID , 'venue',true);;
 


}

/*function photo_callback( $post)
{

	
     
	echo "upload a photo  ";
	
	
    echo '<input type="file" name="photo" id="photo"  />';
 


}*/
function venue_callback( $post)
{
	echo "write a venue";
	
	
    echo '<input type="text" name="venue" id="venue" value="'.get_post_meta( $post->ID , 'venue',true) .'" />';
 
 ?> <?php

}

function date_callback($post)
{
	echo "write a date";
	
	
   echo '<input type="text" name="date" id="date" value="'.get_post_meta( $post->ID , 'date',true) .'" />';
  

}

function theme_callback($post)
{
	echo "write a theme";
	
	
   echo '<input type="text" name="theme" id="theme" value="'.get_post_meta( $post->ID , 'theme',true) .'" />';
  

}



function cd_meta_box_save( $post_id )
{


    // Bail if we're doing an auto save
   if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
   
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
  
     
    // Make sure your data is set before trying to save it
    if( isset( $_POST['venue'] ) )
        update_post_meta( $post_id , 'venue', wp_kses( $_POST['venue'],'' ) );
    if( isset( $_POST['date'] ) )
        update_post_meta( $post_id , 'date', wp_kses( $_POST['date'] ,'') );
    if( isset( $_POST['theme'] ) )
        update_post_meta( $post_id , 'theme', wp_kses( $_POST['theme'],'' ) );
     

   
  
    


         
   
   
}
add_action( 'save_post', 'cd_meta_box_save' );


function accept_reject( $post_id)
{
 if(isset($_POST['accept']))
 	set_post_type($post_id,'guest');

 if(isset($_POST['reject']))
 	wp_delete_post($post_id);
 

}

add_action( 'save_post', 'accept_reject' );



//dispaly
function display_venue( $content)
{
if(is_single())
{
$html='<br>your venue is - '.get_post_meta( get_the_ID(),'venue',true);
$html.='<br>your date is - '.get_post_meta( get_the_ID(),'date',true);
$html.='<br>your theme is - '.get_post_meta( get_the_ID(),'theme',true);
$html.='<br>your image is - '.get_post_meta( get_the_ID(),'photo',true);
$content.=$html;


}
return $content;
}

add_action( 'the_content', 'display_venue' );

function get_page_id_by_title($title)
{
$page = get_page_by_title($title);
return $page->ID;
}


