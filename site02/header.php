<!doctype html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/scroll-hint@latest/css/scroll-hint.css"/>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/all.min.css?<?php echo date('Ymd-Hi'); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/style.css?<?php echo date('Ymd-Hi'); ?>">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css?<?php echo date('Ymd-Hi'); ?>">
  <?php  
    wp_enqueue_style('date-picker', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css', array(), '1.0.0');    
  ; ?>  
  <?php if (has_post_thumbnail()) : ?>
  <meta property="og:image" content="<?php the_post_thumbnail_url(); ?>" />
  <?php else: ?>
  <meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
  <?php endif; ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
  <header id="header">
    <div class="container">
      <div class="header-top">
        <div class="header-top__left">
          <a href="<?php echo home_url(); ?>" class="header-top__left__logo">
          <?php if ( is_front_page() ): ?>
            <h1>
              <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="">
            </h1>
          <?php else: ?>
            <div class="logo-wrapper">
              <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="">
            </div><!-- /.wrapper -->
          <?php endif; ?>
          </a>
          <a href="<?php echo home_url(); ?>" class="header-top__left__logo-jp">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo-jp.jpg" alt="和文ロゴ" class="logo-jp-l">
            <img src="<?php echo get_template_directory_uri(); ?>/img/logo-jp-p.jpg" alt="和文ロゴ" class="logo-jp-p">
          </a>
        </div><!-- /.header-top__left -->
        <div class="header-top__right">
          <div class="header-top__right__top">
            <a href="#" class="header-top__right__top__access"><i class="fa-solid fa-location-dot"></i><span>交通案内</span></a>
          </div><!-- /.header-top__right__top -->
          <div class="header-top__right__bottom">
            <p></p>
          </div><!-- /.header-top__right__top -->


          <a class="access-btn">
            <i class="fa-solid fa-location-dot"></i>
          </a><!-- /.access-btn -->
          <div class="open-btn">
            <span></span><span></span><span></span>
          </div><!-- /.open-btn -->
        </div><!-- /.header-top__right -->

      </div><!-- /.header-top -->
      <div class="header-bottom">
        <nav class="header-bottom__nav">
          <ul>
            <li><a href="<?php echo home_url(); ?>" <?php if( is_front_page() ): ?>class="current"<?php endif; ?>><span>ホーム</span></a></li>
            <li><a href="#"><span>事業内容</span><i class="fa-solid fa-caret-down"></i></a></li>
            <li><a href="<?php echo home_url('/topics'); ?>" <?php if( is_page("topics") || ( is_single() && in_category(2))) : ?>class="current"<?php endif; ?>><span>分野</span></a></li>
            <li>
              <a href="<?php echo home_url('/projects'); ?>" 
                <?php if (is_page("projects") || is_search()) : ?>class="current"<?php endif; ?>>
                <span>実績</span>
              </a>
            </li>
            <li><a href="#"><span>出版・企画制作</span></a></li>
            <li><a href="#"><span>会社情報</span><i class="fa-solid fa-caret-down"></i></a></li>
            <li><a href="#"><span>お問い合わせ</span></a></li>
          </ul>
        </nav><!-- /.header-bottom__nav -->
      </div><!-- /.header-bottom -->

    </div><!-- /.container -->
    

  </header><!-- /#header -->

  <nav id="open-nav">
    <div id="open-nav__list">

    </div><!-- /#open-nav__list -->
  </nav><!-- /#open-nav -->