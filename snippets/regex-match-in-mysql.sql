# Detect word boundaries
# '[[:<:]]' and '[[:>:]]' are specifically
# beginning-of-word and end-of-word boundaries
SELECT post_id
FROM wp_postmeta
WHERE meta_key = 'include_pages'
AND meta_value REGEXP '[[:<:]]9328[[:>:]]'
OR meta_value NOT REGEXP '[[:<:]]9328[[:>:]]'