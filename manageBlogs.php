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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    main{
        min-height: 500px;
        padding:2rem 3.6rem;
    }
</style>

<body>
  <?php include_once("includes/header.php"); ?>
  <main>
    <h2 class="pb-4">
        Welcome <?php echo "$author_name" ?>     
    </h2>

        <?php 
            if(mysqli_num_rows($result)<1){
                echo "<h3>You have not created any blogs yet</h3>";
            }
            else{
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
                <tbody>'; ?>
                <?php
                while ($rows = mysqli_fetch_assoc($result)) {
                   echo '<tr>
                   <td>'.$rows["id"].'</td>
                   <td>'.$rows["title"].'</td>
                   <td>'.$rows["date"].'</td>
                   <td><a class="btn btn-primary px-4" href = "./blog/edit.php?id='.$rows["id"].'">Edit<a/> </td>
                   <td><a class = "btn btn-danger"  href = "./blog/delete.php?id='.$rows["id"].'">Delete<a/></td>
                   </tr>'; 
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

</html>
