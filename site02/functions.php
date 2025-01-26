<?php
// <title>タグを出力
add_theme_support('title-tag'); 

//区切り文字変更
add_filter( 'document_title_separator', 'my_document_title_separator');
function my_document_title_separator($separator) {
  $separator = "|";
  return $separator;
}

add_filter('document_title_parts', 'custom_search_title');
function custom_search_title($title) {
    if (is_search()) {
        $title['title'] = '会社実績'; // タイトルを「会社実績」に変更
    }
    return $title;
}

/**
 * WP-SCSS：ページをロードするたびにscssファイルを強制的にコンパイル.
 */
define( 'WP_SCSS_ALWAYS_RECOMPILE', true );


//カスタムメニューを使用可能に
add_theme_support('menus');



function hide_menus_for_editors() {
  if (!current_user_can('administrator')) {
      // 管理者以外がアクセスできないメニュー項目を削除

      // 投稿
      remove_menu_page('edit.php');  // 投稿
      // ページ
      remove_menu_page('edit.php?post_type=page');  // ページ
      // メディア
      remove_menu_page('upload.php');  // メディア
      // コメント
      remove_menu_page('edit-comments.php');  // コメント
      // 外観
      remove_menu_page('themes.php');  // 外観
      // プラグイン
      remove_menu_page('plugins.php');  // プラグイン
      // ツール
      remove_menu_page('tools.php');  // ツール
      // 設定
      remove_menu_page('options-general.php');  // 設定

  }
}
add_action('admin_menu', 'hide_menus_for_editors', 999);


function restrict_editor_access_to_custom_post_type() {
  if (!current_user_can('administrator')) {
      // 管理者以外が「p-project」のみアクセスできるようにする
      global $submenu;

      // 「p-project」の管理画面メニューのみ表示する
      if (isset($submenu['edit.php?post_type=p-project'])) {
          return;
      }

      // 他のメニューを表示しない
      foreach ($submenu as $key => $value) {
          // カスタム投稿タイプ「p-project」に関係するメニュー以外は削除
          if ('edit.php?post_type=p-project' !== $key) {
              unset($submenu[$key]);
          }
      }

      // 管理画面を「p-project」にリダイレクト
      if (is_admin() && !isset($_GET['post_type']) && !isset($_GET['post'])) {
          wp_redirect(admin_url('edit.php?post_type=p-project'));
          exit;
      }
  }
}
add_action('admin_menu', 'restrict_editor_access_to_custom_post_type', 100);


// プレビューを削除
function remove_preview_button_for_p_project() {
  global $post_type;
  // カスタム投稿タイプのスラッグが 'p-project' の場合
  if ($post_type === 'p-project') {
      ?>
      <style>
          #post-preview, #post-preview-link { display: none !important; }
      </style>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              var previewButton = document.querySelector('#post-preview');
              if (previewButton) {
                  previewButton.remove();
              }
          });
      </script>
      <?php
  }
}
add_action('admin_head', 'remove_preview_button_for_p_project');

function disable_preview_for_p_project() {
  // カスタム投稿タイプのスラッグが 'p-project' で、プレビューがリクエストされた場合
  if (isset($_GET['post_type']) && $_GET['post_type'] === 'p-project' && isset($_GET['preview'])) {
      wp_die('プレビューは利用できません。');
  }
}
add_action('init', 'disable_preview_for_p_project');


//パスワード保護を無効
function hide_password_protection_elements() {
  global $post_type;
  if ($post_type === 'p-project') {
      ?>
      <script>
          document.addEventListener('DOMContentLoaded', function() {
              // パスワード保護ラジオボタンと関連要素を削除
              var passwordOption = document.querySelector('#visibility-radio-password');
              var passwordLabel = document.querySelector('label[for="visibility-radio-password"]');
              var passwordSpan = document.querySelector('#password-span');
              
              if (passwordOption) {
                  passwordOption.remove();
              }
              if (passwordLabel) {
                  passwordLabel.remove();
              }
              if (passwordSpan) {
                  passwordSpan.remove();
              }
          });
      </script>
      <style>
          /* その他の関連スタイルを非表示にする */
          #password-span, label[for="visibility-radio-password"], #visibility-radio-password {
              display: none !important;
          }
      </style>
      <?php
  }
}
add_action('admin_head', 'hide_password_protection_elements');

function disable_password_protection_for_p_project() {
  remove_post_type_support('p-project', 'password');
}
add_action('init', 'disable_password_protection_for_p_project');


//｢一括操作｣の｢編集｣を無効にする
function remove_bulk_edit_for_p_project($bulk_actions) {
  global $post_type;
  // 「p-project」投稿タイプの場合のみ
  if ($post_type === 'p-project') {
      unset($bulk_actions['edit']); // 「編集」オプションを削除
  }
  return $bulk_actions;
}
add_filter('bulk_actions-edit-p-project', 'remove_bulk_edit_for_p_project');




//ブロックエディタ編集画面設定
function add_block_editor_styles() {
  wp_enqueue_style( 'editor-styles', get_stylesheet_directory_uri() . '/css/editor-styles.css' );
}
add_action( 'enqueue_block_editor_assets', 'add_block_editor_styles' );

