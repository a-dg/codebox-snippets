UPDATE wp_posts
SET column_name = REPLACE(column_name, 'find', 'replace')
WHERE post_type = 'post-type';
