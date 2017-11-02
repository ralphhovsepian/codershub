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

      $this->Data = array();

  		$this->sql = "SELECT `id`, `email`, `password`, `acttoken` FROM `users` WHERE `email` = ?";
  		$this->check = $this->connection->prepare($this->sql);
  		$this->check->bind_param('s', $this->email);
  		$this->check->execute();
  		$this->check->store_result();

      $this->total = $this->check->num_rows;
      		if ($this->total > 0) {

            $this->check->bind_result($this->dbid, $this->dbemail, $this->dbpassword, $this->acttoken);
            $this->check->fetch();
            $this->check->close();
          
      if (password_verify($this->password, $this->dbpassword)) {

          if($this->acttoken == 0) {
              $_SESSION['id'] = $this->dbid;
              $_SESSION['email'] = $this->dbemail;
              $_SESSION['password'] = $this->dbpassword;
              header("Location: ./home.php");
} else {
 echo "<div class='alert alert-danger' role='alert'><strong>Error! </strong>Email Not Activated.</div>";
}
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
  $this->activationtoken = md5(uniqid(rand(), true));
  $this->confirmeddefault = 0;

  $this->checkemail = self::checkEmail($this->email);
  $this->checkemailprov = self::emailprovider($this->email);

  if($this->checkemail == true) {

    echo "<div class='alert alert-danger' role='alert'>Email Already in use.</div>";

} elseif($this->checkemailprov == false) {


      echo "<div class='alert alert-danger' role='alert'>We do not accept this type of email. Please try another one.</div>";

} else {

  $this->RegisterSql = "INSERT INTO `users`(`name`, `email`, `password`, `birthday`, `acttoken`, `confirmed`) VALUES (?,?,?,?,?,?)";
  $this->checkreg = $this->connection->prepare($this->RegisterSql);
  $this->checkreg->bind_param('ssssss', $this->name, $this->email, $this->password, $this->birthday, $this->activationtoken, $this->confirmeddefault);
  $this->executereg = $this->checkreg->execute();
  $this->checkreg->close();


    $this->Data = array();
    $this->getacttokenquery = "SELECT `acttoken` FROM `users` WHERE `acttoken` = ? AND `email` = ?";
    $this->getacttoken = $this->connection->prepare($this->getacttokenquery);
    $this->getacttoken->bind_param('ii', $this->activationtoken, $this->email);
    $this->getacttoken->execute();
    $this->getacttoken->bind_result($this->acttoken);
    $this->getacttoken->fetch();
    $this->Data['acttoken'] = $this->acttoken;
    $this->Data['email'] = $this->email;
    $this->getacttoken->free_result();
    $this->getacttoken->close();

   
  if ($this->executereg) {


$mail = new PHPMailer(true);                            
try {
    
    $mail->isSMTP();                                    
    $mail->Host = 'smtp.live.com'; 
    $mail->SMTPAuth = true;                              
    $mail->Username = 'youremail';                 
    $mail->Password = 'yourpassword';                          
    $mail->SMTPSecure = 'tls';                           
    $mail->Port = 587;                                   

   
    $mail->setFrom('youremail', 'CodersHub');
    $mail->addAddress($this->email);               
    $mail->isHTML(true);                                
    $mail->Subject = 'CodersHub Confirm Email';
    $mail->Body    = "Hey! You have just created an account. Here is the link to confirm your Email.<br><br> 

    <a href='localhost/codershub/confirm.php?token=$this->acttoken&email=$this->email'>Click here to activate your account</a>
  
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
}



/**
   * Activates Account
   */


public function confirmEmail($acttoken, $email) {

$this->acttoken = $this->connection->real_escape_string(htmlentities($acttoken));
$this->email = $this->connection->real_escape_string(htmlentities($email));

$this->aftert = 0;
$this->afterc = 1;

$this->Data = array();
$this->ConfirmEmailQuery = "SELECT `acttoken`, `email` FROM `users` WHERE `acttoken` = ? AND `email` = ?";
$this->ConfirmEmail = $this->connection->prepare($this->ConfirmEmailQuery);
$this->ConfirmEmail->bind_param('ii', $this->acttoken, $this->email);
$this->ConfirmEmail->execute();
$this->ConfirmEmail->bind_result($this->acttokendb, $this->emaildb);
$this->ConfirmEmail->fetch();
$this->Data['acttoken'] = $this->acttokendb;
$this->Data['email'] = $this->emaildb;
$this->ConfirmEmail->free_result();
$this->ConfirmEmail->close();

  
if($this->email == $this->emaildb && $this->acttoken == $this->acttokendb && $this->acttoken != 0 && !empty($this->acttoken)) {

    $this->UpdateToken = "UPDATE `users` SET `confirmed` = ?, `acttoken` = ? WHERE `email` = ?";
  $this->checkupdatetoken = $this->connection->prepare($this->UpdateToken);
  $this->checkupdatetoken->bind_param('sss', $this->afterc, $this->aftert, $this->email);
  $this->executeupdatetoken = $this->checkupdatetoken->execute();
  $this->checkupdatetoken->close();

  echo "<div class='alert alert-success' role='alert'>Email Activated. You can now Login.</div>";

} else {
  echo "<div class='alert alert-danger' role='alert'>An Error has been occured.</div>";
}


}


/**
  * Forgot Password Function
  * Adds a Token to the Column
  * Sends a mail to the corresponding Email Address
  */

public function forgotpassword($email) {

  $this->email = htmlspecialchars(trim($email));
  $this->token = md5(uniqid(rand(), true));

  $this->UpdateToken = "UPDATE `users` SET `resetpasstoken` = ? WHERE `email` = ?";
  $this->checkupdatetoken = $this->connection->prepare($this->UpdateToken);
  $this->checkupdatetoken->bind_param('ss', $this->token ,$this->email);
  $this->executeupdatetoken = $this->checkupdatetoken->execute();
  $this->checkupdatetoken->close();




  if($this->executeupdatetoken) {



$mail = new PHPMailer(true);                              
try {
    
    $mail->isSMTP();                                      
    $mail->Host = 'smtp.live.com'; 
    $mail->SMTPAuth = true;                               
    $mail->Username = 'youremail';                 
    $mail->Password = 'yourpassword';                           
    $mail->SMTPSecure = 'tls';                          
    $mail->Port = 587;

    
    $mail->setFrom('youremail', 'CodersHub');
    $mail->addAddress($this->email);
    $mail->isHTML(true);                                 
    $mail->Subject = 'CodersHub Reset Password';
    $mail->Body    = "Hey! You just requested a password reset. Here is the code to reset your password.<br><br> 

    Token: $this->token

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

$this->token = $this->connection->real_escape_string(htmlentities($token));
$this->email = $this->connection->real_escape_string(htmlentities($email));


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


/**
   * Resets Password
   */

public function ResettingPassword($emaill, $token, $password) {

$this->password = $password;
$this->password = trim(password_hash($this->password, PASSWORD_DEFAULT));
$this->token = $this->connection->real_escape_string(htmlentities($token));
$this->emaill = $this->connection->real_escape_string(htmlentities($emaill));

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
