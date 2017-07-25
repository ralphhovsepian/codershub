<?php

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



public function emailprovider($email) {

$this->email = $email;

if(preg_match('/(gmail.com|yahoo.com|hotmail.com|outlook.com)/', $this->email)) {
  return true;
} else {
  return false;
}

}


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


public static function checklogin() {

  if(isset($_SESSION['id']) and !empty($_SESSION['id']) and isset($_SESSION['email']) and !empty($_SESSION['email'])) {

    header('Location: ./home.php');
}
}


public static function checkiflogged() {

if(!isset($_SESSION['id']) and empty($_SESSION['id']) and !isset($_SESSION['email']) and empty($_SESSION['email'])) {
  header('Location: ./index.php');

}
}


public static function logout() {
  session_destroy();
  header('Location: ./index.php');
}



}


?>
