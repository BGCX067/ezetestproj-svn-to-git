<?php session_start();include("db.php");
$id=$_GET["b"];
if (strlen($id)<1) $id=1;
$geolocalisation = getfromBusiness('geolocalisation',$id);
$name 			= getfromBusiness('name',$id);
$adress1 		= getfromBusiness('adress1',$id);
$adress2 		= getfromBusiness(