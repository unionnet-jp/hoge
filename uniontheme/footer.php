<?php 
/*
 Union Theme - Version: 1.4
*/
?>

  <!-- / .inner --></div>
<!-- / .l-contents --></div>

<!--     フッター   -->

<footer class="l-footer">


  <div class="inner">


	<section>
		<h2><?php bloginfo('name'); ?></h2>
		<ul>
			<li class="address"><?php echo do_shortcode('[uf_general_address]'); ?></li>
			<li class="tel"><?php echo do_shortcode('[uf_general_tel]'); ?></li>
			<li class="fax"><?php echo do_shortcode('[uf_general_fax]'); ?></li>
		</ul>
	</section>
	
	<nav>
		<ul>
			<?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
		</ul>
	</nav>
	
    <p class="copyright"><small>&copy; 発行年を入れる <?php bloginfo('name'); ?></small></p>

  <!-- / .inner --></div>
<!-- / .l-footer --></footer>

<!-- / #page --></div>

<?php wp_footer(); ?>
</body>
</html>