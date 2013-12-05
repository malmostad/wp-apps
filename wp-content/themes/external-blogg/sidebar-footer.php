<!--eri-no-index-->
<section class="categories">
  <?php
    // Split categories in 4 columns
    $items = get_terms('category', array( 'parent' => 0, 'hide_empty' => false));
    $cols = array_chunk($items, ceil(count($items) / 4));

    for ($i=0; $i < count($cols); $i++) {
      echo "<ul class='col-{$i}'>";
      foreach ($cols[$i] as $item) {
        printf('<li><a href="%2$s">%1$s</a> <span class="count">(%3$d)</span></li>',
          $item->name,
          get_term_link($item, 'category'),
          $item->count
        );
      }
      echo '</ul>';
    }
  ?>
</section>
<!--/eri-no-index-->
