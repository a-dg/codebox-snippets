# Detect word boundaries
SELECT post_id
FROM wp_postmeta
WHERE meta_key = 'include_pages'
AND meta_value REGEXP '\b9328\b'

# '[[:<:]]' and '[[:>:]]' are specifically
# beginning-of-word and end-of-word boundaries
AND meta_value NOT REGEXP '[[:<:]]9328[[:>:]]'