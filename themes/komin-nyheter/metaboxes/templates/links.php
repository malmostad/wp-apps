<a href="#" class="dodelete-links button">Ta bort alla</a>

<p class="instructions">Länkar till ytterligare information. Kan vara både interna och externa länkar.</p>
<fieldset>
  <?php while($metabox->have_fields_and_multi('links')): ?>

    <?php $metabox->the_group_open(); ?>
      <div class="link-text">
        <label for="<?php $metabox->the_name('title'); ?>"?>Länktext: </label>
        <input type="text" name="<?php $metabox->the_name('title'); ?>" id="<?php $metabox->the_name('title'); ?>" value="<?php $metabox->the_value('title'); ?>"/>
      </div>

      <div class="link-url">
        <label for="<?php $metabox->the_name('link') ?>">URL: </label>
        <input type="text" name="<?php $metabox->the_name('link'); ?>" id="<?php $metabox->the_name('link'); ?>" value="<?php $metabox->the_value('link'); ?>"/>
      </div>
      <a href="#" class="dodelete button">Ta bort</a>
    <?php $metabox->the_group_close(); ?>

  <?php endwhile; ?>
  <a href="#" class="docopy-links button">Lägg till länk</a>
</fieldset>
