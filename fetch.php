<?php
include_once("includes/dbConnection.php");
$limit = $_POST["limit"];

$data = mysqli_query($conn, "SELECT * FROM `myblog_tb` LIMIT $limit");
while ($row = mysqli_fetch_array($data)) {
  echo "<div class='container'>";
  echo "<img src='$row[2]' />";
  echo "<h1> $row[0] </h1>";
  echo "<p> $row[1] </p>";
  echo "</div>";
}
