<footer id="footer" class="footer">
      <div class="footer__top">
        <div class="wrapper">
          <div class="footer__logo">
            <a href="<?php echo home_url(); ?>">
              <img src="<?php echo get_template_directory_uri(); ?>/img/logo.jpg" alt="株式会社 リベルタス・コンサルティング">
            </a>
          </div><!-- /.footer__logo -->
          <div class="wrapper">
            <div class="footer__info">
              <p><span>企業名</span><span>住所</span></p>
            </div><!-- /.footer__info -->
            <div class="wrapper">
              <nav class="footer__nav">
                <ul>
                  <li><a href="#"><span>お問い合わせ</span></a></li>
                  <li><a href="#"><span>ご利用にあたって</span></a></li>
                  <li><a href="#"><span>個人情報保護方針</span></a></li>
                  <li><a href="#"><span>サイトマップ</span></a></li>
                </ul>
              </nav><!-- /.footer__nav -->
              <div class="footer__num">
                法人番号
              </div><!-- /.footer__num -->
            </div><!-- /.wrapper -->
          </div><!-- /.wrapper -->
        </div><!-- /.wrapper -->
        <div class="footer__privacy">
          <img src="<?php echo get_template_directory_uri(); ?>/img/privacy.png" alt="プライバシーマーク">
        </div><!-- /.footer__privacy -->
      </div><!-- /.footer__top -->
      <div class="footer__bottom">
        <div class="copyright">
          &copy; Co., Ltd. All rights reserved.
        </div><!-- /.copyright -->
      </div><!-- /.footer__bottom -->

    </footer><!-- /.footer -->

    <div id="page-top" class="back-to-top">
      <i class="fa-solid fa-angle-up"></i>
    </div><!-- /#page-top -->

    <?php 
      wp_enqueue_script('jquery');    
      wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('date-picker', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('scroll-hint', 'https://unpkg.com/scroll-hint@latest/js/scroll-hint.min.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('cmn', get_template_directory_uri() . '/js/common.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('header', get_template_directory_uri() . '/js/header.js', array( 'jquery' ), '1.0.0', true);
      wp_enqueue_script('projects', get_template_directory_uri() . '/js/projects.js', array( 'jquery' ), '1.0.0', true);
      wp_footer(); 
    ?>
  </body>
</html>