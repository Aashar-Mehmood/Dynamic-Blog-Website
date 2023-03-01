<?php
session_start();
include("includes/dbConnection.php");

$messages = [];
$file_destination = '';
if (empty($_POST['title'])) {
  array_push($messages, array("titleError" => "title is required"));
}
if (empty($_POST['desc'])) {
  array_push($messages, array("descError" => "Description is required"));
}
if (empty($_FILES['img']['name'])) {
  array_push($messages, array("imageError" => "Image is required"));
} else if (!empty($_FILES['img']['name']) && $_FILES['img']['error'] == 0) {

  $file_name = $_FILES['img']['name'];
  $file_size = $_FILES['img']['size'];
  $file_tmp = $_FILES['img']['tmp_name'];
  $file_type = $_FILES['img']['type'];
  $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

  // Valid file extensions
  $extensions = array("jpg", "jpeg", "png", "gif", "svg", "webp");

  // Check file size and extension
  if (in_array($file_ext, $extensions) === false) {
    array_push($messages, array('imageError' => 'Only Images are allowed'));
  } else if ($file_size > 2097152) {
    array_push($messages, array('imageError' => 'File size exceeds 2MB'));
  } else {
    $file_name_new = uniqid('', true) . '.' . $file_ext;
    $file_destination = 'uploads/' . $file_name_new;

    $uploaded = move_uploaded_file($file_tmp, $file_destination);
    if (!$uploaded) {
      array_push($messages, array('imageError' => 'Failed to upload, try using another image'));
    }
  }
}

if (sizeof($messages) > 0) {
  echo json_encode($messages);
  exit();
} else {

  $title = mysqli_real_escape_string($conn, $_POST['title']);
  $desc = mysqli_real_escape_string($conn, $_POST['desc']);
  $image_path = mysqli_real_escape_string($conn, $file_destination);
  $author_id = $_SESSION['author_id'];
  $inserted = mysqli_query(
    $conn,
    "INSERT INTO `blog_data` (`title`, `description`, `image`, `author_id`) VALUES ('$title', '$desc', '$image_path', $author_id);"
  );
  print_r(mysqli_error($conn));
  if (!$inserted) {
    array_push($messages, array("message" => "Unable to Create Blog"));
  } else {
    array_push($messages, array("message" => "Blog Created Successfully"));
  }
  echo json_encode($messages);
}
