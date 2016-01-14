<?php
function __autoload($className){
  //require_once('classes/'.$className.'.class.php');
  require 'classes/'.$className.'.class.php';
}
?>
