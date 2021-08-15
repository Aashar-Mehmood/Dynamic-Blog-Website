<?php
include_once("includes/dbConnection.php");
$limit = $_POST["limit"];

$data = mysqli_query(
  $conn,
  "SELECT `Title`, `Description`, `Image_Path`, `Time`, `Name`
  FROM `myblog_tb`
  INNER JOIN `blog_author_tb` 
  ON myblog_tb.Author_Id = blog_author_tb.Id
  ORDER BY myblog_tb.Time DESC
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
