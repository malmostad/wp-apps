<?php if (function_exists('DisplayVotes')) { ?>
<div <?php if (GetVotes(get_the_ID())) { echo 'data-vote="' . get_the_ID() . '" class="vote-box"'; } ?>>
  <?php DisplayVotes(get_the_ID()); ?>
</div>
<?php } ?>
