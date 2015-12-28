<?php session_start(); include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/<?php echo "style2.css"."?sc=time()" ?>" />
<script src="js/jquery_pack.js" type="text/javascript"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ" type="text/javascript"></script>
 
<script type="text/javascript">
   var map = null;
   var geocoder = null;
   var markTab = new Array();

    function initialize() {
      if (GBrowserIsCompatible()) {
        map = new GMap2(document.getElementById("map"));
        map.addControl(new GLargeMapControl());
      	map.addControl(new GMapTypeControl());
      	map.setCenter(new GLatLng(-33.865861,151.211741), 14);
        geocoder = new GClientGeocoder();
      }
    }

    function showAddress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              //alert('the adress you entered: '+address + " was not found");
            } else {
              map.setCenter(point, 12);
              var marker = new GMarker(point);
              map.addOverlay(marker);
              //marker.openInfoWindowHtml(address);
            }
          }
        );
      }
    }
    
$(document).ready(function(){
 	initialize();
 	create_marker();
 });
function get_all_business(type,active) {
	//alert(type+' '+x);
	$.ajax({
   		type: "POST",
   		url: "ajax/get_business_adress.php",
   		data: "type="+0,
   		success: function(msg){
   			alert(msg);
   		/*
   			var answers=msg.split('#');
    		for(var i=0;i<answers.length;i++) {
    			var business = answers[i].split('|');
    			showAddress(business[1]);
    		}
    		*/
   		}
 });
}
function create_marker() {
	var tab_icon = new Array('red-dot.png','blue-dot.png','green-dot.png','orange-dot.png','pink-dot.png','purple-dot.png','yellow-dot.png');
	$.ajax({
   		type: "POST",
   		url: "ajax/get_business_adress.php",
   		data: "type="+0,
   		success: function(msg){
   			var t1=msg.split('#');
   			for(var k=0;k<t1.length;k++) {
   				var chunk = t1[k].split('%');
   				var id_type = chunk[0];
   				var records = chunk[1].split('_');
   				var t_elt = new Array();
   				for(var j=0; j<records.length; j++) {
   					var elt= records[j].split('|');
   					var point = elt[0].split(',');
   					var icon = new GIcon(G_DEFAULT_ICON,"image/marker/"+tab_icon[k]);
   					icon.iconSize=new GSize(32,32);
   					var marker = new GMarker(new GLatLng(point[0],point[1]),icon);
   					
   					//alert('<b>'+elt[1]+'</b><br>'+elt[2]+'<br>'+elt[5]);
   					/*
   					GEvent.addListener(marker, "click", function() {
          				marker.openInfoWindowHtml('<b>'+elt[1]+'</b><br>'+elt[2]+'<br>'+elt[5]);
        			});
        			map.addOverlay(marker);
        			*/
   					t_elt.push(new Array(marker,elt[1]));
   				}
   				
   				markTab.push(new Array(id_type,t_elt));
   			}
   		}
 });
}
function action_business_type(type,onoff){
	for(var k=0;k<markTab.length;k++) {
		if (markTab[k][0]==type) {
			for(var i=0;i< markTab[k][1].length;i++) {
				if (onoff==true) {
					map.addOverlay(markTab[k][1][i][0]);
				}
				else
					map.removeOverlay(markTab[k][1][i][0]);
			}
		}
	}
}
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
		<div id="control" style="float:left;width:200px;height:478px;padding-left:10px;padding-top:10px;border:1px solid black;margin-right:2px;text-align:left">
			<?php 
			$t=getTypes();
			foreach($t as $k=>$v) {?>
			<div style="height:30;">
				<input type="checkbox" onchange="action_business_type(<?php echo $k?>,this.checked)"> <?php echo $v?>
			</div>
			<?php } ?>
		</div>
		<div id="map" style="width: 624px; height: 488px;float:left;border:1px solid black"></div>

		</div>
	</div>
	<div id="body_right">
		<?php include("page/body_right.php"); ?>
	</div>


<div style="clear: left;">
</div>
<div id="footer">
	<?php include("page/footer.php"); ?>
</div>

</div>

</html>