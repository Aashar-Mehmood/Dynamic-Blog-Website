<?php
session_start();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Aashar's Blog</title>
  <link rel='stylesheet' href='css/display.css'>
</head>

<body>
  <?php
  include_once("includes/header.php");
  include_once("includes/dbConnection.php");

  $blogInfo = mysqli_query(
    $conn,
    "SELECT `title`, `description`, `image`, `date`, `author`
    FROM `blog_data`
    ORDER BY blog_data.date DESC
    LIMIT 2;"
  );
  $data2 = mysqli_query(
    $conn,
    "SELECT `title`, `description`, `id` 
    FROM `blog_data` LIMIT 6"
  );

  ?>
  <main>

    <section id='blog_section'>
      <?php
      if (mysqli_num_rows($blogInfo) < 1) {
        echo "<h1>No Blogs Published Yet</h1>";
        echo "<p>Login or register to create blogs</p>";
        echo "</section>";
        echo "</main>";
      } else {
        echo "<h1>Latest Blogs</h1>";
        while ($row = mysqli_fetch_assoc($blogInfo)) {
          $title = $row['title'];
          $desc = $row['description'];
          $author = $row['author'];
          $date = $row['date'];
          $image = $row["image"];
          echo "<div class='container'>";
          echo "<img src='$image' />";
          echo "<h1> $title </h1>";
          echo "<p> $desc </p>";
          echo "<span><strong>Author : </strong></span>";
          echo "<span>$author</span>";
          echo "<br>";
          echo "<br>";
          echo "<span>$date</span>";
          echo "</div>";
        }
        echo "</section>";
        echo "<aside>";
        echo "<h1>Trending Blogs</h1>";
        while ($row = mysqli_fetch_array($data2)) {
          $shortPara = substr($row[1], 0, strlen($row[1]) / 3) . ' read more';
          echo "<div>";
          echo "<h1> $row[0] </h1>";
          echo "<p> $shortPara </p>";
          echo "<button id = '$row[2]' name = 'btn$row[2]'>Read More</button>";
          echo "</div>";
        }
        echo "
    </aside>
    <div>
      <button id='load_more'>Load More</button>
      <button id='show_less'>Show Less</button>
    </div>
  </main>";
      }


      include_once("includes/footer.php");
      ?>
      <script src="js/jquery.min.js"></script>
      <script src="js/fetch.js"></script>
      <script src="js/fetchFullBlog.js"></script>
</body>

</html>