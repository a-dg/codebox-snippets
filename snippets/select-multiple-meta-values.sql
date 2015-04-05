SELECT
  p.ID,
  pm_first.meta_value,
  pm_last.meta_value
FROM wp_posts AS p
  INNER JOIN wp_postmeta AS pm_first ON p.ID = pm_first.post_id
  INNER JOIN wp_postmeta AS pm_last ON p.ID = pm_last.post_id
WHERE p.post_type = 'person'
  AND p.post_status = 'publish'
  AND pm_first.meta_key = 'first_name'
  AND pm_last.meta_key = 'last_name'
ORDER BY pm_last.meta_value, pm_first.meta_value ASC;