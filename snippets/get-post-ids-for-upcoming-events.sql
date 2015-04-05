# Get posts of type 'event' that start in the future

SELECT p.ID
FROM wp_posts AS p
  INNER JOIN wp_postmeta AS pm ON pm.post_id = p.ID
WHERE p.post_type = 'event'
  AND p.post_status = 'publish'
  AND pm.meta_key = 'event_date_start'
  AND STR_TO_DATE(pm.meta_value, '%Y/%m/%d') > NOW()
ORDER BY STR_TO_DATE(pm.meta_value, '%Y/%m/%d') DESC;
