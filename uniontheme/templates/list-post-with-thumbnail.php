<li>
  <span class="thumbnail">
    <a href="<?php the_permalink(); ?>">
      <?php $args = array(
        'post_type' => 'attachment',
        'post_mime_type' => 'image',
        'posts_per_page' => -1,
        'post_status' => null,
        'post_parent' => $post->ID,
        'order' => 'ASC',
        'orderby' => 'menu_order'
      );
      $attachment = get_posts($args);
      if (has_post_thumbnail()) { //アイキャッチ画像の設定があればそちらを優先
        the_post_thumbnail('thumbnail', array('class' => 'hover'));
      } elseif ($attachment) {
        echo wp_get_attachment_image($attachment[0]->ID, 'thumbnail', false, array('class' => 'hover')); //投稿内のアップロード画像1枚目を出力
      } else { ?>
        <img src="<?php echo HOME?>img/thumbnail/thumbnail.jpg" alt="NO IMAGE" class="hover">
      <?php } ?>
    </a>
  </span>
  <span class="title">
    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
  </span>
</li>