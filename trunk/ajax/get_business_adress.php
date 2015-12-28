<?php include_once("../db.php");
	$t = getAllBusiness();
	$first=0;
	foreach ($t as $elt) {
		if ($first++>0) echo "#";
		echo $elt[0];
		echo "%";
		$t2= $elt[1];
		echo implode("£",$t2);
	}
	//echo "#";
	//echo implode("#",$t);
?>