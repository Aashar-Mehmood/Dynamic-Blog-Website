<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Register</title>
  <link rel='stylesheet' href='css/form.css'>
</head>

<body>
  <?php
  include_once("includes/header.php");
  ?>
  <main>
    <h1>Enter your data to register</h1>
    <form id="signupForm" class="active" action="validateForm.php" method="POST">
      <label for="Name">Name : </label>
      <span></span>
      <input type="text" name="userName" id="userName">
      <label for="Email">Email : </label>
      <span></span>
      <input type="email" name="email" id="userEmail">
      <label for="Password">Password : </label>
      <span></span>
      <input type="password" name="password" minlength="6" maxlength="10" id="pwd">
      <label for="Re-Enter-Password">Re-Enter Password : </label>
      <span></span>
      <input type="password" name="repeatPassword" id="pwd2">
      <div class="btns">
        <button id="addUser" name="register">Register</button>
        <button id="login" class="secondary" type="button">Or Login</button>
      </div>
      <h2 id="message"></h2>
    </form>
  </main>
  <?php
  include_once("includes/footer.php")
  ?>
</body>
<script src="js/jquery.min.js"></script>
<script src="js/validateForm.js"></script>

</html>
