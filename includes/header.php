<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/headerAndFooter.css">
</head>
<header>
  <img src="./assets/images/bloggingBlaze1.png" alt="Blogging Blaze" />
  <nav>
    <a id="closeMenu">&times;</a>
    <a href="index.php">Home</a>
    <?php
    if (isset($_SESSION["is_admin"])) {
      if ($_SESSION["is_admin"] == true) {

        echo "<a href='admin/dashboard.php'>Dashboard</a>";
        echo "<a href='admin/blogs.php'>Blogs</a>";
        echo "<a href='admin/users.php'>Users</a>";
      } else if ($_SESSION["is_admin"] == false) {
        echo "<a href='create.php'>Create</a>";
        echo "<a href='manageBlogs.php'>Manage</a>";
      }
      echo "<a href='logout.php'>Logout</a>";
    } else {
      echo "<a href='login.php'>Login</a>";
      echo "<a href='register.php'>Register</a>";
    }

    ?>
  </nav>
  <i class="fa fa-bars" id="openMenu"></i>
</header>

<script>
  const closeMenu = document.getElementById("closeMenu");
  const openMenu = document.getElementById("openMenu");
  const menu = document.querySelector("header nav");
  openMenu.addEventListener("click", () => {
    menu.classList.add('visible');
  });
  closeMenu.addEventListener("click", () => {
    menu.classList.remove('visible');
  });
</script>