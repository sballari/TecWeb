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
    global $conn, $servername, $password, $username, $dbname, $status;
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) $status=false;
    else $status=true;
    return $status;
  }

  function submitQuery(string $query) {
    global $conn, $status;
    if ($status) return $conn->query($query);
    else return false;
  }

  function disconnect() {
    global $conn, $status;
    $status = false;
    return $conn->close();
  }
}
?>
