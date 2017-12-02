<?php

get_header(); ?>


<?php


    while(have_posts()) : the_post();
        echo '<div class="jumbotron">
        <div class="text-center">';
         echo the_title();
         echo "<br>";
      echo the_content().'</div></div>';

    endwhile;
?>


<?php
get_footer();
?>