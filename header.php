
<!DOCTYPE html>
<html <?php language_attributes(); ?>
>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Soiree</title>

<?php

wp_head();


?>
</head>
<body>

	<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse fixed-top">
    
      <a class="navbar-brand" href="#">Soiree</a>
      <div class="container-fluid" style="margin-top: 7px;">
      	<a href="<?php echo get_permalink(100); ?>"> <div class="btn btn-primary" style="float: right"> Register</div></a>
     <a href="<?php echo get_post_type_archive_link( 'event' ); ?>"> <div class="btn btn-primary" style="float: right;margin-right: 4px;"> Events</div></a>

  </div>

     
    </nav>

