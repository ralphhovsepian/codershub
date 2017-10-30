<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'vendor/autoload.php';

include 'connection.php';
/**
 *
 */
class User extends Connection
{

  function __construct()
  {
    Parent::__construct();
  }




/**
   * get the name of a user's using id.
   */


public function getName($id) {

$this->id = trim($id);
    $this->Data = array();
    $this->getnamesql = "SELECT `id`, `name` FROM `users` WHERE `id` = ?";
    $this->getname = $this->connection->prepare($this->getnamesql);
    $this->getname->bind_param('i', $this->id);
    $this->getname->execute();
    $this->getname->bind_result($this->id, $this->name);
    $this->getname->fetch();
    $this->Data['id'] = $this->id;
    $this->Data['name'] = $this->name;
    $this->getname->free_result();
    $this->getname->close();
   
    echo $this->Data['name'];

}


  /**
   * get the details of a user's profile using id.
   */

public function getInfo($idd) {

$this->idd = trim($idd);
    $this->Data = array();
    $this->getinfoquery = "SELECT `id`, `birthday`, `livesin`, `progtype`, `workplace` FROM `users` WHERE `id` = ?";
    $this->getinfo = $this->connection->prepare($this->getinfoquery);
    $this->getinfo->bind_param('i', $this->idd);
    $this->getinfo->execute();
    $this->getinfo->bind_result($this->idd, $this->birthday, $this->livesin, $this->progtype, $this->workplace);
    $this->getinfo->fetch();
    $this->Data['id'] = $this->idd;
    $this->Data['birthday'] = $this->birthday;
    $this->Data['livesin'] = $this->livesin;
    $this->Data['progtype'] = $this->progtype;
    $this->Data['workplace'] = $this->workplace;
    $this->getinfo->free_result();
    $this->getinfo->close();

echo "<center>".$this->Data['progtype']."</center><br><br>

<b><i class='fa fa-globe' aria-hidden='true'></i> Lives in:</b> ".$this->Data['livesin']."<br>

  <b><i class='fa fa-birthday-cake' aria-hidden='true'></i> Birthday:</b> ".$this->Data['birthday']."<br>
  <b><i class='fa fa-briefcase' aria-hidden='true'></i> Works at:</b> ".$this->Data['workplace']."<br><br>";


}



/**
   * Login System
   */

