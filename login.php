<?php
session_start();
if (isset($_SESSION['name']) || isset($_SESSION['email'])) {
  echo "<script>alert('You are already logged in')</script>";
  header("Refresh:0.2;url=./index.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/form.css">
</head>

<body>
  <?php
  include_once("includes/header.php")
  ?>
  <main>
    <h1>Enter the login details</h1>
    <form id="loginForm" action="authenticate.php" method="POST">
      <label for="Name">Name : </label>
      <span></span>
      <input type="text" id="userName">
      <label for="Email">Email : </label>
      <span></span>
      <input type="email" id="userEmail">
      <label for="Password">Password : </label>
      <span></span>
      <input type="password" id="pwd">
      <div class="btns">
        <button name="login" id="login">Login</button>
        <a href="#">Forgot Password?</a>
      </div>
      <h2 id="message"></h2>
    </form>
  </main>
  <?php
  include_once("includes/footer.php")
  ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/authenticate.js"></script>
</body>

</html>