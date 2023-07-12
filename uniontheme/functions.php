<?php /*
Union Theme - Version: 1.4
*/

/**
 * テーマセットアップ
 */
function uniontheme_setup() {
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support('post-thumbnails');

  // add_image_size('logo', 160, 0, false);

  // register_nav_menus(array(
  //   'header' => 'Header Menu',
  //   'footer' => 'Footer Menu',
  // ));
}
add_action('after_setup_theme', 'uniontheme_setup');
 
/**
 * wp_head非表示項目
 */
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'parent_post_rel_link');
remove_action('wp_head', 'start_post_rel_link');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles', 10);

/**
 * CSS, JS, 各種ファイルのフロントでの読み込み
 */
function add_my_files() {
  //スタイルシートの読み込み
  wp_dequeue_style('classic-theme-styles');
  wp_enqueue_style('builtin', get_stylesheet_uri());
  wp_enqueue_style('bundle-style', home_url('dist/js/bundle.css'));
  wp_enqueue_style('my-style', home_url('dist/css/style.min.css'));
 
  //JavaScript の読み込み
  wp_deregister_script('jquery');
  wp_enqueue_script('my-script', home_url('dist/js/bundle.js'), array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'add_my_files');

/**
 * 改行なし、タグ削除、文字数制限を返す関数
 */
function strim($str, $size = 100, $end = "...") {
  return mb_strimwidth(esc_html(strip_tags(strip_shortcodes($str))), 0, $size, $end, 'utf-8');
}

//----------------------------------------------------
// ショートコード
//----------------------------------------------------

/**
 * ホームURLを出力するショートコード
 */
function user_fields_shortcode_home_url() { 
  return esc_url(home_url('/'));
}
add_shortcode('home_url', 'user_fields_shortcode_home_url');

/**
 * ホームURLを定数化
 */
define('HOME', esc_url(home_url('/'))); //サイトURL＝HOME
define('THEMEDIR', esc_url(get_template_directory_uri('/'))); //テーマディレクトリURL＝THEMEDIR


//----------------------------------------------------
// アップデートまわり
//----------------------------------------------------

/**
 * プラグインの更新を非表示
 */
function remove_counts() {
  global $menu,$submenu;
  $menu[65][0] = 'プラグイン';
  $submenu['index.php'][10][0] = '更新';
}
add_action('admin_menu', 'remove_counts');

/**
 * 管理画面のWP更新メッセージを非表示に
 */
add_action('admin_print_styles', 'admin_css_custom');
function admin_css_custom() {
  echo '<style>#update-nag, .update-nag{display: none !important;}</style>';
}

/**
 * 言語ファイルの自動アップデートを停止
 */
add_filter('auto_update_translation', '__return_false');


//----------------------------------------------------
// Gutenberg
//----------------------------------------------------

function gutenberg_support_setup() {
  //Gutenberg用スタイルの読み込み
  add_theme_support('wp-block-styles');
  //add_theme_support('align-wide');
  add_theme_support('editor-styles');
  //独自スタイルの適用
  add_editor_style();
}
add_action('after_setup_theme', 'gutenberg_support_setup');

/**
 * srcset属性を許可
 */
function my_wp_kses_allowed_html($tags, $context) {
  $tags['source']['srcset'] = true;
  $tags['img']['srcset'] = true;
  return $tags;
}
add_filter('wp_kses_allowed_html', 'my_wp_kses_allowed_html', 10, 2);

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
 * ブロックパターンのカテゴリーを削除する
 */
add_action('admin_init', function () {
  unregister_block_pattern_category('buttons');
  unregister_block_pattern_category('header');
  unregister_block_pattern_category('query');
});

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


//----------------------------------------------------
// ダッシュボード
//----------------------------------------------------

/**
 * 不要なウィジェット削除
 */
function remove_dashboard_widget() {
  remove_action('welcome_panel', 'wp_welcome_panel'); // ウェルカムパネル
}
add_action('wp_dashboard_setup', 'remove_dashboard_widget');


/**
 * マニュアルへのリンク追加 (HTML) ※リンク設定必要
 */
function dashboard_widget_function() { ?>
  <ul class="quick-action">
    <li>
      <a href="" target="_blank" class="quick-action-button">
        <span class="dashicons-before dashicons-book"></span>
        マニュアルを見る
      </a>
    </li>
  </ul>
<?php }

function add_dashboard_widgets() {
  wp_add_dashboard_widget(
    'quick_action_dashboard_widget', // ウィジェットのスラッグ名
    'マニュアル', // ウィジェットに表示するタイトル
    'dashboard_widget_function' // 実行する関数
  );
}

add_action('wp_dashboard_setup', 'add_dashboard_widgets');


//----------------------------------------------------
// その他
//----------------------------------------------------

/**
 * 2560pxを超える大きな画像でも「フルサイズ」の画像としてオリジナル画像を使用する
 */

add_filter('big_image_size_threshold', '__return_false');

/**
 * CSS、JSにWordPressのバージョンが記載されないように
 */
function remove_cssjs_ver2($src) {
  if (strpos($src, 'ver=')) {
    $src = remove_query_arg('ver', $src);
  }
  return $src;
}
add_filter('style_loader_src', 'remove_cssjs_ver2', 9999);
add_filter('script_loader_src', 'remove_cssjs_ver2', 9999);