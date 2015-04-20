SELECT
  ID,
  SUM(
    ((LENGTH(post_content) - LENGTH(REPLACE(post_content, 'conservation', ''))) / 12)
    + ((LENGTH(post_content) - LENGTH(REPLACE(post_content, 'khakis', ''))) / 6)
  ) AS occurrences
FROM wp_posts
GROUP BY ID
ORDER BY occurrences DESC