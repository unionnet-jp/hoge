<?php
/*
 Template Name: よくあるご質問
 Union Theme - Version: 1.4
*/

get_header();?>

<?php if(have_posts()): while(have_posts()): the_post(); ?>
<article id="faq">
<h2 class="subTtl01"><?php the_title(); ?></h2>

<?php $faq_content = get_the_content(); if($faq_content) { ?>
<div class="content">
<?php the_content(); ?>
<!-- / .content --></div>
<?php } ?>

<?php $faq_lists = $cfs->get('faq-data'); if($faq_lists){ ?>
<div class="faqList">

	<?php foreach ($faq_lists as $faq) {?>
	<dl>
	<dt><?php echo esc_html($faq['faq-q']); ?></dt>
	<dd><?php echo apply_filters('the_content', $faq['faq-a']); ?></dd>
	</dl>
	<?php } ?>
	
<!-- / .faqList --></div>
<?php }?>

<!-- / #faq --></article>
<?php  endwhile; endif; ?>

<?php get_sidebar(); ?>
<?php get_footer(); ?>