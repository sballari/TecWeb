<?php

class Product {
  private $imagePath;
  private $desc;
  private $ingredientes;
  private $type;
  privete $name;
}
function __construct($imgPath, $desc, $ingr, $type, $name){
  global $imagePaht, $desc, $ingredientes, $type, $name;
  $imgPath=$imgPath;
  $desc=$desc;
  $ingredientes=$ingr;
  $type=$type;
  $name=$name;
}

public function getImage() {
  return $this->$imagePath;
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

?>
