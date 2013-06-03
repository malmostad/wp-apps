jQuery(document).ready(function($) {
  // Redirect to Dashboard logout url after logout from WP
  $logout = $("#wp-admin-bar-logout a");
  $logout.attr("href", $logout.attr("href") + "&redirect_to=https%3A%2F%2Fwebapps06.malmo.se%2Fdashboard%2Flogout&");
});
