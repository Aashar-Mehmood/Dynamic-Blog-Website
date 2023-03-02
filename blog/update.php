<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("location:../login.php");
} else if ($_SESSION['is_admin'] == true) {
    header("location:../admin/dashboard.php");
}



include_once('../includes/dbConnection.php');
$author_id = $_SESSION['author_id'];
$blog_id = $_POST['blog_id'];

$title = mysqli_real_escape_string($conn, $_POST['title']);
$desc = mysqli_real_escape_string($conn, $_POST['desc']);
$old_image_path = mysqli_real_escape_string($conn, $_POST['old_image_path']);
$messages = [];


if (empty($title) && empty($desc) && empty($_FILES['image']['name'])) {
    array_push($messages, array("update" => "fill atleast one field to update blog"));
} else {

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
            array_push($messages, array('imageError' => 'Only Images are allowed'));
        } elseif ($file_size > 2097152) {
            array_push($messages, array('imageError' => 'File size exceeds 2MB'));
        } else {
            $file_name_new = uniqid('', true) . '.' . $file_ext;
            $file_destination = 'uploads/' . $file_name_new;

            $uploaded = move_uploaded_file($file_tmp, '../' . $file_destination);
            if ($uploaded) {
                // Unlink the previous file if it exists
                if (file_exists('../' . $old_image_path)) {
                    unlink('../' . $old_image_path);
                }
                $query .= "image='$file_destination'";
                array_push($messages, array('newImagePath' => "$file_destination"));
            }
        }
    }

    $query = rtrim($query, ',');
    $query .= " WHERE id = $blog_id AND author_id = $author_id; ";
    $result = mysqli_query($conn, $query);

    // check if the query was successful
    if (!$result) {
        array_push($messages, array('update' => 'Failed to update Blog'));
    } else {
        array_push($messages, array('update' => 'Blog Updated Successfully'));
    }
}
echo json_encode($messages);
