<?php get_header(); ?>

<div class="p-lower_kv">
  <img src="<?php echo HOME; ?>img/main/main_404.jpg" alt="<?php the_title(); ?>">
  <h1><?php the_title(); ?></h1><p>404 Not Found</p>
</div>

<section class="p-notfound_body">
  <div class="container">
    <h2>404 Not Found - ページが見つかりません</h2>
    <div class="body">
      <p>指定されたページまたはファイルは存在しません</p>
      <ul>
        <li>URL、ファイル名にタイプミスがないかご確認ください。</li>
        <li>指定されたページは削除されたか、移動した可能性があります。</li>
      </ul>
      <p class="u-center"><a href="<?php echo HOME?>" class="c-return_top">トップへ戻る</a></p>
    <!-- / .body --></div>
  </div>
<!-- /.p-notfound_body --></section>

<?php get_footer(); ?>