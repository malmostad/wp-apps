<section id="comments">
	<?php if ( post_password_required() ) : ?>
	<p class="nopassword">Det här inlägget är lösenordsskyddat. Ange lösenordet för att se eventuella kommentarer.</p>
  <?php
  	return;
	endif;

  if ( have_comments() ) : ?>
  	<h1>Kommentarer</h1>
  	<ol>
  		<?php wp_list_comments(array("avatar_size"=>200)) ?>
  	</ol>

  	<?php if ( ! comments_open() ) : ?>
  		<p class="nocomments">Kommentarer inaktiverade.</p>
  	<?php endif; 
  endif;

  comment_form(array('comment_notes_after' => '', 'post' => '<h1>btn</h1>')); ?>
</section>
