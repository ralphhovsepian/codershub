<?php

session_start();

include './Classes/User.class.php';

$user = new User;

User::checklogin();

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

<nav class="navbar navbar-light bg-primary">
  <a href="index.php" id="navhead" href="navbar-brand">CODERSHUB</a>
</nav>



<!-- Login/Signup Buttons Div Start-->
<center>
<div id="signupin" class="container">
  <br>
<input type="submit" class="btn btn-outline-primary" value="Login" data-toggle="modal" data-target="#login">
<input type="submit" class="btn btn-outline-success" value="Join now" data-toggle="modal" data-target="#signup">
<br><br>
</div>
</center>
<!-- Login Signup Buttons Div End -->


<!-- Login Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginLongTitle">Login to your account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="index.php" method="POST" class="form-group">
          <label for="email">Email Address:</label>
          <input type="email" name="email" id="email" placeholder="e.g. john.doe@example.com" class="form-control" required>
          <br>
          <label for="password">Password:</label>
          <input type="password" name="password" id="password" placeholder="Your password" class="form-control" required><br>
          <a href="./forgot.php" style="color:blue;">Forgot Password</a>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Login">
        </form>
      </div>
    </div>
  </div>
</div>

<?php
							if(isset($_POST['password']) && isset($_POST['email']) && !empty($_POST['email']) && !empty($_POST['password'])) {
								$user->Login($_POST['email'], $_POST['password']);
							}
?>
<!-- End Login Modal -->


<!-- Start Sign Up Modal -->
<div class="modal fade" id="signup" tabindex="-1" role="dialog" aria-labelledby="signupLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupLongTitle">Register A New Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" class="form-group">
        <form action="index.php" method="POST">
          <label for="name">Name:</label>
          <input type="name" name="namereg" id="name" placeholder="e.g. John Doe" class="form-control" required>
          <br>
          <label for="email">Email:</label>
          <input type="email" name="emailreg" id="email" placeholder="e.g. john.doe@example.com" class="form-control" required>
          <br>
          <label for="password">Password:</label>
          <input type="password" name="passwordreg" id="password" placeholder="Your new password" class="form-control" required>
          <br>

  <div class="well">
        <div class="form-group">
        <label>Date of Birth</label>
        <input type="date" name="birthdayreg" class="form-control" id="dateofbirth" placeholder="Date of Birth">
      </div>
  </div>

  <div class="well">
  </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Join">
          </form>
      </div>
    </div>
  </div>
</div>
<?php
if(isset($_POST['namereg']) and !empty($_POST['namereg']) and isset($_POST['emailreg']) and !empty($_POST['emailreg']) and isset($_POST['passwordreg']) and !empty($_POST['passwordreg']) and isset($_POST['birthdayreg']) and !empty($_POST['birthdayreg'])) {

$user->Signup($_POST['namereg'], $_POST['emailreg'], $_POST['passwordreg'], $_POST['birthdayreg']);

}

 ?>
<!-- End Sign Up Modal -->


<!-- Carousel Start -->
<center>
  <div id="pageheader" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#pageheader" data-slide-to="0" class="active"></li>
    <li data-target="#pageheader" data-slide-to="1"></li>
    <li data-target="#pageheader" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="assets/images/coder.jpg" alt="Coder">
      <div class="carousel-caption d-none d-md-block">
      <h3>Codershub</h3>
      <p>A Great Community for Programmers</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="assets/images/help.jpg" alt="Help">
      <div class="carousel-caption d-none d-md-block">
      <h3>Help Each Other!</h3>
      <p>A good way to learn coding</p>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="assets/images/join.jpg" alt="Join">
<div class="carousel-caption d-none d-md-block">
<h3>Join Codershub now!</h3>
<p>It's free, and will always be!</p>
<button type="submit" class="btn btn-success">Join</button>
</div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#pageheader" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#pageheader" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
</center>

<!-- Carousel End -->

<br><br><br>

<!-- Footer Start -->
<div class="bg-primary">
      <div class="text-center center-block">
        <br>
          <p class="text-white">Ralph Rob Production</p>
          <br />

          <a href="https://www.facebook.com/ralph.hovsepian.1">  <i class="fa fa-facebook-square fa-3x" aria-hidden="true"></i> </a>
            &nbsp;
            <a href="https://www.twitter.com/@ralph2000robert"> <i class="fa fa-twitter-square fa-3x" aria-hidden="true"></i></a>
              &nbsp;
            <a href="https://wwww.instagram.com/ralf_rob">     <i class="fa fa-instagram fa-3x" aria-hidden="true"></i></a>
</div>
</div>
</div>
<!-- Footer End -->

<style>
 a {
   color: white;
 }
</style>

<script src="https://use.fontawesome.com/7fe550bc59.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>
