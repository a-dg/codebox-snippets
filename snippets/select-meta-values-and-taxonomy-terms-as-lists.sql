SELECT
  pp.post_title AS title,
  pp.post_date AS date_published,
  REPLACE(states, '&amp;', '&') AS states,
  REPLACE(keywords, '&amp;', '&') AS keywords,
  organization,
  publisher,
  external_url

FROM wp_posts AS pp


# Meta fields

LEFT OUTER JOIN (
  SELECT DISTINCT pm.post_id AS ID, pm.meta_value AS organization
  FROM wp_postmeta AS pm
  WHERE pm.meta_key = 'organization'
) organization_subquery ON pp.ID = organization_subquery.ID

LEFT OUTER JOIN (
  SELECT DISTINCT pm.post_id AS ID, pm.meta_value AS publisher
  FROM wp_postmeta AS pm
  WHERE pm.meta_key = 'publisher'
) publisher_subquery ON pp.ID = publisher_subquery.ID

LEFT OUTER JOIN (
  SELECT DISTINCT pm.post_id AS ID, pm.meta_value AS external_url
  FROM wp_postmeta AS pm
  WHERE pm.meta_key = 'external_url'
) external_url_subquery ON pp.ID = external_url_subquery.ID


# Taxonomy terms

LEFT OUTER JOIN (
  SELECT DISTINCT p.ID, p.post_title, GROUP_CONCAT(DISTINCT t.name ORDER BY t.name ASC SEPARATOR '; ') AS states
  FROM wp_posts AS p
    INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id
    INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    INNER JOIN wp_terms AS t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'state'
  GROUP BY p.ID
) states_subquery ON pp.ID = states_subquery.ID

LEFT OUTER JOIN (
  SELECT DISTINCT p.ID, p.post_title, GROUP_CONCAT(DISTINCT t.name ORDER BY t.name ASC SEPARATOR '; ') AS keywords
  FROM wp_posts AS p
    INNER JOIN wp_term_relationships AS tr ON p.ID = tr.object_id
    INNER JOIN wp_term_taxonomy AS tt ON tr.term_taxonomy_id = tt.term_taxonomy_id
    INNER JOIN wp_terms AS t ON t.term_id = tt.term_id
  WHERE tt.taxonomy = 'keyword'
  GROUP BY p.ID
) keywords_subquery ON pp.ID = keywords_subquery.ID

WHERE pp.post_type = 'resource'
AND pp.post_status = 'publish'
ORDER BY pp.post_date ASC;