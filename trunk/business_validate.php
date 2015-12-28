<?php session_start();include("db.php");
if ( (strlen($_SESSION["post_name"])<1) ) header("location: business_registration.php");
else {
	$idbiz=register_business($_SESSION["post_name"],
						$_SESSION["post_email"],
						$_SESSION["post_website"],
						$_SESSION["post_pwd"],
						$_SESSION["post_type"],
						$_SESSION["post_description"],
						$_SESSION["post_adress1"],
						$_SESSION["post_adress2"],
						$_SESSION["post_city"],
						$_SESSION["post_postcode"],
						$_SESSION["post_state"],
						$_SESSION["post_country"],
						$_SESSION["geolocalisation"],
						$_SESSION["photo"]
						);
	$ext = explode('.',$_SESSION["photo"]);
	$ok = copy($_SESSION["photo"],"photo_business/1/".str_pad($idbiz,6,'0',STR_PAD_LEFT).'_1.'.$ext[1]);
	if (!$ok) die();
	unset($_SESSION["post_name"]);
	unset($_SESSION["post_email"]);
	unset($_SESSION["post_website"]);
	unset($_SESSION["post_pwd"]);
	unset($_SESSION["post_pwd2"]);
	unset($_SESSION["post_type"]);
	unset($_SESSION["post_description"]);
	unset($_SESSION["post_adress1"]);
	unset($_SESSION["post_adress2"]);
	unset($_SESSION["post_city"]);
	unset($_SESSION["post_postcode"]);
	unset($_SESSION["post_state"]);
	unset($_SESSION["post_country"]);
	unset($_SESSION["photo"]);
	unset($_SESSION["geolocalisation"]);
}
?>


your business registration is complete

<a href="showmapYoric.php">go back to home page
</a>