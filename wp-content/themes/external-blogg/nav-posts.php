<?php
global $wp_query;
if ($wp_query->max_num_pages > 1): ?>
  <nav>
    <ul class="pagination">
      <li class="previous"><?php next_posts_link('Äldre inlägg') ?></li>
      <?php if (strlen(get_previous_posts_link())): ?>
        <li class="next"><?php previous_posts_link('Nyare inlägg') ?></li>
      <?php endif ?>
    </ul>
  </nav>
<?php endif; ?>
