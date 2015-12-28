<?php session_start();

$x = $_POST["x"];
$y = $_POST["y"];
$a = $_POST["a"];

$_SESSION["geolocalisation"]=$y.','.$x;
$_SESSION["adress"]=$a;