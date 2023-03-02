<?php
include_once("includes/dbConnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = array(
    $_POST['Name'], $_POST['Email'],
    $_POST['Pwd'], $_POST['Pwd2']
  );

  $error = ['false', 'false', 'false', 'false'];
  $emailErr = 'false';
  $emailExist = 'false';
  $nameExist = 'false';
  $pwdErr1 = 'false';
  $pwdErr2 = 'false';
  $submit = false;
  for ($i = 0; $i < sizeof($data); $i++) {
    if (empty($data[$i])) {
      $error[$i] = 'true';
    }
  }

  if (!empty($data[1])) {
    if (!filter_var($data[1], FILTER_VALIDATE_EMAIL)) {
      $emailErr = 'true';
    }
  }
  if (strlen($data[2]) > 1 && strlen($data[2]) <= 5) {
    $pwdErr1 = 'true';
  }

  if (!empty($data[2]) && !empty($data[3])) {
    if ($data[2] !== $data[3]) {
      $pwdErr2 = 'true';
    }
  }

  // Check if the email or name already exists in the database
  $result = mysqli_query($conn, "SELECT * FROM authors WHERE `name` = '$data[0]' OR `email` = '$data[1]';");
  $existingData = mysqli_fetch_assoc($result);
  if ($existingData) {
    if ($existingData['name'] == $data[0]) {
      $nameExist = 'true';
    }
    if ($existingData['email'] == $data[1]) {
      $emailExist = 'true';
    }
  }

  if (
    $error[0] == 'false' && $error[1] == 'false' &&
    $error[2] == 'false' && $error[3] == 'false' &&
    $pwdErr1 == 'false' && $pwdErr2 == 'false' &&
    $emailErr == 'false' && $emailExist == 'false' && $nameExist == 'false'
  ) {
    $query = "INSERT INTO `authors` (`name`, `email`, `password`) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    $prep = mysqli_stmt_prepare($stmt, $query);
    $hashedPwd = password_hash($data[2], PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $data[0], $data[1], $hashedPwd);
    $submit  = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    if (!$submit) {
      echo "<script>alert('An Error occurred while registering')</script>";
    } else {
      $result = mysqli_query($conn, "SELECT * FROM authors WHERE `name` = '$data[0]'AND `email` = '$data[1]';");
      $userData = mysqli_fetch_assoc($result);
      session_start();
      $_SESSION['author_id'] = $userData["id"];
      $_SESSION['name'] = $data[0];
      $_SESSION['email'] = $data[1];
      $_SESSION['is_admin'] = false;

      echo "<script>alert('You Registered Successfully')</script>";
    }
  }
}
?>

<script>
  var submitStatus = "<?php echo $submit ?>";
  var inputs = document.querySelectorAll("input");
  if (submitStatus == "true" || submitStatus == "1") {
    inputs.forEach(element => {
      element.value = " ";
      hideErr(element);
    });
    location.href = "./index.php";

  }
  inputs.forEach(element => {
    hideErr(element);
  });

  var emailErr = "<?php echo $emailErr ?>";
  var errorStr = "<?php
                  for ($i = 0; $i < sizeof($error); $i++) {
                    echo $error[$i] . ' ';
                  }
                  ?>";
  var emailErr = "<?php echo $emailErr ?>";
  var emailExist = "<?php echo $emailExist ?>";
  var nameExist = "<?php echo $nameExist ?>";
  var pwdErr1 = "<?php echo $pwdErr1 ?>";
  var pwdErr2 = "<?php echo $pwdErr2 ?>";
  var errorArr = errorStr.trim().split(' ');




  for (var i = 0; i < inputs.length; i++) {
    if (errorArr[i] == 'true') {
      showErr(inputs[i], "Required *")
    }
  }
  if (nameExist == 'true') {
    showErr(inputs[0], 'Name Already Exist');
  }
  if (emailErr == 'true') {
    showErr(inputs[1], "Invalid Email");
  } else if (nameExist == 'true') {
    showErr(inputs[1], "Email Alreay Exist")
  }
  if (pwdErr1 == 'true') {
    showErr(inputs[2], "Minimum 6 characters");
  }
  if (pwdErr2 == 'true') {
    showErr(inputs[3], "Passwords does not match");
  }


  function showErr(element, text) {
    element.classList.add("error");
    element.previousElementSibling.classList.add("error");
    element.previousElementSibling.textContent = text + '';
  }

  function hideErr(element) {
    element.classList.remove("error");
    element.previousElementSibling.classList.remove("error");
    element.previousElementSibling.textContent = '';
  }
</script>