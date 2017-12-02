<?php

get_header(); ?>

<h1>ccsdds<h1>

<?php
    while(have_posts()) : the_post();
        
        echo get_the_title();

    endwhile;
?>
}