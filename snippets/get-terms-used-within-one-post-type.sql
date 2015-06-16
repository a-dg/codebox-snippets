SELECT DISTINCT
  t.term_id,
  t.name,
  t.slug,
  tt.taxonomy
FROM wp_terms AS t
INNER JOIN wp_term_taxonomy AS tt ON tt.term_id = t.term_id
INNER JOIN wp_term_relationships AS tr ON tr.term_taxonomy_id = tt.term_taxonomy_id
INNER JOIN wp_posts AS p ON p.ID = tr.object_id
WHERE p.post_type = 'post-type'
AND p.post_status = 'publish'
ORDER BY t.name ASC
