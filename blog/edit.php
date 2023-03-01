<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("location:../login.php");
    exit();
}
include_once('../includes/dbConnection.php');
$author_id = $_SESSION['author_id'];
$blog_id = $_GET['id'];

$result = mysqli_query($conn, "SELECT * FROM blog_data WHERE id = $blog_id AND author_id = $author_id");
if (mysqli_num_rows($result) < 1) {
    echo "<script>alert('Access Denied !');</script>";
    header("Refresh:1;url=../manageBlogs.php");
    exit();
}

$data = mysqli_fetch_assoc($result);
$title = $data['title'];
$description = $data['description'];
$image = $data['image'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="../">
    <title>Update Blog</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>
<style>
    .prev-image {
        width: 60px;
        cursor: pointer;
    }

    #large-image {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) scale(0);
        width: 400px;
        height: 300px;
        background-color: #00000099;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: transform 0.4s ease-in-out;
    }

    #large-image img {
        width: 100%;
    }

    #large-image.open {
        transform: translate(-50%, -50%) scale(1);

    }

    #close {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: #000;
        color: white;
        font-size: 3em;
        cursor: pointer;
        position: absolute;
        top: 10px;
        right: 40px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-bottom: 10px;
    }
</style>

<body>
    <?php include_once("../includes/header.php"); ?>

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
                            <form id="update-form" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="blog_id" value="<?php echo "$blog_id" ?>">
                                <div class="mt-4">
                                    <label class="form-label">Update title</label>
                                    <input class="form-control" type="text" name="title" value='<?php echo "$title" ?>' />
                                </div>
                                <div class="mt-4">
                                    <label class="form-label">Update description </label>
                                    <textarea rows="6" class="form-control" name="desc"><?php echo "$description" ?></textarea>
                                </div>
                                <div class="mt-4">
                                    <span class="text-danger" id="imageError"></span>
                                    <input class="form-control" type="file" accept="image/*" name="image" />
                                </div>

                                <div class="mt-4 d-flex flex-row justify-content-between col-10">
                                    <h4>Old Image (Click to Enlarge)</h4>
                                    <img class="prev-image" src=<?php echo "$image" ?>>
                                </div>
                                <input type="hidden" name="old_image_path" value="<?php echo "$image" ?>">
                                <div class="py-4">
                                    <input value="Update Blog" type="submit" name="update" class="btn btn-primary py-2" />
                                </div>
                                <div id="large-image" class="large-image">
                                    <h2 id="close">&times;</h2>
                                    <img src=<?php echo "$image" ?>>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php include_once("../includes/footer.php") ?>
</body>
<script>
    const prevImage = document.querySelector('.prev-image');
    const largeImage = document.getElementById('large-image');
    const close = document.getElementById('close');

    const imageError = document.getElementById('imageError');

    prevImage.addEventListener('click', () => {

        largeImage.classList.toggle('open');
    });
    close.addEventListener('click', () => {
        largeImage.classList.remove('open');
    });

    document.addEventListener('DOMContentLoaded', function() {
        var form = document.getElementById('update-form');
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'blog/update.php', true);
            xhr.onload = function() {
                imageError.innerHTML = '';
                if (xhr.status === 200) {

                    const messages = JSON.parse(xhr.response);
                    messages.forEach(message => {
                        if (message.imageError) {
                            imageError.innerHTML = message.imageError;
                        }
                        if (message.newImagePath) {
                            prevImage.setAttribute("src", message.newImagePath);
                            largeImage.children[1].setAttribute("src", message.newImagePath);
                        }
                        if (message.update) {
                            alert(message.update);
                        }
                    });
                }
            };
            xhr.send(formData);
        });
    });
</script>

</html>