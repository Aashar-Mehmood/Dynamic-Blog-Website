<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("location:login.php");
    exit();
}

include_once("./includes/dbConnection.php");

$author_id = $_SESSION['author_id'];
$author_name = $_SESSION['name'];
$query = "SELECT * FROM blog_data WHERE author_id = $author_id";
$result = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Your Blogs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<style>
    main {
        min-height: 500px;
        padding: 2rem 3.6rem;
    }
</style>

<body>
    <?php include_once("includes/header.php"); ?>
    <main>
        <h2 class="pb-4">
            Welcome <?php echo "$author_name" ?>
        </h2>

        <?php
        if (mysqli_num_rows($result) < 1) {
            echo "<h3>You have not created any blogs yet</h3>";
        } else {

            echo
            '<table class="table mt-4">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>';

        ?>
            <?php
            while ($rows = mysqli_fetch_assoc($result)) {

                echo '
                <tr>
                   <td>' . $rows["id"] . '</td>
                   <td>' . $rows["title"] . '</td>
                   <td>' . $rows["date"] . '</td>
                   <td><a class="btn btn-primary px-4" href = "./blog/edit.php?id=' . $rows["id"] . '">Edit<a/> </td>
                   <td>
                   <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal' . $rows["id"] . '">
                        Delete
                    </button>
                    </td>
                </tr>';
                echo '
                <!-- Modal -->
                <div class="modal" id="modal' . $rows["id"] . '" tabindex="-1" role="dialog"  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" >Delete Blog!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Are you sure you want to delete the blog (' . $rows["title"] . ')?
                        This process can not be un-done!
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <form method="POST" class="deleteForm">
                            <input type="submit" class="btn btn-danger" value = "Delete"/>
                            <input type="hidden" name="blog_id" value="' . $rows["id"] . '"/>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>';
            }

            ?>
        <?php echo '
                </tbody>
                </table>
                ';
        }
        ?>
    </main>
    <?php include_once("includes/footer.php") ?>
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var form = document.querySelector('.deleteForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'blog/delete.php', true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    const message = xhr.responseText;
                    alert(message);
                    location.reload();
                }
            };
            xhr.send(formData);
        });
    });
</script>

</html>