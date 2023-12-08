<?php
require_once './database/connection.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('location: ./');
}

$sql = "SELECT * FROM `courses`";
$result = $conn->query($sql);
$courses = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="./assets/img/icons/icon-48x48.png" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/pages-blank.html" />

    <title>Courses</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link href="./assets/css/app.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <?php require_once './partials/sidebar.php' ?>

        <div class="main">
            <?php require_once './partials/topbar.php' ?>

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="row mb-2">
                        <div class="col-6">
                            <h3>Courses</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./add-course.php" class="btn btn-outline-primary">Add Course</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                    if($result->num_rows > 0) { ?>
                                        <table class="table table-bordered m-0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No.</th>
                                                    <th>Name</th>
                                                    <th>Duration</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $sr = 1;
                                                foreach($courses as $course) { ?>
                                                <tr>
                                                    <td><?php echo $sr++ ?></td>
                                                    <td><?php echo $course['name'] ?></td>
                                                    <td><?php echo $course['duration'] ?></td>
                                                    <td>
                                                        <a href="./edit-course.php?id=<?php echo $course['id'] ?>" class="btn btn-primary">Edit</a>
                                                        <a href="./delete-course.php?id=<?php echo $course['id'] ?>" class="btn btn-danger">Delete</a>
                                                        </td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php    
                                    } else { ?>
                                        <div class="alert alert-info m-0">No record found!</div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php require_once './partials/footer.php' ?>
        </div>
    </div>

    <script src="./assets/js/app.js"></script>

</body>

</html>