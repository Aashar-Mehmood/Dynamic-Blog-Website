<?php
session_start();
unset($_SESSION["name"]);
unset($_SESSION["email"]);
header("location:index.php");
