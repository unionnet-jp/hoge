<!-- START pagenavi-show-title.php -->

<?php if('post'!=get_post_type()) { $post_type = get_post_type( $post->ID ); //標準投稿以外のときに適用 ?>
<div class="wp-pagenavi">
<?php if(function_exists('previous_post_link_plus')) { previous_post_link_plus( array('post_type' =>  '"'.$post_type.'"', 'format' => '<div class="alignleft">%link</div>', 'link' => '&laquo; %title') ); } ?>
<div class="center"><a href="<?php echo esc_url(get_post_type_archive_link($post_type)); ?>">一覧へ</a></div>
<?php if(function_exists('next_post_link_plus')) { next_post_link_plus( array('post_type' =>  '"'.$post_type.'"', 'format' => '<div class="alignright">%link</div>', 'link' => '%title &raquo;') ); } ?>
<!--/ .wp-pagenavi --></div>

<?php } else{ //標準投稿に適用 ?>
<div class="wp-pagenavi">
<?php previous_post_link('<div class="alignleft">%link</div>', '&laquo; %title', TRUE, ''); ?>
<div class="center"><a href="<?php $cat = get_the_category(); echo esc_url(get_category_link($cat[0]->term_id)); ?>">一覧へ</a></div>
<?php next_post_link('<div class="alignright">%link</div>', '%title &raquo;', TRUE, ''); ?>
<!--/ .wp-pagenavi --></div>
<?php }  ?>

<!-- END pagenavi-show-title.php -->

