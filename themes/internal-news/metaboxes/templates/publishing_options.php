<p class="instructions">Inställningar för publicering</p>

<fieldset>
  <?php $mb->the_field('cb_single'); ?>
  <input type="checkbox" id="<?php $mb->the_name(); ?>" name="<?php $mb->the_name(); ?>" <?php $mb->the_checkbox_state('abc'); ?>/>
  <label for="<?php $mb->the_name(); ?>">Huvudnyhet</label>
</fieldset>
