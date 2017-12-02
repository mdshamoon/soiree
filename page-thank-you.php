<?php
get_header();

echo "string";

if(isset($_POST['submit']))
{
    echo "string";
    
    $name = $_POST['name'];
  
    $email =$_POST['email'];
    $phone =$_POST['phone'];
    $gender=$_POST['gender'];

    
    
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