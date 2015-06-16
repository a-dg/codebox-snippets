$sql = sprintf(
  "SELECT p.ID
  FROM %s AS p
    INNER JOIN %s AS tr_gender ON (p.ID = tr_gender.object_id)
    INNER JOIN %s AS tr_step ON (p.ID = tr_step.object_id)
  WHERE tr_gender.term_taxonomy_id = %d
    AND tr_step.term_taxonomy_id = %d
    AND p.post_type = 'ready-question'
    AND p.post_status = 'publish'
  ORDER BY p.menu_order ASC",
  $wpdb->posts,
  $wpdb->term_relationships,
  $wpdb->term_relationships,
  $gender_term_id,
  $step_term_id
);
