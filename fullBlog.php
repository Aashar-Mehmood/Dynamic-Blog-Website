<?php
include("includes/dbConnection.php");
(int)$blogId = $_POST["blogId"];


$data = mysqli_query(
  $conn,
  "SELECT `title`, `description`, `image`, `date`, `author`
  FROM `blog_data`
  WHERE blog_data.id = $blogId;"
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
