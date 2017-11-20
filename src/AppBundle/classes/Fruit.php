<?php
namespace AppBundle\classes;
class Fruit{
private $name;
private $origin;
private $comestible;
private $url;

public function __construct($name,$origin,$comestible,$url){
  $this->setName($name);
  $this->setOrigin($origin);
  $this->setComestible($comestible);
  $this->setUrl($url);}
public function getName(){return $this->name;}
public function getOrigin(){return $this->origin;}
public function getComestible(){return $this->comestible;}
public function getUrl(){return $this->url;}
public function setName($name){
  $this->name=$name;
  return $this->name;
}
public function setOrigin($origin){
  $this->origin=$origin;
  return $this->origin;
}
public function setComestible($comestible){
  $this->comestible=$comestible;
  return $this->comestible;
}
public function setUrl($url){
  $this->url=$url;
  return $this->url;
}
}
