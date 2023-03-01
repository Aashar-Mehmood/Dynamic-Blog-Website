<?php
include("includes/dbConnection.php");
(int)$blogId = $_POST["blogId"];


$data = mysqli_query(
  $conn,
  "SELECT `title`, `description`, `image`, `date`, `author_id`
  FROM `blog_data`
  WHERE blog_data.id = $blogId;"
);
$row = mysqli_fetch_assoc($data);
$title = $row['title'];
$desc = $row['description'];
$image = $row["image"];
$date = $row['date'];
$author_id = $row['author_id'];
$author_data = mysqli_query($conn, "SELECT `name` FROM authors WHERE id = $author_id");
$author_name = mysqli_fetch_assoc($author_data)["name"];

echo "<div class='cont'>";
echo "<img src='$image' />";
echo "<h1> $title </h1>";
echo "<p> $desc </p>";
echo "<span><strong>Author : </strong></span>";
echo "<span>$author_name</span>";
echo "<br>";
echo "<br>";
echo "<span>$date</span>";
echo "</div>";
