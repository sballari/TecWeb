<?php

class User{
  private $name;
  private $surname;
  private $password;
  private $email;

  function __construct($e,$p,$n,$s) {
    global $name,$surname,$password,$email;
    $email=$e;
    $password=$p;
    $name=$n;
    $surname=$s;
  }

  function getSurname(){
    return $this->surname;
  }
  function getName(){
    return $this->name;
  }
  function getEmail(){
    return $this->email;
  }
  function getPassword(){
    return $this->password;
  }
}

?>
