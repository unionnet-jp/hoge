<?php 
/*
 Union Theme - Version: 1.4
*/
?>

<!-- / .l-contents --></div>

<!--     フッター   -->

<footer class="l-footer">


  <div class="l-footer__inner">


	
	<nav>
		<ul>
			<?php wp_list_pages('title_li=&sort_column=menu_order'); ?>
		</ul>
	</nav>
	
    <p class="l-footer__copyright"><small>&copy; 発行年を入れる <?php bloginfo('name'); ?></small></p>

  <!-- / .l-footer__inner --></div>
<!-- / .l-footer --></footer>

<!-- / #page --></div>

<?php wp_footer(); ?>
</body>
</html>