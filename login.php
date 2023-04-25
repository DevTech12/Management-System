<?php
$login = false;
$showError = false;
$showWarning = false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'comp/_dbconnect.php';
    $username = $_POST["username"];
    $password = $_POST["password"];
       $sql = "SELECT * FROM `users` WHERE `username` = '$username'";  
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
            $row = mysqli_fetch_assoc($result);
            if (password_verify($password, $row['password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header('location: welcome.php');
            }
            else {
                $showWarning = true;

            }
        }
    else {
        $showError = true;
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>system_name | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require 'comp/_nav.php' ?>
    <?php
    if ($login){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulation !</strong> You are log in now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }
    if ($showError){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops !</strong> You entered wrong details.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($showWarning){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Enter vaild details.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center my-1">Login Here</h1>
        <form class="row" action="login.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
                <div id="emailHelp" class="form-text">Enter your Roll No.</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>