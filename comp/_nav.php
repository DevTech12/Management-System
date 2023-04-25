<?php
echo'<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/StudentMS/login.php">system_name</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="welcome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="comp/_about.php">About</a>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success mx-1" type="submit">Search</button>
            </form>';
            

            if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
              echo'<form class="d-flex mx-2">
                      <div class="btn-group dropstart">
                        <button type="button" class="btn btn-success dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Options
                        </button>
                        <ul class="dropdown-menu">    
                          <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                          <li><a class="dropdown-item" href="logout.php">Log Out</a></li></ul>
                      </div>
                   </form>';
            }
            else {
              echo'<a class="btn btn-success mx-1" href="login.php" type="submit">Login</a>
              <a class="btn btn-success mx-1" href="signup.php" type="submit">Sign Up</a>';
            };
        echo'</div>
    </div>
</nav>';

?>
