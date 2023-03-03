<?php
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == false) {
    header("../index.php");
} else if (!isset($_POST['author_id'])) {
    header("./users.php");
}
include_once('../includes/dbConnection.php');
$author_id = $_POST['author_id'];
$deleted = mysqli_query($conn, "DELETE FROM authors WHERE id = $author_id");
if (!$deleted) {
    echo "<script>alert('Failed to delete user')</script>";
} else {
    echo "<script>alert('User deleted Successfully')</script>";
}
header("Refresh:0.2;url=./users.php");
