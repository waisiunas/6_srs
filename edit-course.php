<?php
require_once './database/connection.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('location: ./');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
} else {
    header('location: ./show-courses.php');
}

$sql = "SELECT * FROM `courses` WHERE `id` = $id";
$result = $conn->query($sql);
$course = $result->fetch_assoc();

$name = $course['name'];
$duration = $course['duration'];

if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $duration = htmlspecialchars($_POST['duration']);

    if (empty($name)) {
        $error = "Enter course name!";
    } elseif (empty($duration)) {
        $error = "Enter course duration!";
    } else {
        $sql = "UPDATE `courses` SET `name` = '$name', `duration` = '$duration' WHERE `id` = $id";
        if ($conn->query($sql)) {
            $success = "Magic has been spelled!";
        } else {
            $error = "Magic has failed to spell!";
        }
    }
}
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

    <title>Edit Course</title>

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
                            <h3>Edit Course</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-courses.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once './partials/alerts.php' ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?id=<?php echo $id ?>" method="post">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter course name!" value="<?php echo $name ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="duration" class="form-label">Duration</label>
                                            <input type="text" name="duration" id="duration" class="form-control" placeholder="Enter course duration!" value="<?php echo $duration ?>">
                                        </div>

                                        <div>
                                            <input type="submit" name="submit" class="btn btn-primary">
                                        </div>
                                    </form>
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