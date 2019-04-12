<?php 
/*
 Union Theme - Version: 1.4
*/
get_header(); ?>

<table>
	<caption class="txtL">
	ユーザフィールド表示例
	</caption>
	<col style="width:25%">
	<col style="width:auto">
	<tr>
		<th colspan="2">基本情報</th>
	</tr>
	<tr>
		<th>名称</th>
		<td><?php echo do_shortcode('[uf_general_name]'); ?></td>
	</tr>
	<tr>
		<th>TEL</th>
		<td><?php echo do_shortcode('[uf_general_tel]'); ?></td>
	</tr>
	<tr>
		<th>FAX</th>
		<td><?php echo do_shortcode('[uf_general_fax]'); ?></td>
	</tr>
	<tr>
		<th>フリーダイアル</th>
		<td><?php echo do_shortcode('[uf_general_freedial]'); ?></td>
	</tr>
	<tr>
		<th>所在地</th>
		<td><?php echo do_shortcode('[uf_general_address]'); ?></td>
	</tr>
	<tr>
		<th>営業時間/診療時間等</th>
		<td><?php echo do_shortcode('[uf_general_opentime]'); ?></td>
	</tr>
	<tr>
		<th>定休日</th>
		<td><?php echo do_shortcode('[uf_general_dayoff]'); ?></td>
	</tr>
	<tr>
		<th>名称の謙譲表現</th>
		<td><?php echo do_shortcode('[uf_general_self]'); ?></td>
	</tr>
	<tr>
		<th>代表者（個人情報管理責任者）</th>
		<td><?php echo do_shortcode('[uf_general_officer]'); ?></td>
	</tr>
	<tr>
		<th>代表メールアドレス</th>
		<td><?php echo do_shortcode('[uf_general_mail]'); ?></td>
	</tr>
	<tr>
		<th>メールドメイン</th>
		<td><?php echo do_shortcode('[uf_general_mail_domain]'); ?></td>
	</tr>
	<tr>
		<th colspan="2">SEO情報</th>
	</tr>
	<tr>
		<th>トップページのタイトル</th>
		<td><?php echo do_shortcode('[uf_top_title]'); ?></td>
	</tr>
	<tr>
		<th>下層ページのタイトル</th>
		<td><?php echo do_shortcode('[uf_additional_title]'); ?></td>
	</tr>
	<tr>
		<th>META KEYWORDS</th>
		<td><?php echo do_shortcode('[uf_meta_keywords]'); ?></td>
	</tr>
	<tr>
		<th>Google Analytics UA</th>
		<td><?php echo do_shortcode('[uf_google_ua]'); ?></td>
	</tr>
</table>

<nav>
	<h2 class="subTtl01">新着情報（日付／タイトル）</h2>
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

<nav>
	<h2 class="subTtl02">新着情報（日付／カテゴリ／タイトル）</h2>
		<div class="postList">
			<?php $news_posts = new WP_Query( 'category_name=news&posts_per_page=5' ); if ( $news_posts->have_posts() ) : ?>
			<ul>
				<?php while ( $news_posts->have_posts() ) : $news_posts->the_post();
				
					locate_template( array( 'list-post-with-cat.php' ), true, false ); //リストループ用テンプレートを読み込む
					
				endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); else : echo '<p>まだ記事はありません。</p>'; endif; ?>
		<!-- / .postList --></div>
</nav>    

<nav>
	<h2 class="subTtl03">新着情報（サムネイル／タイトル）</h2>
		<div class="thumbnailList">
			<?php $news_posts = new WP_Query( 'category_name=news&posts_per_page=5' ); if ( $news_posts->have_posts() ) : ?>
			<ul>
				<?php while ( $news_posts->have_posts() ) : $news_posts->the_post();
				
					locate_template( array( 'list-post-with-thumbnail.php' ), true, false ); //リストループ用テンプレートを読み込む
					
				endwhile; ?>
			</ul>
			<?php wp_reset_postdata(); else : echo '<p>まだ記事はありません。</p>'; endif; ?>
		<!-- / .postList --></div>
</nav>    

<?php get_sidebar(); ?>
<?php get_footer(); ?>