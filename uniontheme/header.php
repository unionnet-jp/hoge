<?php 
/*
 Union Theme - Version: 2.0
*/
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo HOME; ?>favicon.ico">
<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo HOME; ?>favicon.ico">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo HOME; ?>favicon.ico">
<!--  スマホ用基本 -->
<link rel="apple-touch-icon-precomposed" href="<?php echo HOME; ?>img/common/meta/webclip.png">
<?php wp_head(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=GAコード入れる"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'GAコード入れる');
</script>

</head>

<body <?php body_class(); ?>>

<div id="page">

<!--   ヘッダー   -->

<header class="l-header">
  <div class="l-header__inner">
	<?php if(is_front_page() && !is_paged()) : ?>
	<h1 class="l-header__logo"><a href="<?php echo HOME; ?>"><?php bloginfo('name'); ?></a></h1>
	<?php else: ?>
	<div class="l-header__logo"><a href="<?php echo HOME; ?>"><?php bloginfo('name'); ?></a></div>
	<?php endif; ?>
  <!-- / .l-header__inner --></div>
<!-- / .l-header --></header>


<?php if(!is_front_page()){ //パンくず表示開始 ?>
<div class="c-crumbs">
<?php
	if ( function_exists('yoast_breadcrumb') ) {
		yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
	}
?>
</div>
<?php } //パンくず表示終わり?>

