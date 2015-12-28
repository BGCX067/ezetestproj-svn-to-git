<?php

function connect() {
$serveur = "kimsufi.com";
$nom_base = "ezemeet";
$login = "ezemeet";
$pwd = "Australia";
$link=mysql_connect("localhost:8888","local","aaaaa") or die ('ERREUR '.mysql_error());
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

connect();