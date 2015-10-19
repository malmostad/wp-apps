<ul class="entry-meta">
  <li>Kategorier</li>
  <?php $terms = get_the_category(); ?>
  <?php foreach( ($terms ) as $term ) { ?>
    <li>
      <a href="<?php echo bloginfo("url") . '/' . $term->taxonomy . '/' . $term->slug ?>"><?php echo $term->name ?></a><?php if ($term != end($terms)) { echo ","; }?>
    </li>
  <?php } ?>
</ul>

<ul class="entry-tags">
  <li>Etiketter</li>
  <?php echo get_the_tag_list('<li>',', </li><li>','</li>'); ?>
</ul>
