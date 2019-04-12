<?php 
/*
 Union Theme - Version: 1.3
*/
get_header(); ?>

<?php locate_template( array( 'dropdown-monthly.php' ), true, true ); //月別アーカイブドロップダウンを読み込む ?>

<?php while (have_posts()) : the_post(); ?>
<article class="single post">
<h2 class="subTtl02"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<span class="date"><?php the_time('Y.m.d'); ?></span>
<div class="body">
<?php the_content(); ?>
</div>
</article>
<?php endwhile;?>

<?php locate_template( array( 'pagenavi-default.php' ), true, true ); //ページナビテンプレートを読み込む ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>