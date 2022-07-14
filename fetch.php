<?php
include_once("includes/dbConnection.php");
$limit = 2;

$data = mysqli_query(
  $conn,
  "SELECT `title`, `description`, `image`, `date`, `author`
  FROM `blog_data`
  ORDER BY blog_data.date DESC
  LIMIT $limit;"
);
while ($row = mysqli_fetch_array($data)) {
  echo "<div class='container'>";
  echo "<img src='$row[2]' />";
  echo "<h1> $row[0] </h1>";
  echo "<p> $row[1] </p>";
  echo "<span><strong>Author : </strong></span>";
  echo "<span>$row[4]</span>";
  echo "<br>";
  echo "<br>";
  echo "<span>$row[3]</span>";
  echo "</div>";
}
