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

  public function getSurname(){
    return $this->surname;
  }
  public function getName(){
    return $this->name;
  }
  public function getEmail(){
    return $this->email;
  }
  public function getPassword(){
    return $this->password;
  }
}

?>
