SET @domain = '//domain.com';

UPDATE wp_posts
SET post_content = REPLACE(post_content, CONCAT(@domain, '/wp-content/uploads'), '/wp-content/uploads')
WHERE post_content LIKE CONCAT('%', @domain ,'/wp-content/uploads%')
  AND post_status = 'publish';
