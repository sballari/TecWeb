<?php
class DBmanager {
  private $servername;
  private $username;
  private $password;
  private $dbname;
  private $conn;
  private $status;

  function __construct($sn,$un, $pass,$dbn){
    $this->servername = $sn;
    $this->username = $un;
    $this->password = $pass;
    $this->dbname = $dbn;
  }

  function getStatus(){
    return $this->status;
  }

  function connect() {
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if ($this->conn->connect_error) $this->status=false;
    else $this->status=true;
    return $this->status;
  }

  function submitQuery(string $query) {
    if ($this->status) return $this->conn->query($query);
    else return false;
  }

  function disconnect() {
    $this->status = false;
    return $this->conn->close();
  }

  // function no(){
  //   return $this->conn;
  // }
}
?>
