<?php get_header(); ?>
  <div id="main-wrapper" class="wp-page page-projects">
    <main class="main">
      <div class="title-wrapper">
        <div class="container">
          <h1><?php the_title(); ?></h1>
        </div><!-- /.container -->
      </div><!-- /.title-wrapper -->
      <div class="content-wrapper">
        <div class="container">
          <?php get_search_form(); ?>

          <div class="content-projects">
            <? 
            $s = isset($_GET['s']) ? esc_html($_GET['s']) : '';
            $terms = get_terms(array(
              'taxonomy' => 't-project',
              'orderby' => 'slug',
              'order' => 'ASC',
            ));

            if (!empty($terms)):
            ?>

            <?php foreach($terms as $term): ?>
              <?php get_template_part('template-parts/links', 'projects', array('terms' => $terms)); ?>
              <?php get_template_part('template-parts/loop', 'projects_category', array('term' => $term, 's' => $s)); ?>
            <?php endforeach; ?>
            <?php endif; ?>   
          </div><!-- /.content-projects -->
        </div><!-- /.container -->
      </div><!-- /.content-wrapper -->
      
    </main><!-- /.main -->
  </div><!-- /#main-wrapper.wp-single -->
<?php get_footer(); ?>