<?php
/*
 Union Theme - Version: 1.4
*/
get_header(); ?>



<h2 class="subTtl01"><?php wp_title(''); ?></h2>

<?php if (have_posts()) : ?>
<div class="postList">
	<ul>
		<?php while (have_posts()) : the_post();
			locate_template( array( 'list-post.php' ), true, false ); //リストループ用テンプレートを読み込む
		endwhile;?>
	</ul>
<!-- / .postList --></div>

<?php else : echo '<p>まだ記事はありません。</p>'; endif; ?>


<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

<?php get_footer(); ?>
