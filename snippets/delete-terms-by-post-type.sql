DELETE tr
FROM wp_term_relationships AS tr
  INNER JOIN wp_posts AS p ON p.ID = tr.object_id
WHERE p.post_type = 'post'
  AND tr.term_taxonomy_id != 1
