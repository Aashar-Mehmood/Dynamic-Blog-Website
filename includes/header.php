<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<header>
  <h2>Blog Website</h2>
  <nav>
    <a id="closeMenu">&times;</a>
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