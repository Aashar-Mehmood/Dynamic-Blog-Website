<?php
session_start();
?>
<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
  <title>Blog Main Page</title>
  <link rel='stylesheet' href='css/display.css'>
</head>

<body>
  <?php
  include_once("includes/header.php");
  include_once("includes/dbConnection.php");
  if (!$conn) {
    echo "Unable to connect to databse!!";
    exit();
  }
  $BlogInfo = mysqli_query(
    $conn,
    "SELECT `Title`, `Description`, `Image_Path`, `Time`, `Name`
    FROM `myblog_tb`
    INNER JOIN `blog_author_tb` 
    ON myblog_tb.Author_Id = blog_author_tb.Id
    ORDER BY myblog_tb.Time DESC
    LIMIT 2;"
  );
  $data2 = mysqli_query(
    $conn,
    "SELECT `Title`, `Description`, `Id` 
    FROM `myblog_tb` LIMIT 6"
  );
  ?>
  <main>
    <h1>Latest Blogs</h1>
    <section id='blog_section'>
      <?php
      while ($row = mysqli_fetch_array($BlogInfo)) {
        echo "<div class='container'>";
        echo "<img src='$row[2]' />";
        echo "<h1> $row[0] </h1>";
        echo "<p> $row[1] </p>";
        echo "<span><strong>Author : </strong></span>";
        echo "<span>$row[4]</span>";
        echo "<br>";
        echo "<br>";
        echo "<span>$row[3]</span>";
        echo "</div>";
      }
      ?>
    </section>
    <aside>
      <h1>Trending Blogs</h1>
      <?php
      while ($row = mysqli_fetch_array($data2)) {
        $shortPara = substr($row[1], 0, strlen($row[1]) / 3) . ' read more';
        echo "<div>";
        echo "<h1> $row[0] </h1>";
        echo "<p> $shortPara </p>";
        echo "<button id = '$row[2]' name = 'btn$row[2]'>Read More</button>";
        echo "</div>";
      }
      ?>
    </aside>
    <div>
      <button id='load_more'>Load More</button>
      <button id='show_less'>Show Less</button>
    </div>

  </main>
  <?php
  include_once("includes/footer.php");
  ?>
  <script src="js/jquery.min.js"></script>
  <script src="js/fetch.js"></script>
  <script src="js/fetchFullBlog.js"></script>
</body>

</html>
