<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("location:../login.php");
    exit();
}

if (!isset($_POST['update'])) {
    echo "<script>alert('Form Not Submitted')</script>";
    header("Refresh:0;url=../manageBlogs.php");
    exit();
}


include_once('../includes/dbConnection.php');
$author_id = $_SESSION['author_id'];
$blog_id = $_POST['blog_id'];

$title = mysqli_real_escape_string($conn, $_POST['title']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$old_image_path = mysqli_real_escape_string($conn, $_POST['old_image_path']);

$query = "UPDATE blog_data SET ";
if (!empty($title)) {
    $query .= "title = '$title',";
}
if (!empty($desc)) {
    $query .= "description = '$desc',";
}


if ($_FILES['image']['error'] == 0) {
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions = array("jpg", "jpeg", "png", "gif", "svg", "webp");

    // Check file size and extension
    if (in_array($file_ext, $extensions) === false) {
        echo "<script>alert('Only Images are allowed.')</script>";
    } elseif ($file_size > 2097152) {
        echo "<script>alert('File size exceeds 2MB.')</script>";
    } else {
        $file_name_new = uniqid('', true) . '.' . $file_ext;
        $file_destination = 'uploads/' . $file_name_new;

        // Unlink the previous file if it exists
        if (file_exists('../' . $old_image_path)) {
            unlink('../' . $old_image_path);
        }

        move_uploaded_file($file_tmp, '../' . $file_destination);
        $query .= "image='$file_destination'";
    }
}

$query = rtrim($query, ',');
$query .= " WHERE id = $blog_id AND author_id = $author_id; ";
$result = mysqli_query($conn, $query);

// check if the query was successful
if (!$result) {
    echo "<script>alert('Failed to update Blog')</script>";
} else {
    echo "<script>alert('Blog Updated Successfully.')</script>";
}

header("Refresh:0;url=./edit.php?id=$blog_id");
