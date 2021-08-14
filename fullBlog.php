<?php
include("includes/dbConnection.php");
$blogId = $_POST["blogId"];

$data = mysqli_query($conn, "SELECT * FROM `myblog_tb` WHERE `Id` = $blogId ");
$row = mysqli_fetch_array($data);
echo "<div class='container'>";
echo "<img src='$row[2]' />";
echo "<h1> $row[0] </h1>";
echo "<p> $row[1] </p>";
echo "</div>";
