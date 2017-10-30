<?php
/**
 *
 */
class Connection
{

  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $db = "codershub";
  public $connection;

public function __construct()
  {

  $this->connection = new mysqli($this->host, $this->username, $this->password, $this->db);

  if($this->connection->connect_errno) {
    echo "Could not connect to the Database";
  }
  }

public function __destruct() {
  return $this->connection->close();
}



}



 ?>
