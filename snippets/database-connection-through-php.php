$db = mysqli_connect('localhost', 'user', 'password', 'database_name');

$sql = "INSERT INTO database_name (search_terms) VALUES ('".mysqli_real_escape_string($text_list)."')";

if(mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$result = mysqli_query($db, $sql);
if($result === false) {
  die(mysql_error());
}
mysqli_free_result($result);
mysqli_close($db);
