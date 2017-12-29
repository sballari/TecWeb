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

function getImage() {
  return $this->$imagePath;
}

function getDesc() {
  return $this->desc;
}

function getIngredients() {
  return $this->ingredientes;
}

function getType() {
  return $this->type;
}

function getName() {
  return $this->name;
}

?>
