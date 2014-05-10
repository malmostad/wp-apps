<?php
global $wp_query;
if ($wp_query->max_num_pages > 1): ?>
  <nav>
    <ul class="pagination" >
      <li class="previous"><?php previous_posts_link('Senare inlägg') ?></li>
      <li class="next"><?php next_posts_link('Tidigare inlägg') ?></li>
    </ul>
  </nav>
<?php endif; ?>
