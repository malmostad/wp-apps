<?php
/**
 * Template Name: Authors
 */
get_header() ?>

<main class="authors" role="main">
  <h1 class="body-copy"><?php echo get_the_title() ?></h1>
  <nav class="basic">
    <ul>
      <?php wp_list_authors(array('show_fullname' => 1,
        'optioncount' => 1,
        'orderby' => 'name'))
      ?>
    </ul>
  </nav>
</main>

<?php get_template_part('aside') ?>
<?php get_footer() ?>