  public function Login($email, $password)
  	{
      $this->email = htmlspecialchars(trim($email));
  		$this->password = $password;

  		$this->sql = "SELECT `id`, `email`, `password` FROM `users` WHERE `email` = ?";
  		$this->check = $this->connection->prepare($this->sql);
  		$this->check->bind_param('s', $this->email);
  		$this->check->execute();
  		$this->check->store_result();

      $this->total = $this->check->num_rows;
      		if ($this->total > 0) {

            $this->check->bind_result($this->dbid, $this->dbemail, $this->dbpassword);
            $this->check->fetch();
            $this->check->close();

      if (password_verify($this->password, $this->dbpassword)) {
              $_SESSION['id'] = $this->dbid;
              $_SESSION['email'] = $this->dbemail;
              $_SESSION['password'] = $this->dbpassword;
              header("Location: ./home.php");
            } else {
                    echo "<div class='alert alert-danger' role='alert'><strong>Error! </strong>Wrong Email or Password.</div>";
                  }
          } else {

            echo "<div class='alert alert-danger' role='alert'><strong>Error! </strong>Wrong Email or Password.</div>";
          }

      	}


/**
   * Sign Up System
   */

public function Signup($name, $email, $password, $birthday) {

  $this->name = htmlspecialchars(trim($name));
  $this->email = htmlspecialchars(trim($email));
  $this->password = $password;
  $this->birthday = htmlspecialchars(trim($birthday));

  $this->password = password_hash($this->password, PASSWORD_DEFAULT);


  $this->checkemail = self::checkEmail($this->email);
  $this->checkemailprov = self::emailprovider($this->email);

  if($this->checkemail == true) {

    echo "<div class='alert alert-danger' role='alert'>Email Already in use.</div>";

} elseif($this->checkemailprov == false) {


      echo "<div class='alert alert-danger' role='alert'>We do not accept this type of email. Please try another one.</div>";

} else {

  $this->RegisterSql = "INSERT INTO `users`(`name`, `email`, `password`, `birthday`) VALUES (?,?,?,?)";
  $this->checkreg = $this->connection->prepare($this->RegisterSql);
  $this->checkreg->bind_param('ssss', $this->name, $this->email, $this->password, $this->birthday);
  $this->executereg = $this->checkreg->execute();
  $this->checkreg->close();
  if ($this->executereg) {
    echo "<div class='alert alert-success' role='alert'>Account Created! You can now login.</div>";
  } else {
 echo "<div class='alert alert-danger' role='alert'>An error has occured.</div>";
}


}

}


/**
  * Forgot Password Function
  * Adds a Token to the Column
  * Sends a mail to the corresponding Email Address
  */

public function forgotpassword($email) {

  $this->email = $email;
  $this->token = md5(uniqid(rand(), true));

  $this->UpdateToken = "UPDATE `users` SET `resetpasstoken` = ? WHERE `email` = ?";
  $this->checkupdatetoken = $this->connection->prepare($this->UpdateToken);
  $this->checkupdatetoken->bind_param('ss', $this->token ,$this->email);
  $this->executeupdatetoken = $this->checkupdatetoken->execute();
  $this->checkupdatetoken->close();


    $this->Data = array();
    $this->gettokenquery = "SELECT `resetpasstoken` FROM `users` WHERE `email` = ?";
    $this->gettoken = $this->connection->prepare($this->gettokenquery);
    $this->gettoken->bind_param('i', $this->email);
    $this->gettoken->execute();
    $this->gettoken->bind_result($this->resetpasstoken);
    $this->gettoken->fetch();
    $this->Data['resetpasstoken'] = $this->resetpasstoken;
    $this->gettoken->free_result();
    $this->gettoken->close();



  if($this->executeupdatetoken) {


$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.live.com'; //this is for hotmail  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'youremail';                 // SMTP username
    $mail->Password = 'yourpassword';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('youremail', 'CodersHub');
       // Add a recipient
    $mail->addAddress($this->email);               // Name is optional
  

    $this->link = $this->Data['resetpasstoken'];
    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'CodersHub Reset Password';
    $mail->Body    = "Hey! You just requested a password reset. Here is the code to reset your password.<br><br> 

    Token: $this->link 

    <a href='localhost/codershub/reset.php'>Click here to reset your password</a>
  
    <br><br>
    If you did not request that, Contact us immediately.";
    

    $mail->send();
   echo "<div class='alert alert-success' role='alert'>Check your Email Address for the next steps.</div>";
} catch (Exception $e) {
    echo "<div class='alert alert-danger' role='alert'>Something Went Wrong. Make sure that you have written your email address correctly.</div>";
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
  
}

}



/**
   * Checks if the token that was written is valid in the Database
   */

public function TokenValidation($token, $email) {

$this->token = $token;
$this->email = $email;


    $this->Data = array();
    $this->gettokenquery = "SELECT `resetpasstoken` FROM `users` WHERE `resetpasstoken` = ? AND `email` = ?";
    $this->gettoken = $this->connection->prepare($this->gettokenquery);
    $this->gettoken->bind_param('ii', $this->token, $this->email);
    $this->gettoken->execute();
    $this->gettoken->bind_result($this->resetpasstoken);
    $this->gettoken->fetch();
    $this->Data['resetpasstoken'] = $this->resetpasstoken;
    
    $this->gettoken->free_result();
    $this->gettoken->close();


}



public function ResettingPassword($emaill, $token, $password) {

$this->password = $password; 
$this->password = password_hash($this->password, PASSWORD_DEFAULT);
$this->token = $token;
$this->emaill = $emaill;

if($this->token == $this->Data['resetpasstoken'] && $this->token != 0 && !empty($this->token)) {


  if(isset($this->password) and !empty($this->password)) {

  $this->UpdatePass = "UPDATE `users` SET `password` = ? WHERE `email` = ?";
  $this->checkupdatepass = $this->connection->prepare($this->UpdatePass);
  $this->checkupdatepass->bind_param('ss', $this->password, $this->emaill);
  $this->executeupdatepass = $this->checkupdatepass->execute();
  $this->checkupdatepass->close();

if($this->executeupdatepass) {

  $this->nullvalue = 0;
  $this->UpdateTokenNull = "UPDATE `users` SET `resetpasstoken` = ? WHERE `email` = ?";
  $this->CheckUpdateTokenNull = $this->connection->prepare($this->UpdateTokenNull);
  $this->CheckUpdateTokenNull->bind_param('ss', $this->nullvalue, $this->emaill);
  $this->executeUpdateTokenNull = $this->CheckUpdateTokenNull->execute();
  $this->CheckUpdateTokenNull->close();

echo "<div class='alert alert-success' role='alert'>You have just changed your password!</div>";
} else {
  echo "<div class='alert alert-danger' role='alert'>Oops. Something Went Wrong</div>";
}

}
  
}

}



/**
   * Checks email provider and puts an error if it not a known provider
   */

public function emailprovider($email) {

$this->email = $email;

if(preg_match('/(gmail.com|yahoo.com|hotmail.com|outlook.com)/', $this->email)) {
  return true;
} else {
  return false;
}

}



/**
   * checks for existing email
   */

public function checkEmail($email) {

$this->email = $email;
$this->checkemailsql = "SELECT `email` FROM `users` WHERE `email` = ?";
$this->checkemail = $this->connection->prepare($this->checkemailsql);
$this->checkemail->bind_param('s', $this->email);
$this->checkemail->execute();
$this->checkemail->store_result();
$this->numRows = $this->checkemail->num_rows;
$this->checkemail->close();
if($this->numRows > 0) {
  return true;
}  else {
  return false;
}

}


/**
   * checks if logged in
   */


public static function checklogin() {

  if(isset($_SESSION['id']) and !empty($_SESSION['id']) and isset($_SESSION['email']) and !empty($_SESSION['email'])) {

    header('Location: ./home.php');
}
}


/**
   * checks if not logged in 
   */


public static function checkiflogged() {

if(!isset($_SESSION['id']) and empty($_SESSION['id']) and !isset($_SESSION['email']) and empty($_SESSION['email'])) {
  header('Location: ./index.php');

} else {
  $userid = $_SESSION['id'];
}
}

/**
   * log out system
   */


public static function logout() {
  session_destroy();
  header('Location: ./index.php');
}



}


?>
