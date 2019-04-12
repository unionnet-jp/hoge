<?php 
/*
 Union Theme - Version: 1.4
*/
get_header(); ?>

<?php
$first = true;
if(have_posts()):
  while(have_posts()):
    the_post();

  if($first){
    $first = false;
remove_filter('the_content','wpautop');
the_content();
add_filter('the_content','wpautop');
  }
  else
    the_excerpt();
  endwhile;
endif;
?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>