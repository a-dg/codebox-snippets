# Can also use [IS NULL] instead of [= '']
ORDER BY
  CASE WHEN pm_weight.meta_value = '' THEN 1 ELSE 0 END,
  pm_weight.meta_value ASC
