<?php
session_start();

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] == false) {
    header("location:../index.php");
}

include_once('../includes/dbConnection.php');

// Get the current date
$current_date = date("Y-m-d");

// Query to get the total number of users who joined in the last year, last month, and last week
$sql = "SELECT COUNT(*) as total_users,
        SUM(date_joined >= DATE_SUB('$current_date', INTERVAL 1 YEAR)) as last_year_users,
        SUM(date_joined >= DATE_SUB('$current_date', INTERVAL 1 MONTH)) as last_month_users,
        SUM(date_joined >= DATE_SUB('$current_date', INTERVAL 1 WEEK)) as last_week_users
        FROM authors WHERE role != 'admin'";

// Execute query
$result = mysqli_query($conn, $sql);

// Check for errors
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Get the total number of users who joined in the last year, last month, and last week
$row = mysqli_fetch_assoc($result);
$total_users = $row['total_users'];
$last_year_users = $row['last_year_users'];
$last_month_users = $row['last_month_users'];
$last_week_users = $row['last_week_users'];

$sql2 = "SELECT MONTH(date_joined) AS month_joined, 
        COUNT(*) AS num_users FROM authors 
        WHERE role != 'admin' AND 
        YEAR(date_joined) = YEAR(DATE_SUB(NOW(), INTERVAL 1 YEAR)) 
        GROUP BY MONTH(date_joined)";
$res = mysqli_query($conn, $sql2);

// Save the results in an array
$users_joined = array();
while ($row2 = mysqli_fetch_assoc($res)) {
    array_push($users_joined, $row2['num_users']);
}

$users_joined_json = json_encode($users_joined);

// Output users joined as json, to be used in the chart
echo "<script>var usersJoined = $users_joined_json;</script>";

$blogSql = "SELECT COUNT(*) as total_blogs, 
            SUM(date_created >= DATE_SUB('$current_date', INTERVAL 1 YEAR)) AS last_year_blogs,
            SUM(date_created >= DATE_SUB('$current_date', INTERVAL 1 MONTH)) AS last_month_blogs,
            SUM(date_created >= DATE_SUB('$current_date', INTERVAL 1 WEEK)) AS last_week_blogs
            FROM blog_data;";

$blogResult = mysqli_query($conn, $blogSql);
$blogRow = mysqli_fetch_assoc($blogResult);
$total_blogs = $blogRow['total_blogs'];
$last_year_blogs = $blogRow['last_year_blogs'];
$last_month_blogs = $blogRow['last_month_blogs'];
$last_week_blogs = $blogRow['last_week_blogs'];

$last_year_blogs_result = mysqli_query(
    $conn,
    "SELECT MONTH(`date_created`) AS month, 
    COUNT(*) AS num_blogs
    FROM blog_data
    WHERE YEAR(`date_created`) = YEAR(DATE_SUB(now(), INTERVAL 1 YEAR))
    GROUP BY MONTH(`date_created`)
    ORDER BY month;"
);


$blogs_arr = array();
while ($last_year_blogs_row = mysqli_fetch_assoc($last_year_blogs_result)) {
    array_push($blogs_arr, $last_year_blogs_row["num_blogs"]);
}

$blogs_created_json = json_encode($blogs_arr);

echo "<script>var blogsCreated = $blogs_created_json;</script>";


// Close connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="../">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        #userStatsChart,
        #blogsStatsChart {
            background-color: aliceblue;
            padding: 1rem 1.4rem;
        }

        #blogsStatsChart {
            background-color: lightyellow;
        }

        @media (min-width:992px) {

            #userStatsChart,
            #blogsStatsChart {
                height: 100% !important;
            }
        }
    </style>
</head>

<body>
    <?php include_once("../includes/header.php"); ?>
    <main>
        <div class="container pb-4">
            <h2 class="mt-4 mb-2">
                Users Stats
            </h2>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-primary mb-4">
                                <div class="card-header">Users</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $total_users ?>
                                    </h5>
                                    <p class="card-text">
                                        Total signed-up Users
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-secondary mb-4">
                                <div class="card-header">Users</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_year_users ?>
                                    </h5>
                                    <p class="card-text">

                                        <?php
                                        echo $last_year_users > 1 ? "Users"  : "User";
                                        echo " signed-up last year";
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-success mb-4">
                                <div class="card-header">Users</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_month_users ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php
                                        echo $last_month_users > 1 ? "Users"  : "User";
                                        echo " signed-up last month";
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-danger mb-4">
                                <div class="card-header">Header</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_week_users ?>

                                    </h5>
                                    <p class="card-text">
                                        <?php
                                        echo $last_week_users > 1 ? "Users"  : "User";
                                        echo " signed-up last week";
                                        ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="d-flex flex-column h-100">
                        <div class="col-10">
                            <h2>Users Joined Last Year</h2>
                        </div>
                        <div class="col-12">
                            <canvas id="userStatsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <h2 class="mt-4 mb-2"> Blogs Stats</h2>
            <div class="row">
                <div class="col-12 col-lg-7">
                    <div class="row">
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-warning mb-4">
                                <div class="card-header">Blogs</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $total_blogs ?>
                                    </h5>
                                    <p class="card-text">
                                        Total Blogs
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-info mb-4">
                                <div class="card-header">Blogs</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_year_blogs ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $last_year_blogs > 1 ? "Blogs" : "Blog";
                                        echo " created last year";
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-dark mb-4">
                                <div class="card-header">Blogs</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_month_blogs ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $last_month_blogs > 1 ? "Blogs" : "Blog";
                                        echo " created last month";
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 ">
                            <div class="card text-bg-light mb-4">
                                <div class="card-header">Blogs</div>
                                <div class="card-body py-4">
                                    <h5 class="card-title">
                                        <?php echo $last_week_blogs ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $last_week_blogs > 1 ? "Blogs" : "Blog";
                                        echo " created last week";
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5">
                    <div class="d-flex flex-column h-100">
                        <div class="col-10">
                            <h2>Blogs Created Last Year</h2>
                        </div>
                        <div class="col-12 mt-4">
                            <canvas id="blogsStatsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once("../includes/footer.php"); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var userData = usersJoined.map(elem => Number(elem));
    // Get the canvas element
    var ctx = document.getElementById('userStatsChart').getContext('2d');
    // Define the chart data
    var chartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Users Signed Up',
            data: userData,
            backgroundColor: 'lightgreen',
            borderColor: 'green',
            borderWidth: 1
        }],


    };

    // Create the chart
    var myChart = new Chart(ctx, {
        type: 'line',
        data: chartData,
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true
                    },
                    min: 0
                }
            }
        }
    });

    var blogsData = blogsCreated.map(ele => Number(ele));
    var ctx2 = document.getElementById('blogsStatsChart').getContext('2d');
    var chartData2 = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Blogs Created',
            data: blogsData,
            backgroundColor: 'aliceblue',
            borderColor: 'blue',
            borderWidth: 1
        }],


    };
    var myChart2 = new Chart(ctx2, {
        type: 'line',
        data: chartData2,
        options: {
            scales: {
                y: {
                    ticks: {
                        beginAtZero: true
                    },
                    min: 0
                }
            }
        }
    });
</script>

</html>