<?php add_theme_support( 'post-thumbnails' );

// 抜粋の省略部分を表記変更
function change_excerpt_more( $more ) {
  return '...';
}
add_filter( 'excerpt_more', 'change_excerpt_more' );

// 日本語slug禁止（SEO的にも、システム的にもまずいので）
function auto_post_slug( $slug, $post_ID, $post_status, $post_type ) {
  if ( preg_match( '/(%[0-9a-f]{2})+/', $slug ) ) {
    $slug = utf8_uri_encode( $post_type ) . '-' . $post_ID;
  }
  return $slug;
}
add_filter( 'wp_unique_post_slug', 'auto_post_slug', 10, 4 );


/**
 * プレビューリダイレクト
 */
add_action("template_redirect", function () {
  if (!is_admin()) {
    if (isset($_GET["preview"]) && (isset($_GET["p"]) || isset($_GET["preview_id"]))) {
      if (isset($_GET["p"])) {
        $id = $_GET["p"];
      } elseif (isset($_GET["preview_id"])) {
        $id = $_GET["preview_id"];
      }
      $post_type = get_post_type($id);
      $preview_url = '';
      if ($post_type == 'post')  {
        $preview_url = 'https://school-template-astro.vercel.app/news/' . $id . '/';
      } else if ($post_type == 'opencampus') {
        $preview_url = 'https://school-template-astro.vercel.app/opencampus/' . $id . '/';
      }
      $redirect = add_query_arg(
        [
          "preview" => '5855',
        ],
        $preview_url
      );
      wp_redirect($redirect);
      exit();
    } else {
      wp_redirect('https://school-template-astro.vercel.app' . $_SERVER[REQUEST_URI]);
      exit();
    }
  }
});
// function replace_preview_link ( $url ) {
//   return 'https://school-template-astro.vercel.app/';
// }
// add_filter('preview_post_link', 'replace_preview_link');


add_filter('graphql_connection_max_query_amount', function (int $max_amount, $source, array $args, $context, $info) {
	if (empty( $info->fieldName )) {
		return $max_amount;
	}
	// if ('posts' !== $info->fieldName || 'staffs' !== $info->fieldName) {
  //   return $max_amount;
	// }
	return 10000;
}, 10, 5);


//独自サムネイルサイズ
// add_image_size('staff-thumb', 920, 628, true);
// add_image_size('works_content', 1280, 900, true);
// add_image_size('works_content_full', 2560, 0, false);


/**
 * 不要なブロックの削除
 */
function enqueue_custom_script() {
  wp_enqueue_script(
    'remove_block', // ハンドル名
    get_template_directory_uri() . '/settings/remove-block.js', // JSのパス
    array() // 依存関係のスクリプト（jQueryなどのライブラリを指定可）
  );
}
add_action('enqueue_block_editor_assets', 'enqueue_custom_script');

/**
 * 投稿の編集画面で、Yoastを一番下に
 */
function metabox_place_change_script( $hook ) {
  if ($hook == 'post.php' || $hook == 'post-new.php') {
    $script = <<< SCRIPT
    jQuery(function($) {
      $('#wpseo_meta').parent().append($('#wpseo_meta'));
    });
    SCRIPT;
    wp_add_inline_script('editor', $script);
  }
}
add_action('admin_enqueue_scripts', 'metabox_place_change_script');

/**
 * 不要なウィジェット削除
 */
function remove_dashboard_widget() {
  remove_action('welcome_panel', 'wp_welcome_panel'); // ウェルカムパネル
}
add_action('wp_dashboard_setup', 'remove_dashboard_widget');

/**
 * 2560pxを超える大きな画像でも「フルサイズ」の画像としてオリジナル画像を使用する
 */

add_filter('big_image_size_threshold', '__return_false');


function my_unregister_taxonomies()
{
  global $wp_taxonomies;
  /*
    * 投稿機能から「タグ」を削除
    */
  if (!empty($wp_taxonomies['post_tag']->object_type)) {
    foreach ($wp_taxonomies['post_tag']->object_type as $i => $object_type) {
      if ($object_type == 'post') {
        unset($wp_taxonomies['post_tag']->object_type[$i]);
      }
    }
  }
  return true;
}
 
add_action('init', 'my_unregister_taxonomies');