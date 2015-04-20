SET @keyword = 'conservat* khaki*';

SELECT
  post_title,
  post_content,
  post_name,
  (10 * (MATCH(post_title) AGAINST (@keyword IN BOOLEAN MODE))) +
  (2 * (MATCH(post_content) AGAINST (@keyword IN BOOLEAN MODE))) +
  (1 * (MATCH(post_name) AGAINST (@keyword IN BOOLEAN MODE))) AS score
FROM wp_posts
WHERE MATCH(post_title, post_content, post_name) AGAINST (@keyword IN BOOLEAN MODE)
GROUP BY post_title
HAVING score > 0
ORDER BY score DESC
