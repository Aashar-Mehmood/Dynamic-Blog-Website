<header>
  <h2>Blog Website</h2>
  <nav>
    <a href="index.php">Home</a>
    <?php
    if (isset($_SESSION["name"])) {
      echo "<a href='logout.php'>Logout</a>";
      echo "<a href='create.php'>Create Blog</a>";
    } else {
      echo "<a href='login.php'>Login</a>";
      echo "<a href='register.php'>Register</a>";
    }
    ?>
  </nav>
</header>