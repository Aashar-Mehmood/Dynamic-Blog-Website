<?php
session_start();
include("includes/dbConnection.php");
if (
  isset($_POST["title"])
  && isset($_POST["desc"])
  && isset($_FILES["img"])
) {
  if (!$conn) {
    backToCreate("Unable to connect to the database");
  } else {
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    $authorName = $_SESSION["name"];
    $authorInfo = mysqli_query(
      $conn,
      "SELECT `Id` FROM `blog_author_tb` 
      WHERE `Name` = '$authorName'
      LIMIT 1; "
    );
    $authorId = mysqli_fetch_array($authorInfo)[0];
    $name = basename($_FILES["img"]["name"]);
    $imgPath = "uploads/" . $name;
    $moved = move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath);
    if (!$moved) {
      backToCreate("An error occured during image upload");
      exit();
    }
    $inserted = mysqli_query(
      $conn,
      "INSERT INTO `myblog_tb` (`Title`, `Description`, `Image_Path`, `Author_Id`) VALUES ('$title', '$desc', '$imgPath', '$authorId');"
    );
    if (!$inserted) {
      // echo "Error" . mysqli_error($conn);
      backToCreate("Unable to insert into database");
    } else {
      mysqli_close($conn);
      backToCreate("Data inserted in the database");
    }
  }
} else {
  backToCreate("Fill in all the fields");
}

function backToCreate($msg)
{
  echo "<script>alert('$msg');</script>";
  header("refresh:0.6; url=./create.php");
  exit(0);
}
