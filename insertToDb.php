<?php
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
    $imgPath = "uploads/" . basename($_FILES["img"]["name"]);
    $moved = move_uploaded_file($_FILES["img"]["tmp_name"], $imgPath);
    if (!$moved) {
      backToCreate("An error occured during image upload");
      // echo "An error occured during image upload";
    }
    $inserted = mysqli_query(
      $conn,
      "INSERT INTO `myblog_tb`(`Title`, `Description`, `Image_Path`) VALUES ('$title', '$desc', '$imgPath');"
    );
    if (!$inserted) {
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
