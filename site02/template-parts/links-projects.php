<?php
$terms = isset($args['terms']) ? $args['terms'] : array();

// タームごとのリンク生成
if (!empty($terms)): ?>
    <div class="content-projects__links">
      <ul>
      <?php foreach ($terms as $term): ?>
        <li>
          <a href="#<?php echo esc_attr($term->slug); ?>">
              <?php echo esc_html($term->name); ?>
          </a>
          <span>/</span>
        </li>
      <?php endforeach; ?>
        <li>
          <a class="back-to-top">ページTOP</a>
        </li>
      </ul>
    </div><!-- /.content-projects__links -->
<?php endif; ?>
