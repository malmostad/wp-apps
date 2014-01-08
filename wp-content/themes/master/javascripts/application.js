jQuery(document).ready(function($) {
  $('#wpadminbar').css("top", "3.15em");

  $('#wp-admin-bar-search').hide();

  $('#adminbarsearch input.adminbar-button').val('Sök i bloggarna');

  // Hack to buttonize WP hard coded markup
  $('#submit').addClass('btn btn-primary');
  $('.reply a').addClass('btn btn-mini');
});