//実績のみクラシックエディターで表示
add_filter( 'use_block_editor_for_post', function( $use_block_editor, $post ) {
	if ( 'p-project' === $post->post_type ) {
		$use_block_editor = false;
	}
	return $use_block_editor;
}, 10, 2 );

//実績投稿ページで実績カテゴリーなどをサイドに表示させない
function my_remove_meta_boxes() {
  remove_meta_box('tagsdiv-t-project','p-project','normal' );    
  remove_meta_box('tagsdiv-t-word','p-project','normal' );    
}
add_action('admin_menu','my_remove_meta_boxes' );

//実績一覧に項目追加
function add_projects_posts_columns($columns) {
  $columns['t-category'] = 'カテゴリー';
  $columns['t-entruster'] = '委託元';
  $columns['t-year'] = '年度';
  $columns['t-year-western'] = '年度（西暦）';
  $columns['t-word'] = '検索ワード';
  $columns['t-top'] = 'トップページに表示';
  return $columns;
}
add_filter('manage_p-project_posts_columns', 'add_projects_posts_columns');

function add_posts_columns_element_row($column_name, $post_id) {
  if ( 't-category' == $column_name ) {
    // $terms = get_the_terms($post_id, $column_name);
    $term_ids = get_post_meta($post_id, 't-category', true);
    if($term_ids && !is_wp_error($term_ids)) {
      $menu_terms = array();
      foreach($term_ids as $term_id) {
        $term = get_term($term_id , 't-project');
        $menu_terms[] = $term->name;
      }
      echo join( ", ", $menu_terms);
    }
  }
  if ( 't-entruster' == $column_name ) {
      $element_value = get_post_meta($post_id, 't-entruster', true);
      echo ( $element_value ) ? $element_value : '－';
  }
  if ( 't-year' == $column_name ) {
      $element_value = get_post_meta($post_id, 't-year', true);
      echo ( $element_value ) ? $element_value : '－';
  }
  if ( 't-year-western' == $column_name ) {
      $element_value = get_post_meta($post_id, 't-year-western', true);
      echo ( $element_value ) ? $element_value : '－';
  }
  if ( 't-word' == $column_name ) {
      $element_value = get_post_meta($post_id, 't-word', true);
      echo ( $element_value ) ? $element_value : '－';
  }
  if ( 't-top' == $column_name ) {
      $element_value = get_post_meta($post_id, 't-top', true);
      echo ( $element_value ) ? '表示' : '－';
  }
}
add_action( 'manage_p-project_posts_custom_column', 'add_posts_columns_element_row', 10, 2 );

function add_post_taxonomy_restrict_filter() {
  global $post_type;
  if ( 'p-project' === $post_type ) {
      // 選択された値を取得
      $selected_term = isset($_GET['t-project']) ? sanitize_text_field($_GET['t-project']) : '';
      ?>
      <select name="t-project">
          <option value="">カテゴリー指定なし</option>
          <?php
          $args = array(
              'taxonomy' => 't-project',
              'hide_empty' => false,
          );
          $terms = get_terms($args);
          foreach ($terms as $term) { ?>
              <option value="<?php echo esc_attr($term->slug); ?>" <?php selected($selected_term, $term->slug); ?>>
                  <?php echo esc_html($term->name); ?>
              </option>
          <?php } ?>
      </select>
      <?php
  }
}
add_action( 'restrict_manage_posts', 'add_post_taxonomy_restrict_filter' );


//ソート機能
function custom_sortable_columns($sortable_column) {
  $sortable_column['t-category'] = 't-category';
  $sortable_column['t-entruster'] = 't-entruster';
  $sortable_column['t-year'] = 't-year';
  $sortable_column['t-year-western'] = 't-year-western';
  $sortable_column['t-word'] = 't-word';
  $sortable_column['t-top'] = 't-top';
  return $sortable_column;
}
add_filter( 'manage_edit-p-project_sortable_columns', 'custom_sortable_columns' );

// ソート時に数値として並べ替える
function sort_by_t_year_western($query) {
  if (!is_admin() || !$query->is_main_query()) {
      return;
  }

  // 't-year-western' カラムでソートが指定されている場合
  if ('t-year-western' === $query->get('orderby')) {
      $query->set('meta_key', 't-year-western');  // ソートするメタフィールドを指定
      $query->set('orderby', 'meta_value_num');   // 数値として並べ替え
  }
  if ('t-category' === $query->get('orderby')) {
    $query->set('tax_query', array(
        array(
            'taxonomy' => 't-project',  // タクソノミーのスラッグ
            'field'    => 'slug',
            'terms'    => $query->get('orderby'), // ソートされるターム（タクソノミー名）
            'operator' => 'IN',
        ),
      ));
    }
    if ('t-entruster' === $query->get('orderby')) {
      $query->set('meta_key', 't-entruster');
      $query->set('orderby', 'meta_value'); // 文字列として並べ替え
    }
    if ('t-word' === $query->get('orderby')) {
      $query->set('meta_key', 't-word');
      $query->set('orderby', 'meta_value'); // 文字列として並べ替え
    }
    if ('t-top' === $query->get('orderby')) {
      $query->set('meta_key', 't-top');
      $query->set('orderby', 'meta_value'); // 文字列として並べ替え
    }
}
add_action('pre_get_posts', 'sort_by_t_year_western');



