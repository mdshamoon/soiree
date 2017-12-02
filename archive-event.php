<?php

get_header(); ?>


<?php


    while(have_posts()) : the_post();
        echo '<div class="jumbotron">
        <div class="text-center">'.'<a href="'.get_the_permalink ().'">';
         echo the_title();
         echo "</a><br>";
      echo the_content().'</div></div>';
      echo get_post_meta('venue');

    endwhile;
?>


<?php
get_footer();
?>