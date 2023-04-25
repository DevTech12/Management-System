<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
  header('location: login.php');
  exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>system_name | Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body>
    
    <?php require 'comp/_nav.php' ?>
      <h3 class="text-center my-3">Welcome - <?php echo $_SESSION['username'] ?></h3>
      <div class="container">
        <div class="row">
            <div class="card border-primary my-3 me-4" style="max-width: 69rem;">
                <div class="card-body text-dark">
                    <h3 class="card-title text-center">About Sinhagad Academy of Engineering</h3>
                    <p class="card-text text-center">A leading educational institute in the field of Computer Science Engineering,
                        Electronics Engineering, Mechanical Engineering, Information Technology, Civil Engineering,
                        Automobile Engineering, Computer Science Engineering, Electronics Engineering, Mechanical
                        Engineering, VLSI Design and Engineering, SAE - Sinhgad Academy of Engineering offers B.E. /
                        B.Tech course. It was established in 2005 in the city of Maharashtra to provide education and
                        skills through a curriculum focused on Engineering and Computer Science Engineering, Electronics
                        Engineering, Mechanical Engineering, Information Technology, Civil Engineering, Automobile
                        Engineering, Computer Science Engineering, Electronics Engineering, Mechanical Engineering, VLSI
                        Design. Through well-designed full-time diploma course, the institute aims to equip students
                        with skills to excel in the field of Computer Science Engineering, Electronics Engineering,
                        Mechanical Engineering, Information Technology, Civil Engineering, Automobile Engineering,
                        Computer Science Engineering, Electronics Engineering, Mechanical Engineering, VLSI Design and
                        Engineering. The Institute offers 8 UG and 5 PG Degree courses. It has a faculty who have
                        expertise and experience in their respective fields. Alongwith a strong focus on research and
                        development, the dissemination of teaching and training allows students to remain ahead of
                        competition through latest insights on the industry. The courses offerred are in the fee range
                        of INR 190,000-388,000. It offers courses in B.E. / B.Tech and M.E./M.Tech.</p>
                </div>
            </div>
         </div>
      </div>
      

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>