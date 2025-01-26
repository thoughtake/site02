<?php get_header(); ?>
  <div id="main-wrapper" class="wp-page wp-single">
    <main class="main">
      <?php if( have_posts() ) : ?>
        <?php while ( have_posts() ) : the_post(); ?>
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
        <?php endwhile; ?>
      <?php endif; ?>
    </main><!-- /.main -->
  </div><!-- /#main-wrapper.wp-single -->
<?php get_footer(); ?>