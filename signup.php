<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'comp/_dbconnect.php';
    $name = $_POST["uname"];
    $mobno = $_POST["mobno"];
    $dob = $_POST["dob"];
    $branch = $_POST["branch"];
    $syear = $_POST["syear"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $cPassword = $_POST["cPassword"];
    $exist = false;

    $existSql = "SELECT * FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($conn, $existSql);
    $existRow = mysqli_num_rows($result);
        if ($existRow > 0){
            // $exists = true;
            $exist = true;
        }
        else{
            // $exists = false;
            if ($password == $cPassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`name`, `mobileNo`, `dob`, `branch`, `study_year`, `username`, `password`, `create_time`) VALUES ('$name', '$mobno', '$dob', '$branch', '$syear', '$username', '$hash', current_timestamp())";  
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                }
            }
            else {
                $showError = true;
            }
  }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>system_name | Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <?php require 'comp/_nav.php' ?>
    <?php
    if ($showAlert){
    echo'<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Your account is created. You can Login now.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if ($showError){
        echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Oops !</strong> You entered wrong password. Please check your password.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    }

    if ($exist){
        echo'<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Warning !</strong> You are already a student.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    ?>

    <div class="container my-4">
        <h1 class="text-center my-1">Sign Up Here</h1>
        <form class="row" action="signup.php" method="post">
            <div class="col-md-6">
                <label for="uname" class="form-label">Name</label>
                <input type="text" class="form-control" id="uname" name="uname" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter your full name with first letter capital.</div>
            </div>
            <div class="col-md-6">
                <label for="mobno" class="form-label">Mobile No.</label>
                <input type="text" class="form-control" id="mobno" name="mobno" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <div class="col-md-6">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" aria-describedby="emailHelp">
                <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
            </div>
            <!-- <div class="col-md-6">
                <label for="branch" class="form-label">Branch</label>
                <input type="text" class="form-control" id="branch" name="branch" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Comp/Mech/IT/ENTC/CIVIL</div>
            </div> -->
            <div class="col-md-6">
                <label class="form-label" for="branch">Branch</label>
                <select class="form-select" id="branch" name="branch">
                    <option selected>Choose...</option>
                    <option value="Computer">Computer</option>
                    <option value="IT">IT</option>
                    <option value="Mechanical">Mechanical</option>
                    <option value="Civil">Civil</option>
                    <option value="ENTC">ENTC</option>
                </select>
            </div>
            <!-- <div class="col-md-6">
                <label for="syear" class="form-label">Study Year</label>
                <input type="email" class="form-control" id="syear" name="syear" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">FE/SE/TE/BE</div>
            </div> -->
            <div class="col-md-6">
                <label class="form-label" for="syear">Study Year</label>
                <select class="form-select" id="syear" name="syear">
                    <option selected>Choose...</option>
                    <option value="FE">FE</option>
                    <option value="SE">SE</option>
                    <option value="TE">TE</option>
                    <option value="BE">BE</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">UserName</label>
                <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Enter your Roll No.</div>
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="cPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cPassword" name="cPassword">
                <div id="emailHelp" class="form-text">Please enter same password</div>
            </div>
            <div class="col-12">
                <button class="btn btn-primary" type="submit">Sign Up</button>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>