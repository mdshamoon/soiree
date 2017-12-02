<?php
 get_header();

echo "string";

if(!isset($_GET['submit']))
{
   
    
    $name = $_GET['name'];
  
    $email =$_GET['email'];
    $phone =$_GET['phone'];
    $gender=$_GET['gender'];

    
    
    //error handlerd
    if(empty($name)||empty($email)||empty($phone)||empty($gender))
    {
      echo "all fields are not filled"; 
    }
    else{
        
        if(true)
        {
          echo "invalid name" ; 
        }
        else
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
               echo "enter correct email";
            }
            else
            {
                echo "thank you for successful registration".$name;
                $post_id = wp_insert_post(array (
   'post_type' => 'pending_req',
   'post_title' => $name,
   'post_content' => $email,
   'post_status' => 'publish',
   'comment_status' => 'closed',   // if you prefer
   'ping_status' => 'closed',      // if you prefer
                   ));
                 

                if ($post_id) {
   // insert post meta
   add_post_meta($post_id, 'phone', $phone);
   add_post_meta($post_id, 'gender', $gender);


            }
        }
    }

}

}