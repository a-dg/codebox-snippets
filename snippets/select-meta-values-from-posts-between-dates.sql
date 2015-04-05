SELECT DISTINCT
  pm_email.meta_value AS email
FROM wp_posts AS p
  INNER JOIN wp_postmeta AS pm_email ON p.ID = pm_email.post_id
WHERE p.post_type = 'subscriber'
  AND p.post_status = 'publish'
  AND p.post_date BETWEEN '2013-04-16' AND '2013-04-23'
  AND pm_email.meta_key = 'email'
ORDER BY p.ID;
