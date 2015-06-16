SELECT AVG(posts_each_month)
FROM (
  SELECT
    COUNT(*) AS posts_each_month,
    FROM_UNIXTIME(p.post_date, '%Y-%m') AS published_on
  FROM wp_posts AS p
  WHERE p.post_date >= UNIX_TIMESTAMP('2014-02-01 00:00:00')
  GROUP BY published_on
  ORDER BY published_on
) AS result
