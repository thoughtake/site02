<tr>
    <td class="td-1" id="project-<?php echo get_the_ID(); ?>">
        <?php the_title(); ?>
    </td>
    <td class="td-2">
        <?php echo esc_html(get_field('t-entruster')); ?>
    </td>
    <td class="td-3">
        <?php echo esc_html(get_field('t-year')); ?>
    </td>
    <td class="td-4">
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
    </td>
</tr>
