# Old category ID: 5
# New post type: 'grant'
UPDATE wp_posts AS p
  INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id
  INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
  INNER JOIN wp_terms AS t ON t.term_id = tt.term_id
SET p.post_type = 'grant'
WHERE tt.taxonomy = 'category'
  AND t.term_id = 5;

# Remove categories from posts
DELETE
FROM wp_term_relationships
WHERE object_id IN (
  SELECT ID
  FROM wp_posts
  WHERE post_type = 'grant'
)
AND term_taxonomy_id IN (
  SELECT term_taxonomy_id
  FROM wp_term_taxonomy
  WHERE taxonomy = 'category'
)