// 和暦を西暦に変換
function convert_wareki_to_seireki($wareki) {
  $wareki = trim($wareki);

  // 令和
  if (preg_match('/^令和(\d+)$/', $wareki, $matches)) {
      return 2018 + (int)$matches[1];  
  }
  
  // 平成
  if (preg_match('/^平成(\d+)$/', $wareki, $matches)) {
      return 1988 + (int)$matches[1];  
  }
  
  // 昭和
  if (preg_match('/^昭和(\d+)$/', $wareki, $matches)) {
      return 1925 + (int)$matches[1];  
  }

  return 0;  // 無効な和暦の場合は0を返す
}


// function save_wareki_as_seireki($post_id, $post, $update) {
//   // 投稿タイプが 'p-project' の場合に処理
//   if ('p-project' === $post->post_type) {
//     // t-year カスタムフィールドから和暦の値を取得
//     $wareki = get_post_meta($post_id, 't-year', true);
    
//     // 和暦を西暦に変換
//     $seireki = convert_wareki_to_seireki($wareki);
    
//     // t-year-western カスタムフィールドに西暦を保存
//     update_post_meta($post_id, 't-year-western', $seireki);
//   }
// }
// add_action('save_post', 'save_wareki_as_seireki', 10, 3);

// 検索対象を変更
function custom_search($search, $wp_query) {
  global $wpdb;

  if (!$wp_query->is_search)
    return $search;
  if (!isset($wp_query->query_vars))
    return $search;
  if (is_admin()) 
    return $search;

  $str = isset($wp_query->query_vars['s']) ? $wp_query->query_vars['s'] : '';
  
  if (empty($str)) {
    return $search;
  }
  
  $str = mb_convert_kana($str, 's', 'utf-8');
  $search_words = explode(' ', $str);

  if ( count($search_words) > 0 ) {
    $search = '';
    $search .= "AND post_type = 'p-project'";
    foreach ( $search_words as $word ) {
      if ( !empty($word) ) {
          $search_word = '%' . esc_sql( $word ) . '%';
          $search .= " AND (
            {$wpdb->posts}.post_title LIKE '{$search_word}'
            OR {$wpdb->posts}.ID IN (
              SELECT distinct post_id
              FROM {$wpdb->postmeta}
              WHERE (
              (meta_key = 't-entruster' AND meta_value LIKE '{$search_word}')
              OR (meta_key = 't-year' AND meta_value LIKE '{$search_word}')
              OR (meta_key = 't-summary' AND meta_value LIKE '{$search_word}')
              OR (meta_key = 't-word' AND meta_value LIKE '{$search_word}')
              OR (meta_key = 't-year-western' AND meta_value LIKE '{$search_word}')
              )
            )
            OR {$wpdb->posts}.ID IN (
              SELECT object_id
              FROM {$wpdb->term_relationships}
              LEFT JOIN {$wpdb->terms} 
              ON {$wpdb->terms}.term_id = {$wpdb->term_relationships}.term_taxonomy_id
              LEFT JOIN {$wpdb->term_taxonomy}
              ON {$wpdb->term_taxonomy}.term_taxonomy_id = {$wpdb->term_relationships}.term_taxonomy_id
              WHERE {$wpdb->terms}.name LIKE '{$search_word}'
              AND {$wpdb->term_taxonomy}.taxonomy = 't-project'
            )
          ) ";
      }
    }
  }
  return $search;
}
add_filter('posts_search','custom_search', 10, 2);


// 投稿画面で入力必須設定
function post_edit_required() {
  ?>
  <script type="text/javascript">
  jQuery(function($) {
    if ('p-project' == $('#post_type').val()) { 
      
      // 「公開」ボタンがクリックされたときの処理
      $('#publish').click(function(e) {
        // タイトルフィールドの値を取得
        if ($('#title').val().trim() == '') {
          alert('タイトルを入力してください');
          
          // スピナーを隠す（投稿処理を防ぐ）
          $('.spinner').css('visibility', 'hidden');
          
          // 「公開」ボタンのスタイルをリセット
          $('#publish').removeClass('button-primary-disabled');
          
          // タイトルフィールドにフォーカス
          $('#title').focus();
          
          // フォーム送信をキャンセル
          return false;
        }
      });
    }
  });
  </script>
  <?php
}

add_action( 'admin_head-post-new.php', 'post_edit_required' );
add_action( 'admin_head-post.php', 'post_edit_required' );


add_filter('really_simple_csv_importer_save_meta', function($meta, $post, $is_update) {
    
  // もし`t-category`が存在していればシリアライズを解除
  if (isset($meta['t-category'])) {
      $str_array = $meta['t-category'];
      $meta_array = unserialize($str_array); // デシリアライズ
      $meta['t-category'] = $meta_array;    // 修正後の値をセット
  }
  
  return $meta;
  
}, 10, 3);