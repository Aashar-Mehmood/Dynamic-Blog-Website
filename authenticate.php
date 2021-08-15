<?php
include_once("includes/dbConnection.php");
$data = array(
  $_POST['Name'], $_POST['Email'],
  $_POST['Pwd']
);

echo "</br>";
$error = ['false', 'false', 'false'];

$submit = false;
for ($i = 0; $i < sizeof($data); $i++) {
  if (empty($data[$i])) {
    $error[$i] = 'true';
  }
}


if ($error[0] == 'false' && $error[1] == 'false' && $error[2] == 'false') {
  $query = "SELECT * FROM `blog_author_tb` WHERE  `Name` = ? OR `Email` = ?;";
  $stmt = mysqli_stmt_init($conn);
  $prep = mysqli_stmt_prepare($stmt, $query);
  mysqli_stmt_bind_param($stmt, "ss", $data[0], $data[1]);
  $exec  = mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  if (!$result) {
    echo "An error occured" . mysqli_stmt_error($stmt);
  } else {
    $row = mysqli_fetch_array($result);
    $hashedPwd = $row[3];
    $matchPwd = password_verify($data[2], $hashedPwd);
    if (!$matchPwd) {
      echo "Wrong Password";
    } else {
      session_start();
      $_SESSION["name"] = $data[0];
      $_SESSION["email"] = $data[1];
      $submit = true;
    }
  }
  mysqli_stmt_close($stmt);
}

?>

<script>
var submitStatus = "<?php echo $submit ?>";
var inputs = document.querySelectorAll("input");
if (submitStatus == true) {
  inputs.forEach(element => {
    element.value = " ";
    hideErr(element);
  });
  alert("Login Successful");
  window.close("login.php");
  window.open("display.php", "_blank");
}
inputs.forEach(element => {
  hideErr(element);
});

var errorStr = "<?php
                  for ($i = 0; $i < sizeof($error); $i++) {
                    echo $error[$i] . ' ';
                  }
                  ?>";

var errorArr = errorStr.trim().split(' ');
for (var i = 0; i < inputs.length; i++) {
  if (errorArr[i] == 'true') {
    showErr(inputs[i], "Required *")
  }
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
