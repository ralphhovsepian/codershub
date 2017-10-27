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


<!-- Start Profile Info -->

<div id="profile" class="container">
<img src="./assets/images/defautcover.jpg" class="imgA1 img-fluid rounded">
<img src="./assets/images/default.png" class="imgB1 img-fluid img-thumbnail" width="200" height="200">
<h5 class="name"><b><?php $user->getName($_SESSION['id']); ?></b></h5>
<br><br>
<div id="about">
  <br>
<h6><i class="fa fa-address-card" aria-hidden="true"></i><b> About</b></h6>

<?php $user->getInfo($_SESSION['id']); ?>
  
</div>
</div>
<!-- End Profile Info -->




<style>
#about {
  background-color: whitesmoke;
  float: left;
  padding-left: 20px;
  padding-right: 20px;
  border-radius: 3px;

}
a {
  color: black !important;
}
a:hover {
  color: #dcdcdc !important;
}
body {
background-color: #dfe3ee !important;
}

.imgA1, .imgB1 {
  position: absolute;


}
.imgA1 {
  position: relative;
  		top: 0;
  		left: 0;
}
.imgB1 {
  position: absolute;
		top: 200px;
		left: 80px;

}

.name {
  position: absolute;
    top: 380px;
    left: 100px;
    color: white;
}
</style>

<script src="https://use.fontawesome.com/7fe550bc59.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>
