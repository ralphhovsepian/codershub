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



<!-- Forgot Password Form -->
<div id="forgotform">
<br>
<h3>Reset your Password:</h3>
<p>Sorry for your password loss! But hey, you could reset it by just entering your Email Address!</p>

<form action="forgot.php" method="POST" class="form-group">
<label for="email">Email Address:</label>
          <input type="email" name="forgotemail" id="email" placeholder="e.g. john.doe@example.com" class="form-control" required>
            <br>
          <input type="submit" name="forgotsubmit" class="btn btn-primary btn-block" value="Reset Password">
</form>
</div>
<!-- End Forgot Password Form -->


<?php

//Checking if email is isset and not empty

if(isset($_POST['forgotemail']) and !empty($_POST['forgotemail'])) {
  

// calling the forgotpassword function
$user->forgotpassword($_POST['forgotemail']);
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
<!-- End Styling -->

<script src="https://use.fontawesome.com/7fe550bc59.js"></script>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

</body>
</html>
