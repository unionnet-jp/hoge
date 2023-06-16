<?php if ('post' != get_post_type()) { $post_type = get_post_type( $post->ID ); //標準投稿以外のときに適用 ?>
  <div class="wp-pagenavi">
    <?php previous_post_link('<div class="alignleft">%link</div>', '&laquo; 前へ', ''); ?>
    <div class="center">
      <a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>">一覧へ</a>
    </div>
    <?php next_post_link('<div class="alignright">%link</div>', '次へ &raquo;', ''); ?>
  </div>
<?php } else { //標準投稿に適用 ?>
  <div class="wp-pagenavi">
    <?php previous_post_link('<div class="alignleft">%link</div>', '&laquo; 前へ', TRUE, ''); ?>
    <div class="center">
      <a href="<?php $cat = get_the_category(); echo esc_url(get_category_link($cat[0]->term_id)); ?>">一覧へ</a>
    </div>
    <?php next_post_link('<div class="alignright">%link</div>', '次へ &raquo;', TRUE, ''); ?>
  </div>
<?php } ?>