<?php
include("includes/dbConnection.php");
$blogId = $_POST["blogId"];

$data = mysqli_query(
  $conn,
  "SELECT `Title`, `Description`, `Image_Path`, `Time`, `Name`
  FROM `myblog_tb`
  INNER JOIN `blog_author_tb` 
  ON myblog_tb.Author_Id = blog_author_tb.Id
  WHERE myblog_tb.Id = '$blogId';"
);
$row = mysqli_fetch_array($data);
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
