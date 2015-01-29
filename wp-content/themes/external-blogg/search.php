<?php
/**
 * The template for displaying Search Results pages.
 */
get_header(); ?>

<section class="search" role="main">
	<?php if ( have_posts() ) : ?>
		<div class="page-title clearfix">
			<h1>Sökresultat för: <?php echo get_search_query() ?></h1>
		</div>
		<?php
      $template_vars = array('title' => 'Sök');
      get_template_part('loop');
     ?>

	<?php else : ?>
		<div id="post-0" class="post no-results not-found">
			<h2 class="entry-title">Inget kunde hittas</h2>
			<div class="entry-content">
				<p>Ledsen, men inga matchande resultat kunde hittas baserat på dina kriterier. Var vänlig försök med andra sökord.</p>
				<?php get_search_form(); ?>
			</div>
		</div>
	<?php endif; ?>
</section>

<?php
  get_template_part('aside');
  get_footer();
?>
