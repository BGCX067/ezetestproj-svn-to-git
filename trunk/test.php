<?php session_start();include("db.php");
$id=$_GET["b"];
if (strlen($id)<1) $id=1;
$geolocalisation = getfromBusiness('geolocalisation',$id);
$name 			= getfromBusiness('name',$id);
$adress1 		= getfromBusiness('adress1',$id);
$adress2 		= getfromBusiness('adress2',$id);
$postcode 		= getfromBusiness('postcode',$id);
$city 			= getfromBusiness('city',$id);
$photo 			= getfromBusiness('photo',$id);
$email 			= getfromBusiness('email',$id);
$website 		= getfromBusiness('website',$id);
$id_type 		= getfromBusiness('id_type',$id);
$description 	= getfromBusiness('description',$id);
$id_state		= getfromBusiness('id_state',$id);
$id_country		= getfromBusiness('id_country',$id);

list($pict_width, $pict_height, $type, $attr) = getimagesize("http://ezemeet.copops.com/photo_business/1/".$photo);
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
<script src="js/jquery.MikeLayer.js" type="text/javascript"></script>

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
      map.setCenter(new GLatLng(<?php echo $geolocalisation?>), 16);
      var marker = new GMarker(new GLatLng(<?php echo $geolocalisation?>));
      map.addOverlay(marker);
      marker.openInfoWindowHtml("<div style='font-size:16px;font-weight:bold'><?php echo $name?></div><div style='font-size:11px;'><?php echo $adress1?></div><div style='font-size:11px;'><?php echo $city?></div>");
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
              marker.openInfoWindowHtml('<div><?php echo $name?></div><div><?php echo $adress1?></div><div><?php echo $city?>'+address);
            }
          }
        );
      }
      */
    }

 $(document).ready(function(){
 	initialize();
 	showAddress();
 	
 	var html='<div style="padding:5px;width:750;height:500;">tadada tada<br>tadada tadatadada tada<br><img width="700" height="438" src="http://monc.se/galleria/demo/img/sea-mist.jpg"><br>tadada tadatadada tada<br></div>';
 	
 	$("#logodiv").aqLayer({closeBtn:true,attach:'ne',offsetY:-150,offsetX:-100}).click(function(){ $(this).aqLayer(html) });
 	
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
	Business profile informations :
	
	
	<div id="step1" style="border:1px solid black;background-color:#f9f9f9;min-height:330px;">

<div style="height:26px;text-align:center;" id="error_step1">
</div>

<div class="form" style="margin-right:1px;margin-left:18px;width:214px;margin-top:10px;">
	<div class="form_row" >
		<div id="logodiv" style="width:200px;height:200px;">
			<img style=";cursor:pointer" id="logo" width="<?php echo $pict_width?>" height="<?php echo $pict_height?>" src="photo_business/1/<?php echo $photo ?>"></img>
		</div>
	</div>
	<br><br><br>
</div>

<div class="form" style="margin-right:1px;margin-left:0px;width:310px">
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:0px;padding-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Email (login)&nbsp;:</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">
			<label><?php echo $email?></label>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Name :</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">	
			<label><?php echo $name?></label>
		</div>
		<div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="width:80px;color:gray;">
			<label>Website :</label>
		</div>
		<div class="form_tdinput" style="color:black;text-align:left;float:left;margin-left:10px;">
			<label><a target="_blank" href="<?php echo $website?>"><?php echo $website?></a></label>
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
					if ("'".$id_type."'"==$k) echo $v;
			?>
			</label>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="padding-bottom:0px;overflow:auto;">
		<div class="form_tdlabel" style="text-align:left;width:200px;border:0px dashed gray;height:76px;padding:4px;">
			<?php echo $description?>
		</div>
	</div>
	<div style="clear: right;"></div>
</div>

<div class="form" style="margin-right:1px;margin-left:0px;margin-top:8px;width:330px">
<!--
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<span style="color:gray">Adress :</span>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $adress1?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $adress2?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php echo $postcode. " - " .$city?>
	</div>
	<div class="form_row" style="padding-bottom:0px;color:#000;text-align:left">
		<?php 
		echo getdb("state",$id_state). " - " .getdb("country",$id_country)
		?>
	</div>
	-->
	<div id="map" style="height: 300px;border:1px solid black">
		
	</div>
</div>


<div style="clear: left;"></div>
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

