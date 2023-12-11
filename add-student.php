<?php
require_once './database/connection.php';

session_start();
if (!isset($_SESSION['user'])) {
    header('location: ./');
}

$name = $reg_no = "";
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $reg_no = htmlspecialchars($_POST['reg_no']);

    if (empty($name)) {
        $error = "Enter student name!";
    } elseif (empty($reg_no)) {
        $error = "Enter student reg_no!";
    } else {
        $sql = "SELECT * FROM `students` WHERE `reg_no` = '$reg_no'";
        $result = $conn->query($sql);
        if ($result->num_rows === 0) {
            $sql = "INSERT INTO `students`(`name`, `reg_no`) VALUES ('$name', '$reg_no')";
            if ($conn->query($sql)) {
                $success = "Magic has been spelled!";
                $name = $reg_no = "";
            } else {
                $error = "Magic has failed to spell!";
            }
        } else {
            $error = "Reg no already exists!";
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

    <title>Add Student</title>

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
                            <h3>Add Student</h3>
                        </div>
                        <div class="col-6 text-end">
                            <a href="./show-students.php" class="btn btn-outline-primary">Back</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php require_once './partials/alerts.php' ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter student name!" value="<?php echo $name ?>">
                                        </div>

                                        <div class="mb-3">
                                            <label for="reg_no" class="form-label">Reg. No.</label>
                                            <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Enter student reg no!" value="<?php echo $reg_no ?>">
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