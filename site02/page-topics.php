<?php get_header(); ?>
  <div id="main-wrapper" class="wp-page page-topics">
    <main class="main">
      <div class="title-wrapper">
        <div class="container">
          <h1><?php the_title(); ?></h1>
        </div><!-- /.container -->
      </div><!-- /.title-wrapper -->
      <div class="content-wrapper">
        <div class="container">
          <?php the_content(); ?>
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      <div class="link-wrapper">
        <div class="container">
          <ul>
            <li>
              <a href="<?php the_permalink('6') ?>">
                文章
              </a>
            </li>
            <li>
              <a href="<?php the_permalink('6') ?>">
                文章
              </a>
            </li>
            <li>
              <a href="<?php the_permalink('6') ?>">
                文章
              </a>
            </li>
            <li>
              <a href="<?php the_permalink('6') ?>">
                文章
              </a>
            </li>
            <li>
              <a href="<?php the_permalink('6') ?>">
                文章
              </a>
            </li>
          </ul>          
        </div><!-- /.container -->
      </div><!-- /.link-wrapper -->
    </main><!-- /.main -->
  </div><!-- /#main-wrapper.wp-single -->
<?php get_footer(); ?>