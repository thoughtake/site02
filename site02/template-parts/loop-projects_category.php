            <?php 
            $term = isset($args['term']) ? $args['term'] : null;
            $s = isset($args['s']) ? $args['s'] : ''; 

            //投稿タイプ
            $postargs = array(
              'post_type' => 'p-project',
              'posts_per_page' => -1,
              'post_status' => 'publish',
              'meta_query' => array(
                'relation' => 'AND',
                't-year-western' => array(
                  'key'     => 't-year-western',
                  'compare' => 'EXISTS',
                  'type'    => 'NUMERIC',  // 数値として比較
                ),
                't-priority' => array(
                  'key'     => 't-priority',
                  'compare' => 'EXISTS',
                  'type'    => 'NUMERIC',  // 数値として比較
                ),
              ),
              'orderby' => array(
                't-year-western' => 'DESC',  // t-year-western の降順
                't-priority' => 'DESC',      // t-priority の降順
                'date' => 'DESC',            // 投稿日の降順
              ),
            );
            if (!empty($s)) {
              $postargs['s'] = $s; // 検索キーワードを追加
            }

            //回答の種類で絞り込む
            $taxquerysp = array('relation' => 'AND');
            $taxquerysp[] = array(
              'taxonomy' => 't-project',
              'terms' => $term->slug,
              'field' => 'slug',
            );
            $postargs['tax_query'] = $taxquerysp;

            $the_query = new WP_Query($postargs);

            if ($the_query->have_posts()):
            ?>
            <div class="content-projects__wrapper  <?php echo esc_attr($term->slug); ?>" id="<?php echo esc_attr($term->slug); ?>">
              <h2 class="content-projects__title">
                <?php echo $term->name; ?>
              </h2>
              <div class="content-projects__table-wrapper js-scrollable">
                <table class="content-projects__table">
                  <tr>
                    <th class="th-1">案件名</th>
                    <th class="th-2">委託元</th>
                    <th class="th-3">年度</th>
                    <th class="th-4">概要</th>
                  </tr>
                    <?php if( $the_query->have_posts() ) : ?>
                      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                        <?php get_template_part('template-parts/loop', 'projects_project'); ?>
                      <?php endwhile; ?>
                    <?php endif; ?>
                </table><!-- /.content-projects__table -->
              </div><!-- /.content-projects__table-wrapper -->
            </div><!-- /.content-projects__wrapper -->
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>  