<?php
session_start();
unset($_SESSION['author_id']);
unset($_SESSION["name"]);
unset($_SESSION["email"]);
unset($_SESSION['is_admin']);
header("location:index.php");
