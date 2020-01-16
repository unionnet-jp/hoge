<?php 
/*
 Union Theme - Version: 2.0
*/
?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ja">
<head>
<meta charset="UTF-8">
<meta name="robots" content="index,follow">
<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE">
<meta name="format-detection" content="telephone=no">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/vnd.microsoft.icon" href="<?php echo HOME; ?>common/img/ico/favicon.ico">
<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo HOME; ?>common/img/ico/favicon.ico">
<link rel="shortcut icon" type="image/x-icon" href="<?php echo HOME; ?>common/img/ico/favicon.ico">
<!--  スマホ用基本 -->
<link rel="apple-touch-icon-precomposed" href="<?php echo HOME; ?>common/img/ico/apple-touch-icon-152x152.png">
<!--  iPad用基本 -->
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo HOME; ?>common/img/ico/apple-touch-icon-76x76.png">
<!--  スマホのRetina用 -->
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo HOME; ?>common/img/ico/apple-touch-icon-120x120.png">
<!--  iPadのRetina用 -->
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo HOME; ?>common/img/ico/apple-touch-icon-152x152.png">
<?php wp_head(); ?>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo do_shortcode('[uf_google_ua]'); ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', '<?php echo do_shortcode('[uf_google_ua]'); ?>');
</script>

</head>

<body <?php body_class(); ?>>

<div id="page">

<!--   ヘッダー   -->

<header class="l-header">
  <div class="l-header__inner">
	<h1 class="l-header__logo"><a href="<?php echo HOME; ?>"><?php bloginfo('name'); ?></a></h1>
  <!-- / .l-header__inner --></div>
<!-- / .l-header --></header>

<?php if(is_front_page() && !is_paged()) { /*トップページ*/ ?>
<div class="p-kv">

	
<!-- / .p-kv --></div>

<?php } else { ?>
<div class="p-kv__lower">

	<?php if(is_404()){ /*404ページ*/ ?>
	<img src="<?php echo HOME; ?>img/main/main_404.jpg" alt="<?php the_title(); ?>">
	<h2><?php the_title(); ?></h2><p>404 Not Found</p>
	
	<?php }elseif(is_singular( 'works' ) || is_post_type_archive( 'works' ) || is_tax( 'works_cat' ) ){ /*カスタム投稿投稿タイプworks｜カスタムタクソノミーworks_cat*/ ?>
	<img src="<?php echo HOME; ?>img/main/main_works.jpg" alt="<?php echo esc_html( get_post_type_object( 'works' )->label ); ?>">
	<h2><?php echo esc_html( get_post_type_object( 'works' )->label ); ?></h2><p><?php echo esc_html( get_post_type_archive_link( 'works' ) ); ?></p>
	
	<?php }elseif(is_single() || is_archive()){ /*投稿*/ $cat = get_category(1); //初期カテゴリー ?>
	<img src="<?php echo HOME; ?>img/main/main_<?php echo esc_html($cat->slug); ?>.jpg" alt="<?php echo esc_html($cat->name); ?>">
	<h2><?php echo esc_html($cat->name); ?></h2><p><?php echo esc_html($cat->slug); ?></p>
	
	<?php } elseif( is_page() && $post->ancestors ){ $parent = end(get_post_ancestors($post->ID));  /*第二階層以下の固定ページ（第一階層のタイトルを表示します）*/?>
	<img src="<?php echo HOME; ?>img/main/main_<?php echo esc_html(get_page_uri($parent));?>.jpg" alt="<?php echo apply_filters('the_title', get_the_title($parent)); ?>">
	<h2><?php echo apply_filters('the_title', get_the_title($parent)); ?></h2><p><?php echo esc_html(get_page_uri($parent));?></p>
	
	<?php }elseif(is_page()){ /*固定ページ*/ ?>
	<img src="<?php echo HOME; ?>img/main/main_<?php echo esc_attr( esc_html($post->post_name) ); ?>.jpg" alt="<?php the_title(); ?>">
	<h2><?php the_title(); ?></h2><p><?php echo esc_attr( esc_html($post->post_name) ); ?></p>
	<?php } ?>
	
<!--.p-kv__lower--></div>
<?php } ?>

<!--    コンテンツ	-->

<div class="l-contents">
  
	<?php if(!is_front_page()){ //パンくず表示開始 ?>
	<div class="c-crumbs">
	<?php
		if ( function_exists('yoast_breadcrumb') ) {
			yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
		}
	?>
  </div>
	<?php } //パンくず表示終わり?>
	
    <div class="l-main">

