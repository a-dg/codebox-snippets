UPDATE wp_postmeta
SET meta_key = REPLACE(meta_key, '_news_', '_blog_')
WHERE meta_key LIKE '%_news_%';
