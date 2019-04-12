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
remove_action('wp_head','rest_output_link_wp_head');
remove_action('wp_head','wp_oembed_add_discovery_links');
remove_action('wp_head','wp_oembed_add_host_js');
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
  if(!is_admin()){
    wp_deregister_script( 'jquery' );
    wp_enqueue_script('jquery','//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js');
    wp_enqueue_script('scripts',esc_url(home_url('/')).'common/js/min/scripts.js');
  }
}
add_action('wp_footer','common_scripts');

function common_styles() {
  if(!is_admin()){
    wp_enqueue_style('default',esc_url(home_url('/')).'common/css/theme.css');
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

/***************************************
カスタムショートコード設定
***************************************/
//ユーザーフィールド「名称」を出力するショートコード
function user_fields_shortcode_general_name() {
  return esc_html(SCF::get_user_meta( 1,'general-name' ));
}
add_shortcode( 'uf_general_name', 'user_fields_shortcode_general_name' );

//ユーザーフィールド「TEL」を出力するショートコード
function user_fields_shortcode_general_tel() {
  return esc_html(SCF::get_user_meta( 1,'general-tel' ));
}
add_shortcode( 'uf_general_tel', 'user_fields_shortcode_general_tel' );

//ユーザーフィールド「FAX」を出力するショートコード
function user_fields_shortcode_general_fax() {
  return esc_html(SCF::get_user_meta( 1,'general-fax' ));
}
add_shortcode( 'uf_general_fax', 'user_fields_shortcode_general_fax' );

//ユーザーフィールド「フリーダイアル」を出力するショートコード
function user_fields_shortcode_general_freedial() {
  return esc_html(SCF::get_user_meta( 1,'general-freedial' ));
}
add_shortcode( 'uf_general_freedial', 'user_fields_shortcode_general_freedial' );

//ユーザーフィールド「所在地」を出力するショートコード
function user_fields_shortcode_general_address( $atts ) {
  extract(shortcode_atts(array(
    'html' => false,
    'br' => false
  ), $atts));
  $address = SCF::get_user_meta( 1,'general-address' );
  if ( $atts ) {
    if( $html && $br ) {
    return apply_filters( 'the_content', nl2br( $address ) );
    } elseif( $html ) {
    return apply_filters( 'the_content', $address );
    } elseif( $br ) {
    return nl2br( esc_html( $address ) );
    }
  }
  else{
    return esc_html( $address );
  }
}
add_shortcode( 'uf_general_address', 'user_fields_shortcode_general_address' );

//ユーザーフィールド「営業時間／診療時間」を出力するショートコード
function user_fields_shortcode_general_opentime( $atts ) {
  extract(shortcode_atts(array(
    'html' => false,
    'br' => false
  ), $atts));
  $opentime = SCF::get_user_meta( 1,'general-opentime' );
  if ( $atts ) {
    if( $html && $br ) {
    return apply_filters( 'the_content', nl2br( $opentime ) );
    } elseif( $html ) {
    return apply_filters( 'the_content', $opentime );
    } elseif( $br ) {
    return nl2br( esc_html( $opentime ) );
    }
  }
  else{
    return esc_html( $opentime );
  }
}
add_shortcode( 'uf_general_opentime', 'user_fields_shortcode_general_opentime' );

//ユーザーフィールド「定休日」を出力するショートコード
function user_fields_shortcode_general_dayoff( $atts ) {
  extract(shortcode_atts(array(
    'html' => false,
    'br' => false
  ), $atts));
  $dayoff = SCF::get_user_meta( 1,'general-dayoff' );
  if ( $atts ) {
    if( $html && $br ) {
    return apply_filters( 'the_content', nl2br( $dayoff ) );
    } elseif( $html ) {
    return apply_filters( 'the_content', $dayoff );
    } elseif( $br ) {
    return nl2br( esc_html( $dayoff ) );
    }
  }
  else{
    return esc_html( $dayoff );
  }
}
add_shortcode( 'uf_general_dayoff', 'user_fields_shortcode_general_dayoff' );

//ユーザーフィールド「名称の謙譲表現」を出力するショートコード
function user_fields_shortcode_general_self() { 
  $self_name01 = SCF::get_user_meta( 1,'general-self' ); //ユーザーフィールド「名称の謙譲表現」
  $self_name02 = SCF::get_user_meta( 1,'general-self-other' ); //ユーザーフィールド「名称の謙譲表現（その他）」
  if( !empty($self_name01) ) { return esc_html($self_name01); }
  elseif( !empty($self_name02) ) { return esc_html($self_name02); }
}
add_shortcode( 'uf_general_self', 'user_fields_shortcode_general_self' );

//ユーザーフィールド「代表者」を出力するショートコード
function user_fields_shortcode_general_officer() { 
  return esc_html(SCF::get_user_meta( 1,'general-chief-privacy-officer' ));
}
add_shortcode( 'uf_general_officer', 'user_fields_shortcode_general_officer' );

//ユーザーフィールド「代表メールアドレス」を出力するショートコード
function user_fields_shortcode_general_mail() { 
  return antispambot(SCF::get_user_meta( 1,'general-mail-address' ));
}
add_shortcode( 'uf_general_mail', 'user_fields_shortcode_general_mail' );

//ユーザーフィールド「メールドメイン」を出力するショートコード
function user_fields_shortcode_general_mail_domain() { 
  return antispambot(SCF::get_user_meta( 1,'general-mail-domain' ));
}
add_shortcode( 'uf_general_mail_domain', 'user_fields_shortcode_general_mail_domain' );

//ユーザーフィールド「トップページのタイトル」を出力するショートコード
function user_fields_shortcode_top_title() { 
  return esc_html(SCF::get_user_meta( 1,'top-title' ));
}
add_shortcode( 'uf_top_title', 'user_fields_shortcode_top_title' );

//ユーザーフィールド「下層ページのタイトル」を出力するショートコード
function user_fields_shortcode_additional_title() { 
  return esc_html(SCF::get_user_meta( 1,'additional-title' ));
}
add_shortcode( 'uf_additional_title', 'user_fields_shortcode_additional_title' );

//ユーザーフィールド「META KEYWORDS」を出力するショートコード
function user_fields_shortcode_meta_keywords() { 
  return esc_html(SCF::get_user_meta( 1,'meta-keywords' ));
}
add_shortcode( 'uf_meta_keywords', 'user_fields_shortcode_meta_keywords' );

//ユーザーフィールド「Google Analytics UA」を出力するショートコード
function user_fields_shortcode_googleua() { 
  return esc_html(SCF::get_user_meta( 1,'google-analytics-ua' ));
}
add_shortcode( 'uf_google_ua', 'user_fields_shortcode_googleua' );

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

//固定ページの編集時のみビジュアルエディタを使用できないようにする
function disable_visual_editor_in_page() {
  global $typenow;
  if ( in_array( $typenow,  array( 'page', 'mw-wp-form' ) ) ) {
      add_filter('user_can_richedit', 'disable_visual_editor_filter');
  }
}
function disable_visual_editor_filter() {
  return false;
}
add_action('load-post.php', 'disable_visual_editor_in_page');
add_action('load-post-new.php', 'disable_visual_editor_in_page');

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