<!-- START dropdown-category.php -->

<div class="dropdown">
<form action="<?php bloginfo('url'); ?>/" method="get" >
<?php
$select = wp_dropdown_categories('show_option_none=カテゴリー別に見る&hide_empty=0&echo=0');
$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
echo $select;
?>
<noscript><input type="submit" value="見る" /></noscript>
</form>
<!-- / .dropdown --></div>

<!-- END dropdown-category.php -->
