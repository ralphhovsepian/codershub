<?php

session_start();

include './Classes/User.class.php';

$user = new User;

User::checkiflogged();

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="assets/style.css">

<title>Codershub</title>
</head>
<body>

<!-- Start Navbar -->
<nav class="navbar navbar-toggleable-sm navbar-inverse bg-primary">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target=".dual-collapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse dual-collapse">
        <ul class="navbar-nav mr-auto">
          <form action="index.php" method="POST">
            <li class="nav-item">

                <input type="text" name="search" id="search" class="form-control" placeholder="Search For Programmers">
            </li>
        </ul>
    </div>
    <a href="index.php" id="navhead" class="navbar-brand d-flex mx-auto" style="color:white !important;" href="#">CODERSHUB</a>

    <div class="navbar-collapse collapse dual-collapse">
        <ul class="navbar-nav ml-auto">

<li class="nav-item">
         <a class="nav-link" href="#"> <i class="fa fa-bell-o" aria-hidden="true"></i></a>
</li>
    <li class="nav-item dropdown">
         <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="./assets/images/default.png" width="30" height="30">
         </a>
         <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
               <a class="nav-link" href="profile.php">Profile</a>
               <a class="nav-link" href="#">Settings</a>
               <a class="nav-link" name="logout" href="logout.php">Logout</a>
         </div>
       </li>

           </form>
        </ul>
    </div>
</nav>
<!-- End Navbar -->



<!-- Post a new status -->
<div id="postastatus" class="jumbotron">
<form action="" method="POST">
<textarea placeholder="Write a new post..." id="post" name="post" class="form-control" rows="5" cols="40" style="resize: none;" required></textarea>
<br>
<input type="submit" class="btn btn-primary btn-block" value="Post">
</form>
</div>
<!-- End status div -->




<style>
a {
  color: black !important;
}
a:hover {
  color: #dcdcdc !important;
}
body {
background-color: #dfe3ee !important;
}

</style>

<script src="https://use.fontawesome.com/7fe550bc59.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>
