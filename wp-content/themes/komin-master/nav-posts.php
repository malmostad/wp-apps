<?php
  global $wp_query;
  if ($wp_query->max_num_pages > 1): ?>
  <menu class="history" type="toolbar">
    <li class="next"><?php previous_posts_link( '<span class="title">' . __('Senare inlägg', 'malmo') .'</span><span class=" icon-circle-arrow-right icon-large"></span>' ); ?></li>
    <li class="previous"><?php next_posts_link( '<span class="icon-circle-arrow-left icon-large"></span><span class="title">' . __('Tidigare inlägg', 'malmo') . '</span>' ); ?></li>
  </menu>
<?php endif; ?>
