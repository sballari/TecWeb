<?php


class User{
  private $name;
  private $surname;
  private $password;
  private $email;
  private $type;//"All'ingrosso", "Serizi","Al minuto"

  function __construct($e,$p,$n,$s,$tp) {
    
    $this->email=$e;
    $this->password=$p;
    $this->name=$n;
    $this->surname=$s;
    $this->type = $tp;
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
  public function getType(){
      return $this->type;
  }
}

?>
