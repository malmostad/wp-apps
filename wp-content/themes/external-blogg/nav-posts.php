<?php
global $wp_query;
if ($wp_query->max_num_pages > 1): ?>
  <nav>
    <ul class="pagination" >
      <li><?php previous_posts_link('&laquo; Senare inlägg') ?></li>
      <li><?php next_posts_link('Tidigare inlägg &raquo;') ?></li>
    </ul>
  </nav>
<?php endif; ?>
