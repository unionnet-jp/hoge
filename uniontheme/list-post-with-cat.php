<!--START list-post-with-cat.php-->
<li>
	<span class="date"><?php the_time('Y.m.d'); ?></span>
	<?php $current_cats = get_the_category(); if($current_cats) { ?><span class="label"><?php foreach ( $current_cats as $current_cat ) { ?><em<?php echo ' class="' . esc_html($current_cat->slug) . '"' ; ?>><?php  echo esc_html( $current_cat->name ); ?></em><?php } /* end foreach */ ?></span><?php } /* end if */  ?>
	<span class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
</li>
<!--END list-post-with-cat.php-->
