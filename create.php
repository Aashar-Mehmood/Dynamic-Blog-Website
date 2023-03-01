<?php
session_start();
if (!isset($_SESSION["name"])) {
  header("location:login.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Blog</title>
  <link rel="stylesheet" href="css/create.css" />
</head>

<body>
  <?php include_once("includes/header.php"); ?>

  <main>
    <h1 style="text-align: center;">
      <?php echo "Welcome " . $_SESSION["name"] ?>
    </h1>
    <form action="./insertToDb.php" method="POST" enctype="multipart/form-data">
      <div>
        <label>Enter the Title of Blog *</label>
        <input type="text" name="title" />
      </div>
      <div>
        <label>Enter the description *</label>
        <textarea name="desc"></textarea>
      </div>
      <input type="file" name="img" />
      <button name="create">Create Blog</button>
    </form>
  </main>
  <?php include_once("includes/footer.php") ?>
</body>

</html>
