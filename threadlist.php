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
    
    <!-- fecth the categories -->
    <?php 
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `category` WHERE category_sno=$id";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)){
      $catname = $row['category_name'];
      $catdesc = $row['category_description'];
      
  }
  ?>

    <?php
  $method = $_SERVER['REQUEST_METHOD'];
  $showAlert = false;
  if ($method == 'POST'){
    // Insert into db
    $th_title = $_POST['title'];
    $th_desc = $_POST['description']; 
    $th_title = str_replace("<", "&lt;", $th_title);
    $th_title = str_replace(">", "&gt;", $th_title);
    $th_desc = str_replace("<", "&lt;", $th_desc);
    $th_desc = str_replace(">", "&gt;", $th_desc);
    $sno = $_POST['sno'];

    $sql = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '$sno', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    $showAlert = true;
    if ($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Success!</strong> Your question has been submitted ! Please wait for community respond .
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
               </button>
             </div>';
    }
  }
  ?>

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4">Welcome to <?php echo $catname; ?> Forum</h1>
            <p class="lead"><?php echo $catdesc; ?></p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>

    <?php
     if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    echo '<div class="container">
        <h1 class="py-3">Start a Discussion</h1>
        <form action="'. $_SERVER['REQUEST_URI'] .'" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <input type="hidden" name="sno" value="'. $_SESSION["sno"] .'">
                <small id="emailHelp" class="form-text text-muted">Please try to keep your title as small as you
                    can.</small>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Explain your Problem</label>
                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>';
     }
     else {
        echo '<div class="container">
        <h1 class="py-3">Start a Discussion</h1>
        <div class="alert alert-warning" role="alert">
        <strong>Error!</strong> You are not logged in. Please Login to comment on the Post. 
        </div>';
     }

    ?>

    


    <div class="container">
        <h1 class="py-3">Browse Question</h1>

        <?php 
  $id = $_GET['catid'];
  $sql = "SELECT * FROM `threads` WHERE thread_cat_id=$id";
  $result = mysqli_query($conn, $sql);
  $noResult = true;
  while ($row = mysqli_fetch_assoc($result)){
      $noResult = false;
      $id = $row['thread_id'];
      $title = $row['thread_title'];
      $desc = $row['thread_description'];
      $time = $row['timestamp'];
      $thread_user_id = $row['thread_user_id'];
      $sql2 = "SELECT user_email FROM `users` WHERE sno ='$thread_user_id'";
      $result2 = mysqli_query($conn, $sql2);
      $row2 = mysqli_fetch_assoc($result2);
     


        echo '<div class="media my-3">
            <img src="imgs/user.png"  width="40px"; class="mr-3" alt="...">
            <div class="media-body"><p class="font-weight-bold my-0"> '.$row2['user_email'].' - '. $time .' </p>
                <h5 class="mt-0"><a href="thread.php?threadid='.$id.'">'. $title .'</a></h5>
                '. $desc . '
            </div>
        </div>
        <hr>';
    }

    // echo var_dump($noResult);
    if($noResult){
    echo '<div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4">No Questions ??</h1>
      <p class="lead"><b>Be the first person to ask the question</b></p>
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