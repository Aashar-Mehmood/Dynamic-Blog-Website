<?php
$host = "127.0.0.1";
$user = "root";
$pwd = "";
$db = "myblog";

// $host = "sql111.epizy.com";
// $user = "epiz_33718098";
// $pwd = "a1nI2c37Ji0TuO";
// $db = "epiz_33718098_blogging_blaze";

$conn = mysqli_connect($host, $user, $pwd, $db);
if (!$conn) {
  echo "Connection Error : " . mysqli_connect_error();
  exit();
}
