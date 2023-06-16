<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ja">
<?php get_template_part('head'); ?>
<body <?php body_class(); ?>>
<div id="page">
	<header class="l-header">
		<div class="l-header__inner">
			<?php if (is_front_page() && !is_paged()) : ?>
				<h1 class="l-header__logo">
					<a href="<?php echo HOME; ?>"><?php bloginfo('name'); ?></a>
				</h1>
			<?php else : ?>
				<div class="l-header__logo">
					<a href="<?php echo HOME; ?>"><?php bloginfo('name'); ?></a>
				</div>
			<?php endif; ?>
		</div>
	</header>
	<?php if (!is_front_page()) { //パンくず表示開始 ?>
		<div class="c-crumbs">
			<?php if (function_exists('yoast_breadcrumb')) { yoast_breadcrumb('<p id="breadcrumbs">', '</p>'); } ?>
		</div>
	<?php } //パンくず表示終わり ?>
	<main class="l-main">