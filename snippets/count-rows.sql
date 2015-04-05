# Count all
SELECT COUNT(1) AS count_total
FROM burritos
WHERE unit = 'burrito';

# Count per unique value
SELECT email, COUNT(1) AS count_each
FROM burritos
WHERE unit = 'burrito'
GROUP BY email
ORDER BY count_each DESC;
