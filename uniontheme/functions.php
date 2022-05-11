<?php
/*
 Union Theme - Version: 1.4
*/

//テーマセットアップ
function uniontheme_setup() {
	
	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );

}
add_action( 'after_setup_theme', 'uniontheme_setup' );

//プラグインの更新を非表示/
add_action('admin_menu', 'remove_counts');
function remove_counts(){
  global $menu,$submenu;
  $menu[65][0] = 'プラグイン';
  $submenu['index.php'][10][0] = '更新';
}
 
//wp_head非表示項目
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
 
//カテゴリーの階層を保持
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
    $args['checked_ontop'] = false;
    return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );

//wordpressのjqueryを使わない
function no_wp_jquery() {
  if(!is_admin()){  
    wp_deregister_script( 'jquery' ); 
  }
}
add_action('wp_enqueue_scripts','no_wp_jquery');

//ヘッダーにcommonを読込む
function common_scripts() {
  if(!is_admin() || is_404()){
    wp_deregister_script( 'jquery' );
    wp_enqueue_script('scripts',esc_url(home_url('/')).'dist/js/bundle.js');
  }
}
add_action('wp_footer','common_scripts');

function common_styles() {
  if(!is_admin() || is_404()){
    wp_enqueue_style('default',esc_url(home_url('/')).'dist/css/style.css');
    wp_enqueue_style('builtin',esc_url(get_stylesheet_uri()));
  }
}
add_action('wp_print_styles','common_styles');

//年月日アーカイブのタイトル日本語表記を整える
function ja_date_wp_title($title, $sep, $seplocation) {
  $year = get_query_var('year');
  $monthnum = get_query_var('monthnum');
  $day = get_query_var('day');

  // from wp-includes/general-template.php:wp_title()
  if ( is_archive() && !empty($year) ) {
    $title = $year . "年";
    if ( !empty($monthnum) )
      $title .= zeroise($monthnum, 2) . "月";
    if ( !empty($day) )
      $title .= zeroise($day, 2) . "日";

    if ($seplocation == 'right') {
      $title = $title . ' ' . $sep . ' ';
    } else {
      $title = $sep . ' ' . $title . ' ';
    }
  }

  return $title;
}
add_filter('wp_title', 'ja_date_wp_title', 10, 3);
 
// フィルタの登録
add_filter('content_save_pre','tag_save_pre');
 
function tag_save_pre($content){
  global $allowedposttags;

  // iframeとiframeで使える属性を指定する
  $allowedposttags['iframe'] = array('class' => array () , 'src'=>array() , 'width'=>array(),
  'height'=>array() , 'frameborder' => array() , 'scrolling'=>array(),'marginheight'=>array(),
  'marginwidth'=>array());

  return $content;
}
 
// 「コメント」と「ツール」を非表示にする
function remove_menus () {
  if (!current_user_can('level_10')) { 
    //管理者以外のユーザーの場合メニューをunsetする
    global $menu;
    unset($menu[25]); // コメント
    unset($menu[75]); // ツール
  }
}
add_action('admin_menu', 'remove_menus');

  //改行なし、タグ削除、文字数制限
function strim($str,$size=100,$end="...") {
  return mb_strimwidth(esc_html(strip_tags(strip_shortcodes($str))),0,$size,$end,'utf-8');
}
 
//コピーライト年号取得
function get_year($start){
  $year = date('Y');
  if($start != $year){
    return $start.' - '.$year;
  }else{
    return $start;
  }
}

//カスタム分類のラベルをwp_titleから削除
add_filter( 'wp_title', 'fix_wp_title', 10, 3 );
function fix_wp_title($title, $sep, $seplocation){
  global $wp_query;
  if ( is_tax() ) {
    $term = $wp_query->get_queried_object();
    $term = $term->name;
    $title =$term;
    $t_sep = '%WP_TITILE_SEP%'; // Temporary separator, for accurate flipping, if necessary

    $prefix = '';
    if ( !empty($title) )
      $prefix = " $sep ";
    if ( 'right' == $seplocation ) {
      $title_array = explode( $t_sep, $title );
      $title_array = array_reverse( $title_array );
      $title = implode( " $sep ", $title_array ) . $prefix;
    } else {
      $title_array = explode( $t_sep, $title );
      $title = $prefix . implode( " $sep ", $title_array );
    }
  }
  return $title;
}

// wp_list_pages からtitle属性を削除
function delete_list_page_title_attribute( $output ) {
  $output = preg_replace( '/ title="[^"]*"/', '', $output );
  return $output;
}
add_filter( 'wp_list_pages', 'delete_list_page_title_attribute' );

// wp_list_categories からtitle属性を削除
function delete_list_categories_title_attribute( $output ) {
  $output = preg_replace( '/ title="[^"]*"/', '', $output );
  return $output;
}
add_filter( 'wp_list_categories', 'delete_list_categories_title_attribute' );

