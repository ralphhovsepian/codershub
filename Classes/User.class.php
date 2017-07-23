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
      $this->email = htmlspecialchars(trim($email))
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
  $this->birthday = htmlspecialchars(trim($birthday);

  
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
