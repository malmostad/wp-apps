<?php
// Theme helper methods

// Set SAVEQUERIES in wp-config to log sql queries
function log_db_queries() {
  if ( SAVEQUERIES ) {
    global $wpdb;
    error_log(var_export($wpdb->queries, true));
    $sum = 0;
    foreach ($wpdb->queries as $query) { $sum +=  $query[1]; }
    error_log("TOTAL SQL TIME: " . $sum);
  }
}
