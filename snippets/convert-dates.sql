# Convert month names to numbers
UPDATE reports
SET month_number = DATE_FORMAT(STR_TO_DATE(month_name, '%M'), '%m');

# Assemble post date from month and year
UPDATE white_papers
SET post_date = CONCAT(year_published, '-', DATE_FORMAT(STR_TO_DATE(month_published, '%M'), '%m'), '-01 00:00:00');

# Convert start date and copy to post date
UPDATE events
SET post_date = CONCAT(STR_TO_DATE(start_date, '%c/%e/%y'), '-01 00:00:00');