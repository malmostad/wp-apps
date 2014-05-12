<?php
global $wp_query;
if ($wp_query->max_num_pages > 1): ?>
  <nav>
    <ul class="pagination">
      <?php if (strlen(get_previous_posts_link())): ?>
        <li class="previous"><?php previous_posts_link('Senare inlägg') ?></li>
      <?php endif ?>
      <li class="next"><?php next_posts_link('Tidigare inlägg') ?></li>
    </ul>
  </nav>
<?php endif; ?>
