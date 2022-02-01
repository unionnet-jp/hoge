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

<!--== Google For Jobs用の構造化データ ==-->
<?php if(is_singular( 'requirements' )):?>
	<?php while (have_posts()) : the_post(); ?>
	<?php
		$address_region = get_post_meta( $post->ID, 'address_region', true );//県
		$address_locality = get_post_meta( $post->ID, 'address_locality', true );//市
		$street_address = get_post_meta( $post->ID, 'street_address', true );//それ以降の住所
		$postal_code = get_post_meta( $post->ID, 'postal_code', true );//郵便番号
		$employment_type = get_post_meta( $post->ID, 'employment_type', true );//勤務形態
		$salary = get_post_meta( $post->ID, 'salary', true );//給与
		$salary_min = get_post_meta( $post->ID, 'salary_min', true );//給与(最小)必要であれば
		$salary_max = get_post_meta( $post->ID, 'salary_max', true );//給与(最大)必要であれば
		$unittext = get_post_meta( $post->ID, 'unittext', true );//勤務形態
	?>
	<script type="application/ld+json">
		{
			"@context": "http://schema.org/",
			"@type": "JobPosting",
			"title": "<?php the_title(); ?>",
			"description": "<?php echo strip_tags(apply_filters('the_content', $post->post_content), '<br><p><strong><em><ul><li><h1><h2><h3><h4><h5>'); ?>",
			"datePosted": "<?php the_time('Y-m-d'); ?>",
			"validThrough": "",
			"employmentType": "<?php echo $employment_type; ?>",
			"identifier": {
				"@type": "PropertyValue",
				"name": "<?php bloginfo('name'); ?>",
				"value": "<?php echo $post->ID; ?>"
			},
			"hiringOrganization": {
				"@type": "Organization",
				"name": "<?php bloginfo('name'); ?>",
				"sameAs": "<?php echo HOME; ?>",
				"logo": "<?php echo HOME; ?>img/common/webclip.png"
			},
			"jobLocation": {
				"@type": "Place",
				"address": {
					"@type": "PostalAddress",
					"addressRegion": "<?php echo $address_region; ?>",
					"addressLocality": "<?php echo $address_locality; ?>",
					"streetAddress": "<?php echo $street_address; ?>",
					"postalCode": "<?php echo $postal_code; ?>",
					"addressCountry": "JP"
				}
			},
			"baseSalary": {
				"@type": "MonetaryAmount",
				"currency": "JPY",
				"value": {
					"@type": "QuantitativeValue",
					"value": "<?php echo $salary; ?>",
					"minValue": "<?php echo $salary_min; ?>", //必要であれば
					"maxValue": "<?php echo $salary_max; ?>", //必要であれば
					"unitText": "<?php echo $unittext; ?>"
				}
			}
		}
	</script>
	<?php endwhile;?>
<?php endif; ?>

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

