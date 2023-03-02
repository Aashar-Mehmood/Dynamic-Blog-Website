<?php
session_start();
if (!isset($_SESSION["name"])) {
  header("location:login.php");
} else if ($_SESSION['is_admin'] == true) {
  header("location:./admin/dashboard.php");
}
include_once('includes/dbConnection.php');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Create Blog</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
  .h-45 {
    height: 45px;
  }

  form label {
    margin: 0 !important;
  }
</style>

<body>
  <?php include_once("includes/header.php"); ?>

  <main class="bg-success">
    <div class="container py-4">
      <div class="row">
        <div class="col-12 col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h1 style="text-align: center;">
                <?php echo "Welcome " . $_SESSION["name"] ?>
              </h1>
            </div>
            <div class="card-body">
              <form id="create-form" method="POST" enctype="multipart/form-data">
                <div class="mt-4">
                  <label class="form-label">Title *</label>
                  <p class="text-danger my-1" id="titleError"></p>
                  <input class="form-control" type="text" name="title" />
                </div>
                <div class="mt-4">
                  <label class="form-label">Description </label>
                  <p class="text-danger my-1" id="descError"></p>
                  <textarea rows="6" class="form-control" name="desc"></textarea>
                </div>
                <div class="mt-4">
                  <label for="form-label">Banner Image</label>
                  <p class="text-danger my-1" id="imgError"></p>
                  <input class="form-control h-45" type="file" accept="image/*" name="img" />
                </div>


                <div class="mt-4">
                  <input value="Create Blog" type="submit" name="create" class="btn btn-primary py-2" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
  <?php include_once("includes/footer.php") ?>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('create-form');
    const titleError = document.getElementById('titleError');
    const descError = document.getElementById('descError');
    const imgError = document.getElementById('imgError');
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      titleError.innerHTML = '';
      descError.innerHTML = '';
      imgError.innerHTML = '';
      var formData = new FormData(form);
      var xhr = new XMLHttpRequest();
      xhr.open('POST', './insertToDb.php', true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          const messages = JSON.parse(xhr.response);

          messages.forEach(message => {
            if (message.titleError) {
              titleError.innerHTML = message.titleError;
            }
            if (message.descError) {
              descError.innerHTML = message.descError;
            }
            if (message.imageError) {
              imgError.innerHTML = message.imageError;
            }
            if (message.fail) {
              alert(message.fail);
            } else if (message.success) {
              alert(message.success);
              location.href = "./manageBlogs.php";
            }
          });
        }
      };
      xhr.send(formData);
    });
  });
</script>

</html>