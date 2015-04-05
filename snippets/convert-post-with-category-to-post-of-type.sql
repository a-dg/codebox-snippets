# Old category ID: 5
# New post type: 'grant'

UPDATE wp_posts AS p
  INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id
  INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
  INNER JOIN wp_terms AS t ON t.term_id = tt.term_id
SET p.post_type = 'grant'
WHERE tt.taxonomy = 'category'
  AND p.post_status = 'publish'
  AND t.term_id = 5;
