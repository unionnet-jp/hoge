<?php 
/*
 Union Theme - Version: 1.4
*/
get_header(); ?>

<div class="c-lower_kv">
<?php if( is_page() && $post->ancestors ): $parent = end(get_post_ancestors($post->ID));  /*第二階層以下の固定ページ（第一階層のタイトルを表示します）*/?>
<img src="<?php echo HOME; ?>img/main/main_<?php echo esc_html(get_page_uri($parent));?>.jpg" alt="<?php echo apply_filters('the_title', get_the_title($parent)); ?>">
<h1><?php echo apply_filters('the_title', get_the_title($parent)); ?></h1><p><?php echo esc_html(get_page_uri($parent));?></p>

<?php elseif(is_page()): /*固定ページ*/ ?>
<img src="<?php echo HOME; ?>img/main/main_<?php echo esc_attr( esc_html($post->post_name) ); ?>.jpg" alt="<?php the_title(); ?>">
<h1><?php the_title(); ?></h1><p><?php echo esc_attr( esc_html($post->post_name) ); ?></p>
<?php endif; ?>
<!--.c-lower_kv--></div>

<?php the_content(); ?>

<?php get_footer(); ?>