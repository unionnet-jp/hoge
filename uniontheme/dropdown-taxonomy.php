<!-- START dropdown-taxonomy.php -->

<div class="dropdown">
<form action="<?php bloginfo('url'); ?>/" method="get" >
<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
<option value="">カテゴリー別に見る</option>
<?php
$tax_name ='TAX_NAME'; //タクソノミー名
$terms = get_terms( $tax_name, array('orderby' => 'id', 'order' => 'ASC' ,'fields' => 'all') );
if($terms) {
foreach ($terms as $term ) { ?>
<option value="<?php echo get_term_link($term->slug, $tax_name); ?>"><?php echo esc_html($term->name); ?></option>
<?php }
} ?>
</select>
<noscript><input type="submit" value="見る" /></noscript>
</form>
<!-- / .dropdown --></div>

<!-- END dropdown-taxonomy.php -->
