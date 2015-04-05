$sql_column_names = "SELECT COLUMN_NAME
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE table_name = 'course_list'";
$column_names = $wpdb->get_results($sql_column_names, ARRAY_A);
$column_names = Collection::pluck($column_names, 'COLUMN_NAME');
$column_updates = array();
if(Arr::iterable($column_names)) {
  foreach($column_names as $column_name) {
    $column_updates[] = sprintf(
      "%s = CASE %s WHEN '' THEN NULL ELSE %s END",
      $column_name,
      $column_name,
      $column_name
    );
  }
}
$sql_convert_empty_strings_to_null = sprintf(
  "UPDATE course_list
  SET %s",
  implode(', ', $column_updates)
);
$wpdb->query($sql_convert_empty_strings_to_null);
