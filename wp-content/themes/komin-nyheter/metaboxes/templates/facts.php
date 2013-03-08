<?php
  global $content_width;
  $facts = get_post_meta($post->ID, '_metabox_facts', true);
?>

<div class="mb_control customEditor">
  <p>I faktarutan bryter du ut innehåll som innehåller bakgrundsinformation och liknande.</p>
  <label class="hide-if-js" for="<?php $metabox->the_name('facts'); ?>">Faktaruta<span> (frivilligt)</span></label>
	<textarea id="metabox_facts" name="<?php $metabox->the_name('facts'); ?>"  style="width: <?php echo $content_width ?>px" rows="14"><?php echo wp_richedit_pre($facts['facts']); ?></textarea>
</div>


