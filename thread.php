<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Forum Website</title>
</head>

<body>
     <!-- connection to the database -->
     <?php include 'partial/_dbconnect.php'; ?>
     
    <?php include 'partial/_header.php'; ?>
   
    <?php  
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)){
        $name = $row['thread_title'];
        $desc = $row['thread_description'];
        $thread_user_id = $row['thread_user_id'];

        // Query to user table to find the original poster
        $sql2 = "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by = $row2['user_email'];
    }
    ?>

<?php
  $method = $_SERVER['REQUEST_METHOD'];
  $showAlert = false;
  if ($method == 'POST'){
    // Insert into Comment db
    $comment = $_POST['comment'];
    $comment = str_replace("<", "&lt;", $comment);
    $comment = str_replace(">", "&gt;", $comment);
   
    $sno = $_POST['sno'];
    $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`) VALUES ('$comment', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if ($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your comment is added
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
               </button>
             </div>'; 
    }
  }
  ?>

    <!-- fecth the categories -->
    <div class="container my-3">
        <!-- Added a jumbtron -->
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $name; ?></h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <!-- <p>Please use this forum without any violence</p> -->
            <p><b>Posted by: <?php echo $posted_by; ?></b></p>
        </div>
    </div>
    
    <?php
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
   echo '<div class="container">
        <h1 class="py-3">Post a Comment</h1>
        <form action="'.$_SERVER['REQUEST_URI'].'" method="POST">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your Comment</label>
                <textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
            </div>
            <button type="submit" class="btn btn-success">Post </button>
        </form>
    </div>';
     }
     else {
        echo '<div class="container">
        <h1 class="py-3">Post a Comment</h1>
        <div class="alert alert-warning" role="alert">
        <strong>Error!</strong> You are not logged in. Please Login to comment on the Post. 
        </div>';
     }
    ?>

    


    <div class="container my-4">
        <h2>Discussion</h2>



        <?php  
        $id = $_GET['threadid'];
        $sql = "SELECT * FROM `comments` WHERE thread_id=$id";
        $result = mysqli_query($conn, $sql);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)){
        $noResult = false; 
        $id = $row['comment_id'];
        $content = $row['comment_content'];
        $time = $row['comment_time'];
        $thread_user_id = $row['comment_by'];
        $sql2 = "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $userEmail = $row2['user_email'];
    
        echo '<div class="media my-3">
            <img src="imgs/user.png" width="35px" class="mr-3" alt="...">
            <div class="media-body">
                <p class="font-weight-bold my-0">' . $userEmail . ' - '. $time .' </p>
                <p>'. $content.'</p>
            </div>
        </div>
        <hr>';
     }
     if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
          <h1 class="display-4">No Comments ??</h1>
          <p class="lead"><b>Be the first person to comment on this Question.</b></p>
        </div>
      </div>';
        }
     ?> 
    </div>







    <?php include 'partial/_footer.php'; ?>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>

</html>
