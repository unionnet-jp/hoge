<!-- START pagenavi-image-button.php -->

<?php if('post'!=get_post_type()) { $post_type = get_post_type( $post->ID ); //標準投稿以外のときに適用 ?>
<div class="wp-pagenavi">
<?php if(function_exists('previous_post_link_plus')) { previous_post_link_plus( array('post_type' =>  '"'.$post_type.'"', 'format' => '<div class="alignleft">%link</div>', 'link' => '<img src="'.HOME.'common/img/buttons/btn_prev.jpg" alt="前の記事へ" class="hover">') ); } ?>
<div class="center"><a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>"><img src="<?php echo HOME?>common/img/buttons/btn_index.jpg" alt="一覧" class="hover"></a></div>
<?php if(function_exists('next_post_link_plus')) { next_post_link_plus( array('post_type' =>  '"'.$post_type.'"', 'format' => '<div class="alignright">%link</div>', 'link' => '<img src="'.HOME.'common/img/buttons/btn_next.jpg" alt="次の記事へ" class="hover">') ); } ?>
<!--/ .wp-pagenavi --></div>

<?php } else { //標準投稿に適用 ?>
<div class="wp-pagenavi">
<?php previous_post_link('<div class="alignleft">%link</div>', '<img src="'.HOME.'common/img/buttons/btn_prev.jpg" alt="前の記事へ" class="hover">', TRUE, ''); ?>
<div class="center"><a href="<?php $cat = get_the_category(); echo esc_url(get_category_link($cat[0]->term_id)); ?>"><img src="<?php echo HOME?>common/img/buttons/btn_index.jpg" alt="一覧" class="hover"></a></div>
<?php next_post_link('<div class="alignright">%link</div>', '<img src="'.HOME.'common/img/buttons/btn_next.jpg" alt="次の記事へ" class="hover">', TRUE, ''); ?>
<!--/ .wp-pagenavi --></div>
<?php }  ?>

<!-- END pagenavi-image-button.php -->
