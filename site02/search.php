<?php get_header(); ?>
<?php 
  $s = isset($_GET['s']) ? esc_html($_GET['s']) : '';//キーワード
  $get_t = isset($_GET['get_t']) ? $_GET['get_t'] : array(); //カテゴリ

  // 件数を取得するクエリ
  $args = array(
    'post_type' => 'p-project',
    'posts_per_page' => -1,
    's' => $s,
  );

  // カテゴリが指定されている場合は絞り込み
  if ($get_t) {
    $args['tax_query'] = array(
        array(
            'taxonomy' => 't-project',
            'terms' => $get_t,
            'field' => 'slug',
        ),
    );
  }

  $search_query = new WP_Query($args);
  $total_results = $search_query->found_posts; // 検索結果の総件数
  wp_reset_postdata();

; ?>

  <div id="main-wrapper" class="wp-page page-projects">
    <main class="main">
      <div class="title-wrapper">
        <div class="container">
          <h1>会社実績</h1>
        </div><!-- /.container -->
      </div><!-- /.title-wrapper -->
      <div class="content-wrapper">
        <div class="container">
          <?php get_search_form(); ?>

          <!-- 件数を表示 -->
          <div class="content-result">
            <?php if ($total_results > 0): ?>
              <p>検索結果： <strong><?php echo number_format_i18n($total_results); ?></strong> 件の実績があります</p>
            <?php else: ?>
              <p class="no-result">検索に該当する実績はありません</p>
            <?php endif; ?>
          </div>  

          <div class="content-projects">
            <?php 
            $filtered_terms = array(); // 検索結果にヒットしたタームを格納する配列
            ?>

            <?php if ($get_t) : ?>

              <?php
                $terms = get_terms(
                  array(
                    'taxonomy' => 't-project', 
                    'orderby' => 'slug',      
                    'order' => 'ASC',     
                    'slug' => $get_t,
                    'hide_empty' => true,
                  ),
                );

                if (!empty($terms)) {
                  foreach($terms as $term) {
                    // 投稿を絞り込む
                    $postargs = array(
                      'post_type' => 'p-project',
                      'posts_per_page' => 1,
                      'tax_query' => array(
                        'relation' => 'AND',
                        array(
                          'taxonomy' => 't-project',
                          'terms' => $term->slug,
                          'field' => 'slug',
                        ),
                      ),
                      's' => $s, // 検索キーワードを追加
                    );
                    
                    $the_query = new WP_Query($postargs);
    
                    if ($the_query->have_posts()) {
                      $filtered_terms[] = $term;
                    }
          
                    wp_reset_postdata();
                  } // foreach($terms as $term)
                } // if (!empty($terms))

                if (!empty($filtered_terms)) {
                  foreach ($filtered_terms as $term) {
                    // 投稿を絞り込む
                    $postargs = array(
                        'post_type' => 'p-project',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 't-project',
                                'terms' => $term->slug,
                                'field' => 'slug',
                            ),
                        ),
                        's' => $s, // 検索キーワードを追加
                    );
            
                    $the_query = new WP_Query($postargs);
            
                    if ($the_query->have_posts()):
              ?>
                      <?php get_template_part('template-parts/links', 'projects', array('terms' => $filtered_terms)); ?>
                      <?php get_template_part('template-parts/loop', 'projects_category', array('term' => $term, 's' => $s)); ?>
              
              <?php
                    endif;
            
                    wp_reset_postdata();
                  } // foreach ($filtered_terms as $term)
                } // if (!empty($filtered_terms))
              ?>
              
            <?php else: //if ($get_t) ?> 

              <?php 
                $terms = get_terms(array(
                  'taxonomy' => 't-project',
                  'orderby' => 'slug',
                  'order' => 'ASC',
                ));

                if (!empty($terms)) {
                  foreach($terms as $term) {
                    // 投稿を絞り込む
                    $postargs = array(
                      'post_type' => 'p-project',
                      'posts_per_page' => 1,
                      'tax_query' => array(
                        'relation' => 'AND',
                        array(
                          'taxonomy' => 't-project',
                          'terms' => $term->slug,
                          'field' => 'slug',
                        ),
                      ),
                      's' => $s, // 検索キーワードを追加
                    );
                    
                    $the_query = new WP_Query($postargs);
    
                    if ($the_query->have_posts()) {
                      $filtered_terms[] = $term;
                    }
          
                    wp_reset_postdata();
                  } // foreach($terms as $term)
                } // if (!empty($terms))

                if (!empty($filtered_terms)) {
                  foreach ($filtered_terms as $term) {
                    // 投稿を絞り込む
                    $postargs = array(
                        'post_type' => 'p-project',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 't-project',
                                'terms' => $term->slug,
                                'field' => 'slug',
                            ),
                        ),
                        's' => $s, // 検索キーワードを追加
                    );
            
                    $the_query = new WP_Query($postargs);
            
                    if ($the_query->have_posts()):
              ?>
                      <?php get_template_part('template-parts/links', 'projects', array('terms' => $filtered_terms)); ?>
                      <?php get_template_part('template-parts/loop', 'projects_category', array('term' => $term, 's' => $s)); ?>
              
              <?php
                    endif;
            
                    wp_reset_postdata();
                  } // foreach ($filtered_terms as $term)
                } // if (!empty($filtered_terms))
              ?>

            <?php endif; //if ($get_t) ?>
          </div><!-- /.content-projects -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      
    </main><!-- /.main -->
  </div><!-- /#main-wrapper.wp-single -->
<?php get_footer(); ?>