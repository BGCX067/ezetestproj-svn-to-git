<?php session_start(); include("db.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/<?php echo "style2.css"."?sc=time()" ?>" />
<script src="js/jquery_pack.js" type="text/javascript"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ" type="text/javascript"></script>
 
  <script src="http://jquery.com/src/jquery.js"></script>
	<script>
	$(document).ready(function(){
		$("dd:not(:first)").hide();
		$("dt a").click(function(){
			$("dd:visible").slideUp("def");
			$(this).parent().next().slideDown("slow");
			return false;
		});
	});
	</script>
	<style>
	body { font-family: Arial; font-size: 12px; }
	dl { width: 190px; }
	dl,dd { margin: 0; }
	dt { background: #F39; font-size: 14px; padding: 5px; margin: 2px; }
	dt a { color: #FFF; }
	dd { width: 190px; background: #BEBE; padding: 5px; margin: 2px; }
	dd a { color: #000; }
	ul { list-style: none; padding: 5px; }
	</style>
	
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
 	create_all_marker();
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
  function createMarker(point,html,icon) {
        var marker = new GMarker(point,icon);
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        return marker;
      }
      
function create_all_marker() {
	var tab_icon = new Array('red-dot.png','blue-dot.png','green-dot.png','orange-dot.png','pink-dot.png','purple-dot.png','yellow-dot.png','brown-dot.png','lightgray-dot.png','lightblue-dot.png');
	$.ajax({
   		type: "POST",
   		url: "ajax/get_business_adress.php",
   		data: "type="+0,
   		success: function(msg){
   			var t1=msg.split('#');
   			for(var k=0;k<t1.length;k++) {
   				var chunk = t1[k].split('%');
   				var id_type = chunk[0];
   				var records = chunk[1].split('£');
   				var t_elt = new Array();
   				for(var j=0; j<records.length; j++) {
   					var elt= records[j].split('|');
   					var point = elt[0].split(',');
   					var icon = new GIcon(G_DEFAULT_ICON,"image/marker/"+tab_icon[k]);
   					icon.iconSize=new GSize(32,32);
   					var photoinfo = elt[6].split('(');
var width = 216;
if (photoinfo[1]>216) width=photoinfo[1];
htmlcode = '<div style="font-size:16px;font-weight:bold">'+elt[1]+'</div>'
			+'<div style="font-size:11px;">'+elt[2]+'<br>'
			+elt[4]+'-'+elt[5]+'</div><hr>'
			+'<img src=photo_business/1/'+photoinfo[0]+' width='+photoinfo[1]+' height='+photoinfo[2]+'>'
			+'<div style="font-size:10px;width:'+width+'px"><div style="float:left;width:50px;"><a target="_blank" href="business_detail.php?b='+elt[8]+'">profile</a></div><div style="float:right;width:50px;"><a target="_blank" href="'+elt[7]+'">'+'website'+'</a></div></div>';
   					t_elt.push(new Array(createMarker(new GLatLng(point[0],point[1]),htmlcode,icon),elt[1]));
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
		<div id="control" style="float:left;width:200px;height:478px;padding-left:10px;padding-top:10px;border:1px solid black;margin-right:2px;text-align:left;background-color:#F2F2F2">
			
			<?php 
			$tab=getTypesMike();
			
			foreach($tab as $id=>$v) { ?>
			<div style="height:20;">
				<dl>
				<?php 
				if ($tab[$id][1] == 0){?>
					<dt><input type="checkbox" onchange="action_business_type(<?php echo $id?>,this.checked)"/> <a href="#"><?php echo $tab[$id][0]?></a></dt>
					<?php
					$tab1=getTypesMike(); ?>
					<dd>
					
					<?php
					foreach($tab1 as $id1=>$v1) {
						if ($id == "'".$tab1[$id1][1]."'"){?>
						<ul>
						<li><input style='margin-left: 20px' type="checkbox"/><a href="#"><?php echo $tab1[$id1][0]?></a></li>
						</ul>
						<?php }} ?>
					
					</dd>
				<?php } ?>
				</dl>
			</div>
			<?php } ?>
	
		</div>
		<div id="map" style="width: 682px; height: 488px;float:left;border:1px solid black"></div>

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
</body>
</html>	





