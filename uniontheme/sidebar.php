<?php 
/*
 Union Theme - Version: 1.4
*/
?>

<aside class="l-side">

	<nav>
		<h3>カテゴリー別アーカイブ</h3>
		<ul>
			<?php wp_list_categories('title_li='); ?>
		</ul>
	</nav>
	
	<nav>
		<h3>月別アーカイブ</h3>
		<ul>
			<?php wp_get_archives(); ?>
		</ul>
	</nav>
	
	<nav>
		<h2 class="subTtl01">新着情報</h2>
		<div class="postList">
			<?php $news_posts = new WP_Query( 'category_name=news&posts_per_page=5' ); if ( $news_posts->have_posts() ) : ?>
			<ul>
				<?php while ( $news_posts->have_posts() ) : $news_posts->the_post();
				
					locate_template( array( 'list-post.php' ), true, false ); //リストループ用テンプレートを読み込む
					
				endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); else : echo '<p>まだ記事はありません。</p>'; endif; ?>
			<!-- / .postList --></div>
	</nav>
	
	<section>
		<h3><?php bloginfo('name'); ?></h3>
		<ul>
			<li class="address"><?php echo do_shortcode('[uf_general_address]'); ?></li>
			<li class="tel"><?php echo do_shortcode('[uf_general_tel]'); ?></li>
			<li class="fax"><?php echo do_shortcode('[uf_general_fax]'); ?></li>
		</ul>
	</section>
	
<!-- / .l-side" --></aside>
