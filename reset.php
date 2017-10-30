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



<!-- Reset Password Form -->
<div id="forgotform">
<br>
<h3>Reset your Password:</h3>

<form action="reset.php" method="GET" class="form-group">

 			<input type="email" name="resetemail" id="email" placeholder="Your Email" class="form-control" required>
            <br>
            <input type="password" name="tokenconf" id="password" placeholder="Token" class="form-control" required>
            <br>
             <input type="password" name="resetpass" id="password" placeholder="New Password" class="form-control" required>
            <br>
      		<input type="submit" class="btn btn-primary btn-block" value="Reset Password">
</form>
</div>
<!-- End Reset Password Form -->


<?php


 
// Checks if Email , Password , and Token are isset
if(isset($_GET['resetemail']) and isset($_GET['resetpass']) and isset($_GET['tokenconf'])) {


//calls TokenValidation Function
$user->TokenValidation($_GET['tokenconf'], $_GET['resetemail']);

// calls RessetingPassword Function
$user->ResettingPassword($_GET['resetemail'], $_GET['tokenconf'], $_GET['resetpass']);
} 



?>


<!-- Styling -->
<style>
a {
  color: white !important;
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
