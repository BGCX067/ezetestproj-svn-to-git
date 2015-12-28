<?php

function connect() {
$serveur = "kimsufi.com";
$nom_base = "ezemeet";
$login = "ezemeet";
$pwd = "Australia";
$link=mysql_connect("localhost","ezemeet","Australia") or die ('ERREUR '.mysql_error());
$db_selected = mysql_select_db('ezemeet', $link);
}

function quote($s) {
	return str_replace("'","''",$s);
}

function getStates() {
	connect();
	$req="select * from state order by state";
	$res = mysql_query($req);
	unset($tab);
	while($row = mysql_fetch_array($res)) {
		$id=$row["id_state"];
		$tab["'".$id."'"]=$row["state"];
	}
	return $tab;
}

function getTypes() {
	connect();
	$req="select * from type order by type";
	$res = mysql_query($req);
	unset($tab);
	while($row = mysql_fetch_array($res)) {
		$id=$row["id_type"];
		$tab["'".$id."'"]=$row["type"];
	}
	return $tab;
}

function getTypesMike() {
	connect();
	$req="select * from type order by type";
	$res = mysql_query($req);
	unset($tab);
	while($row = mysql_fetch_array($res)) {
		$id=$row["id_type"];
		$type=$row["type"];
		$parent=$row["id_parent"];
		$tab["'".$id."'"][0]=$type;
		$tab["'".$id."'"][1]=$parent;
	}
	return $tab;
}

function getCountries() {
	connect();
	$req="select * from country order by country";
	$res = mysql_query($req);
	unset($tab);
	while($row = mysql_fetch_array($res)) {
		$id=$row["id_country"];
		$tab["'".$id."'"]=$row["country"];
	}
	return $tab;
}

function getdb($table,$id) {
	connect();
	$req="select ".$table." from ".$table." where id_".$table."=".$id;
	$res = mysql_query($req);
	$row = mysql_fetch_array($res);
	return $row[0];
}

function getfromBusiness($field,$id) {
	connect();
	$req="select ".$field." from business where id_business=".$id;
	$res = mysql_query($req);
	$row = mysql_fetch_array($res);
	return $row[0];
}

function getAdresses($type) {
	connect();
	$req="select * from business where id_type=".$type;
	$res = mysql_query($req);
	unset($tab);
	while($row = mysql_fetch_array($res)) {
		$tab[]=$row["adress1"].'|'.$row["adress1"].' '.$row["postcode"].' '.$row["city"];
	}
	return $tab;
}

function getAllBusiness() {
	connect();
	$req="select * from business order by id_type";
	$res = mysql_query($req);
	unset($tab);
	$change=true;
	$nb_type=-1;
	$old_type=-1;
	while($row = mysql_fetch_array($res)) {
		if ($row["id_type"]!=$old_type) {
			$nb_type++;
			$tab[$nb_type][0]=$row["id_type"];
			$old_type=$row["id_type"];
		}
		
list($pict_width, $pict_height, $type, $attr) = getimagesize("http://ezemeet.copops.com/photo_business/1/".$row["photo"]);
if ($pict_width>$pict_height) {
	if ($pict_width>200) {
		$pict_height = round((200*$pict_height)/$pict_width);
		$pict_width = 200 ;
	}
} else {
	if ($pict_height>200) {
		$pict_width = round((200*$pict_width)/$pict_height);
		$pict_height = 200 ;
	}
}		
		
		$photoinfo = $row["photo"]."(".$pict_width."(".$pict_height;
		$tab[$nb_type][1][]=$row["geolocalisation"].'|'.$row["name"].'|'.$row["adress1"].'|'.$row["adress2"].'|'.$row["postcode"].'|'.$row["city"].'|'.$photoinfo.'|'.$row["website"].'|'.$row["id_business"];
	}
	return $tab;
}

function register_business($name,$email,$website,$password,$id_type,$description,$adress1,$adress2,$city,$postcode,$id_state,$id_country,$geolocalisation,$photo) {
	connect();
	$req="insert into business (name,email,website,password,id_type,description,adress1,adress2,city,postcode,id_state,id_country,geolocalisation,ip) 
						values('".$name."',
						'".$email."',
						'".quote($website)."',
						'".$password."',
						'".$id_type."',
						'".quote($description)."',
						'".quote($adress1)."',
						'".quote($adress2)."',
						'".quote($city)."',
						'".$postcode."',
						'".$id_state."',
						'".$id_country."',
						'".$geolocalisation."',
						'".$_SERVER["REMOTE_ADDR"]."'
						)";
	//die($req);
	$res = mysql_query($req);
	$idbiz = mysql_insert_id();
	$ext=explode('.',$photo);
	$photoname=str_pad($idbiz,6,'0',STR_PAD_LEFT).'_1.'.$ext[1];
	$req="update business set photo='".$photoname."' where id_business=".$idbiz;
	$res = mysql_query($req);
	return $idbiz;
}
