SELECT pm.*
FROM wp_postmeta AS pm
  INNER JOIN wp_posts AS p ON p.ID = pm.post_id
WHERE p.post_type = 'event';
