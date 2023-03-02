<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("location:../login.php");
}else if ($_SESSION['is_admin'] == true) {
    header("location:../admin/dashboard.php");
}
include_once('../includes/dbConnection.php');
$author_id = $_SESSION['author_id'];
$blog_id = $_POST['blog_id'];

$deleted = mysqli_query($conn, "DELETE FROM blog_data WHERE id = $blog_id AND author_id = $author_id");
if (!$deleted) {
    echo "Access Denied ";
} else {
    echo "Deleted Successfully";
}
