SELECT *
FROM wp_posts AS p
  INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id
  INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
WHERE tt.taxonomy = 'category'
  AND tt.term_id IN (153, 156)
ORDER BY p.post_date DESC;