<?php

class Product {
  private $imagePath;
  private $desc;
  private $ingredientes;
  private $type;
  private $name;

  function __construct($imgPath, $desc, $ingr, $type, $name){
    $this->imagePath=$imgPath;
    $this->desc=$desc;
    $this->ingredientes=$ingr;
    $this->type=$type;
    $this->name=$name;
  }

  public function getImage() {
    return $this->imagePath;
  }

  public function getDesc() {
    return $this->desc;
  }

  public function getIngredients() {
    return $this->ingredientes;
  }

  public function getType() {
    return $this->type;
  }

  public function getName() {
    return $this->name;
  }
}

?>
