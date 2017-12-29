<?php
include "DBmanager.php"
class Factory {
  private $dbM;

  function __construct($dbman){
    $this->dbM = $dbman
  }
}
?>
