<?php get_header(); ?>
  <div id="main-wrapper" class="wp-front-page">
    <main class="main">

      <!-- メインセクション -->
      <section class="section-visual">
        <div class="container">
          <div class="slide-box">
            <div class="box-title">最新実績</div>
            <div class="slider">
            <!-- 各実績 -->
            <?php 
            // 最新の 5 件を取得
            $postargs = array(
              'post_type' => 'p-project',
              'posts_per_page' => 5,
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
            $the_query = new WP_Query($postargs);
            ?>

            <?php if ($the_query->have_posts()): ?>
              <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
                  <!-- 各実績 -->
                <div class="slider-item">
                  <div class="slider-item__wrapper">
                    <div class="slider-item__title">
                        <span>案件名</span>
                    </div><!-- /.slider-item__title -->
                    <p class="slider-item__text">
                        <?php the_title(); ?>
                    </p><!-- /.slider-item__text -->
                    <div class="slider-item__title">
                        <span>委託元</span>
                    </div><!-- /.slider-item__title -->
                    <p class="slider-item__text">
                        <?php echo esc_html(get_field('t-entruster')); ?>
                    </p><!-- /.slider-item__text -->
                    <div class="slider-item__title">
                        <span>年度</span>
                    </div><!-- /.slider-item__title -->
                    <p class="slider-item__text">
                        <?php echo esc_html(get_field('t-year')); ?>
                    </p><!-- /.slider-item__text -->
                    <div class="slider-item__title">
                        <span>概要</span>
                    </div><!-- /.slider-item__title -->
                    <p class="slider-item__text">
                    <?php 
                    $t_url = get_field('t-url'); 
                    $t_summary = get_field('t-summary'); 
                    ?>
                    <?php if ($t_url): ?> 
                        <a href="<?php echo esc_url($t_url); ?>" target="_blank">
                            <?php echo esc_html($t_summary); ?>
                        </a>
                    <?php else: ?>
                        <?php echo esc_html($t_summary); ?>
                    <?php endif; ?>
                    </p><!-- /.slider-item__text -->
                  </div><!-- /.slider-item__wrapper -->
                  <div class="slider-item__link">
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('projects')) . '#project-' . get_the_ID()); ?>">
                        <span><i class="fa-solid fa-angle-right"></i></span>詳しくはこちら
                    </a>
                  </div><!-- /.slider-item__link -->
                </div><!-- /.slider-item -->
              <?php endwhile; ?>
            <?php endif; ?>
            <?php wp_reset_postdata(); ?>


            </div><!-- /.slider -->
            <div class="arrow-box"></div><!-- /.arrow_box -->
          </div><!-- /.slide-box -->

          <div class="pickup-box">
            <div class="wrapper">
              <div class="pickup-box__box nolink thumbnail">
                <img src="<?php echo get_template_directory_uri(); ?>/img/20thlogo01.png" alt="20thイメージ">
                <p>
                  <span>
                    <span>文章</span>
                    <span>文章</span>
                    <span>文章</span>
                  </span>
                </p>
                <span class="angle-box">
                  <i class="fa-solid fa-angle-right"></i>
                </span><!-- /.angle-box -->
              </div><!-- /.pickup-box__box -->
            </div><!-- /.wrapper -->
            <div class="wrapper">
              <div class="pickup-box__box">
                <a href="#">
                  <p>
                    <span>
                      文章
                    </span>
                  </p>
                  <span class="angle-box">
                    <i class="fa-solid fa-angle-right"></i>
                  </span><!-- /.angle-box -->
                </a>
              </div><!-- /.pickup-box__box -->
            </div><!-- /.wrapper -->
            <div class="wrapper">
              <div class="pickup-box__box">
                <a href="#">
                  <p>
                    <span>
                      文章
                    </span>
                  </p>
                  <span class="angle-box">
                    <i class="fa-solid fa-angle-right"></i>
                  </span><!-- /.angle-box -->
                </a>
              </div><!-- /.pickup-box__box -->
            </div><!-- /.wrapper -->
            <div class="wrapper">
              <div class="pickup-box__box">
                <a href="#">
                  <p>
                    <span>
                      文章
                    </span>
                  </p>
                  <span class="angle-box">
                    <i class="fa-solid fa-angle-right"></i>
                  </span><!-- /.angle-box -->
                </a>
              </div><!-- /.pickup-box__box -->
            </div><!-- /.wrapper -->
          </div><!-- /.pickup-box -->
        </div><!-- /.container -->
      </section>

      <!-- 新着情報 -->
      <section class="section-news">
        <div class="container">
          <div class="news-box">
            <!-- タブ -->
            <div class="news-box__tabs">
              <div class="news-box__tabs__tab active" id="js-tab-1">
                <i class="fa-solid fa-angle-right"></i>
                  新着情報
              </div><!-- /.news-box__tabs__tab -->
              <div class="news-box__tabs__tab" id="js-tab-2">
                <i class="fa-solid fa-angle-right"></i>
                  お知らせ
              </div><!-- /.news-box__tabs__tab -->
              <div class="news-box__tabs__tab" id="js-tab-3">
                <i class="fa-solid fa-angle-right"></i>
                  分野
              </div><!-- /.news-box__tabs__tab -->
            </div><!-- /.news-box__tab -->

            <!--            -->
            <!-- コンテンツ 新着情報 -->
            <div class="wrapper active" id="js-content-1">
              <div class="news-box__contents">
                <ul>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年7月9日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年5月23日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年5月23日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年2月5日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年1月12日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2023年4月28日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2023年4月26日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2022年5月11日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2022年2月25日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年10月11日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                </ul>
              </div><!-- /.news-box__contents -->
              <div class="news-box__button">
                <a href="#" class="all-button">
                  すべての新着情報を見る
                  <i class="fa-solid fa-angle-right"></i>
                </a><!-- /.all-button -->
                <a href="#" class="rss-button">
                  <i class="fa-solid fa-rss"></i>RSS
                </a><!-- /.rss-button -->
              </div><!-- /.news-box__button -->
            </div><!-- /.wrapper -->

            <!--            -->
            <!-- コンテンツ お知らせ -->
            <div class="wrapper" id="js-content-2">
              <div class="news-box__contents">
                <ul>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年7月9日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年2月5日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年1月12日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2022年2月25日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年10月11日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年7月13日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年04月16日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年1月8日</time>
                        <span class="category news">
                          お知らせ  
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2020年10月1日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2020年4月14日</time>
                        <span class="category news">
                          お知らせ
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                </ul>
              </div><!-- /.news-box__contents -->
              <div class="news-box__button">
                <a href="#" class="all-button">
                  すべてのお知らせを見る
                  <i class="fa-solid fa-angle-right"></i>
                </a><!-- /.all-button -->
                <a href="#" class="rss-button">
                  <i class="fa-solid fa-rss"></i>RSS
                </a><!-- /.rss-button -->
              </div><!-- /.news-box__button -->
            </div><!-- /.wrapper -->

            <!--            -->
            <!-- コンテンツ 分野-->
            <div class="wrapper" id="js-content-3">
              <div class="news-box__contents">
                <ul>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年5月23日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2024年5月23日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2023年4月28日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2023年4月26日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2022年5月11日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2022年4月8日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                      文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2021年9月30日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                      文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2018年5月22日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2017年6月16日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                  <!-- 1単位 -->
                  <li class="news-box__contents__content">
                    <a href="#">
                      <div class="news-box__contents__content__info">
                        <time class="time" datetime="">2017年1月4日</time>
                        <span class="category topics">
                          分野
                        </span><!-- /.category -->
                      </div><!-- /.news-box__coお知らせntents__content__info -->
                      <p class="news-box__contents__content__text">
                        文章
                      </p><!-- /.news-box__contents__content__text -->
                    </a>
                  </li>
                </ul>
              </div><!-- /.news-box__contents -->
              <div class="news-box__button">
                <a href="<?php echo home_url('/topics'); ?>" class="all-button">
                  すべての分野を見る
                  <i class="fa-solid fa-angle-right"></i>
                </a><!-- /.all-button -->
                <a href="#" class="rss-button">
                  <i class="fa-solid fa-rss"></i>RSS
                </a><!-- /.rss-button -->
              </div><!-- /.news-box__button -->
            </div><!-- /.wrapper -->
          </div><!-- /.news-box -->
        </div>
      </section><!-- /.section-news -->

      <!-- アピールスペース -->
      <section class="section-appeal01">
        <div class="container">
          <div class="section-appeal01__left-box">
            <div class="wrapper">
              <div class="appeal-box">
                <a href="<?php echo home_url('/projects'); ?>">
                  <p>
                    <span>
                      過去の実績はこちら
                    </span>
                  </p>
                  <span class="angle-box">
                    <i class="fa-solid fa-angle-right"></i>
                  </span><!-- /.angle-box -->
                </a>
            </div><!-- /.appeal__box -->
            </div><!-- /.wrapper -->

          </div><!-- /.section-appeal01__left-box -->
          <div class="section-appeal01__right-box">
          </div><!-- /.section-appeal01__right-box -->
        </div><!-- /.container -->

      </section><!-- /.appeal01 -->

      <section class="section-group">
        <div class="container">
          <div class="group ad">
            <a href="#">
              <img src="<?php echo get_template_directory_uri(); ?>/img/ad-logo02.png" alt="企業名" class="logo">
            </a>
          </div><!-- /.group -->
          <div class="group eco">
            <a href="#">
              <p>企業名</p>
              <img src="<?php echo get_template_directory_uri(); ?>/img/hpb_i_top01.jpg" alt="企業名" class="bk">
            </a>
          </div><!-- /.group -->
          <div class="group terra">
            <a href="#">
              <p>企業名</p>
            </a>
          </div><!-- /.group -->
        </div><!-- /.container -->
      </section><!-- /.section-group -->

    </main><!-- /.main -->
  </div><!-- /#main-wrapper.wp-front-page -->
<?php get_footer(); ?>