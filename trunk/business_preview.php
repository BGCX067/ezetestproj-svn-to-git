<?php session_start();include("db.php"); 
if ( (strlen($_SESSION["post_name"])<1) ) header("location: business_registration.php");

list($pict_width, $pict_height, $type, $attr) = getimagesize($_SESSION["photo"]);
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/<?php echo "style2.css"."?sc=time()" ?>" />
<script src="js/jquery_pack.js" type="text/javascript"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ"
            type="text/javascript"></script>
    <script type="text/javascript">

   var map = null;
   var geocoder = null;

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        //map.setCenter(new GLatLng(37.4419, -122.1419), 13);
        
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress() {
      map.setCenter(new GLatLng(<?php echo $_SESSION['geolocalisation']?>), 16);
      var marker = new GMarker(new GLatLng(<?php echo $_SESSION['geolocalisation']?>));
      map.addOverlay(marker);
      marker.openInfoWindowHtml('<div style="font-size:16px;font-weight:bold"><?php echo $_SESSION['post_name']?></div><div style="font-size:11px;"><?php echo $_SESSION['post_adress1']?></div><div style="font-size:11px;"><?php echo $_SESSION['post_city']?></div>');
      /*
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert('the adress you entered: '+address + " was not found");
            } else {
              map.setCenter(point, 16);
              var marker = new GMarker(point);
              map.addOverlay(marker);
              marker.openInfoWindowHtml('<b><?php echo $_SESSION['post_name']?></b><br><?php echo $_SESSION['post_adress1']?><br><?php echo $_SESSION['post_city']?>'+address);
            }
          }
        );
      }
      */
    }

 $(document).ready(function(){
 	initialize();
 	showAddress();
 });

    </script>
    
</head>

<body onunload="GUnload()">

<div id="content">

<div id="header">
	<?php include("page/header.php"); ?>
</div>

<div id="menu">
	<?php include("page/menubar.php"); ?>
</div>

<div id="body">
<div id="body_content">

	<br>
	Please check the information you entered before clicking register :
	
	
	<div id="step1" style="border:1px solid black;background-color:#f9f9f9;min-height:330px;">

<div style="height:26px;text-align:center;" id="error_step1">
</div>

<div class="form" style="margin-right:1px;margin-left:18px;width:214px;margin-top:10px;">
	<div class="form_row" >
		<div style="width:200px;height:200px;">
			<img width="<?php echo $pict_width?>" height="<?php echo $pict_height?>" src="<?php echo $_SESSION["photo"] ?>"></img>
		</div>
	</div>
	<br><br><br>
</div>

<div class="form" style="margin-right:1px;margin-left:0px;width:312px">
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:0px;padding-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Email (login)&nbsp;:</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">
			<label><?php echo $_SESSION["post_email"]?></label>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Name :</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">	
			<label><?php echo $_SESSION["post_name"]?></label>
		</div>
		<div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Website :</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">
			<label><?php echo $_SESSION["post_website"]?></label>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Type :</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">
			<label>
			<?php
				$t=getTypes();
				foreach($t as $k=>$v)
					if ("'".$_SESSION["post_type"]."'"==$k) echo $v;
			?>
			</label>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="padding-bottom:0px;overflow:auto;">
		<div class="form_tdlabel" style="text-align:left;width:200px;border:0px dashed gray;height:76px;padding:4px;">
			<?php echo $_SESSION["post_description"]?>
		</div>
	</div>
	<div style="clear: right;"></div>
</div>

<div class="form" style="margin-right:1px;margin-left:0px;margin-top:8px;width:350px">
<!--
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<span style="color:gray">Adress :</span>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $_SESSION["post_adress1"]?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $_SESSION["post_adress2"]?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $_SESSION["post_postcode"]. " - " .$_SESSION["post_city"]?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php 
		echo getdb("state",$_SESSION["post_state"]). " - " .getdb("country",$_SESSION["post_country"])
		?>
	</div>
	-->
	<div id="map" style="width: 330px; height: 300px;border:1px solid black">
		
	</div>
</div>


<div style="clear: left;"></div>
</div>













	<div style="height:30px;margin-top:22px;">
	<div style="float:left">
		<a href="business_registration.php">
		<img onclick="" style="border:0;cursor:pointer" id="btn_back" src="image/btn_back_1.gif" onmouseover="getElementById('btn_back').src='image/btn_back_0.gif';" onmouseout="getElementById('btn_back').src='image/btn_back_1.gif';"></img>
		</a>
	</div>
	<div style="float:right">
		<a href="business_validate.php">
		<img style="border:0;cursor:pointer" id="btn_register" src="image/btn_register_1.gif" onmouseover="getElementById('btn_register').src='image/btn_register_0.gif';" onmouseout="getElementById('btn_register').src='image/btn_register_1.gif';"></img>
		</a>
	</div>
	<div style="clear: left;"></div>
	<div style="clear: right;"></div>
	</div>

</div>
<div id="body_right">
	<?php include("page/body_right.php"); ?>
</div>

<div style="clear: left;"></div>
<div id="footer">
	<?php include("page/footer.php"); ?>
</div>

</div>

</html>

