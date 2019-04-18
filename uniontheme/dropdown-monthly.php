<!-- START dropdown-monthly.php -->

<div class="c-dropdown">
<select name="archive-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
<option value="">月別アーカイブ</option>
<?php wp_get_archives( 'type=monthly&format=option&show_post_count=0' ); ?>
</select>
<!-- / .c-dropdown --></div>

<!-- END dropdown-monthly.php -->