//ホームURLを出力するショートコード
function user_fields_shortcode_home_url() { 
  return esc_url( home_url( '/' ) );
}
add_shortcode( 'home_url', 'user_fields_shortcode_home_url' );

/***************************************
 カスタムショートコード設定終わり
***************************************/

//ホームURLを定数化
define('HOME',esc_url( home_url( '/' ))); //サイトURL＝HOME
define('THEMEDIR',esc_url(get_template_directory_uri()).'/'); //テーマディレクトリURL＝THEMEDIR

//管理画面のWP更新メッセージを非表示に
add_action('admin_print_styles', 'admin_css_custom');
function admin_css_custom() {
echo '<style>#update-nag, .update-nag{display: none !important;}</style>';
}

//言語ファイルの自動アップデートを停止
add_filter( 'auto_update_translation', '__return_false' );


//「URL/login」「URL/admin」「URL/dashboard」へのリダイレクト禁止
remove_action( 'template_redirect', 'wp_redirect_admin_locations', 1000 );


// wp-captionのカスタマイズ
add_shortcode('caption', 'custom_caption_shortcode');

function custom_caption_shortcode($attr, $content = null) {
  if ( ! isset( $attr['caption'] ) ) {
    if ( preg_match( '#((?:<a [^>]+>s*)?<img [^>]+>(?:s*</a>)?)(.*)#is', $content, $matches ) ) {
      $content = $matches[1];
      $attr['caption'] = trim( $matches[2] );
    }
  }

  $output = apply_filters('img_caption_shortcode', '', $attr, $content);
  if ( $output != '' )
    return $output;

  extract(shortcode_atts(array(
    'id'    => '',
    'align' => 'alignnone',
    'width' => '',
    'caption' => ''
  ), $attr, 'caption'));

  if ( 1 > (int) $width || empty($caption) )
    return $content;

  if ( $id ) $id = 'id="' . esc_attr($id) . '" ';

  return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '">' . do_shortcode( $content ) . '<figcaption class="wp-caption-text">' . $caption . '</figcaption></figure>';
}


function remove_cssjs_ver2( $src ) {
  if ( strpos( $src, 'ver=' ) )
      $src = remove_query_arg( 'ver', $src );
  return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver2', 9999 );
add_filter( 'script_loader_src', 'remove_cssjs_ver2', 9999 );

function gutenberg_support_setup() {
  //Gutenberg用スタイルの読み込み
  add_theme_support( 'wp-block-styles' );
  //add_theme_support( 'align-wide' );
  add_theme_support('editor-styles');
  //独自スタイルの適用
  add_editor_style();
}
add_action( 'after_setup_theme', 'gutenberg_support_setup' );

function myguten_enqueue() {
	echo '<script>
	console.log("font-size changed!");
	document.documentElement.style.fontSize = "62.5%";
	</script>';
}
add_action( 'enqueue_block_editor_assets', 'myguten_enqueue' );


//----------------------------------------------------
// Gutenbergブロック 編集
//----------------------------------------------------

// 不要なブロックの削除
function enqueue_custom_script() {
  wp_enqueue_script(
    'remove_block', // ハンドル名
    get_template_directory_uri() . '/js/remove-block.js', // JSのパス
    array() // 依存関係のスクリプト（jQueryなどのライブラリを指定可）
  );
}
add_action( 'enqueue_block_editor_assets', 'enqueue_custom_script' );

//ブロックパターンのカテゴリーを削除する
add_action('admin_init', function () {
  unregister_block_pattern_category( 'buttons');
  unregister_block_pattern_category( 'header');
  unregister_block_pattern_category( 'query');
});


//----------------------------------------------------
//ダッシュボード 編集
//----------------------------------------------------
//不要なウィジェット削除
function remove_dashboard_widget() {
  remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' ); // サイトヘルスステータス
  remove_meta_box( 'dashboard_right_now', 'dashboard', 'normal' ); // 概要
  remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' ); // アクティビティ
  remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'side' ); // yoast
  remove_meta_box( 'dashboard_quick_press', 'dashboard', 'side' ); // クイックドラフト
  remove_meta_box( 'dashboard_primary', 'dashboard', 'side' ); // WordPress イベントとニュース
  remove_action( 'welcome_panel', 'wp_welcome_panel' ); // ウェルカムパネル
}
add_action( 'wp_dashboard_setup', 'remove_dashboard_widget' );

//カスタムウィジェット追加
function add_dashboard_widgets() {
  wp_add_dashboard_widget(
    'quick_action_dashboard_widget', // ウィジェットのスラッグ名
    'マニュアル', // ウィジェットに表示するタイトル
    'dashboard_widget_function' // 実行する関数
  );
}
add_action( 'wp_dashboard_setup', 'add_dashboard_widgets' );

//マニュアルへのリンク追加 (HTML) ※リンク設定必要
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
