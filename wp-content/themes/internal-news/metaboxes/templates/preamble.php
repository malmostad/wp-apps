<?php global $content_width; ?>

<div class="mb_control">
	<label for="<?php $metabox->the_name('preamble'); ?>">Ingress <span>(obligatoriskt)</span></label>
	<p>
		<textarea id="<?php $metabox->the_name('preamble'); ?>" name="<?php $metabox->the_name('preamble'); ?>" rows="6"><?php $metabox->the_value('preamble') ?></textarea>
    <span>[Eventuella ytterligare instruktioner]</span>
	</p>
</div>
