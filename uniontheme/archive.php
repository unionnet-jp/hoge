<?php get_header(); ?>
<h2 class="subTtl01"><?php wp_title(''); ?></h2>
<?php if (have_posts()) : ?>
	<div class="postList">
		<ul>
			<?php while (have_posts()) : the_post(); ?>
				<?php locate_template('templates/list-post.php', true, false); ?>
			<?php endwhile;?>
		</ul>
	</div>
<?php else : ?>
	<p>まだ記事はありません。</p>
<?php endif; ?>


<?php if (function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>

<?php get_footer(); ?>
