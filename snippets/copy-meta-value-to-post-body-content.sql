UPDATE wp_posts AS p
  INNER JOIN wp_postmeta AS pm ON p.ID = pm.post_id
SET p.post_content = pm.meta_value
WHERE pm.meta_key = 'work_body'
  AND p.post_status = 'publish';
