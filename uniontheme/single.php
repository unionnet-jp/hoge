<?php get_header(); ?>

<article class="single post">
  <h2 class="subTtl02"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
  <time class="date" datetime="<?php the_time('Y-m-d'); ?>"><?php the_time('Y.m.d'); ?></time>
  <div class="body">
    <?php the_content(); ?>
  </div>
</article>

<?php locate_template('templates/pagenavi-default.php', true, true); //ページナビテンプレートを読み込む ?>

<?php get_footer(); ?>