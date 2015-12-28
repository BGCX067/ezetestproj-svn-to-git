
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Google Maps Example 1</title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ"
 type="text/javascript"></script>
</head>
<body>
<div id="map" style="width: 500px; height: 400px"></div>
<script type="text/javascript">
       //<![CDATA[

       // create the instance of GMap
       var map = new GMap2(document.getElementById("map"));
       map.addControl(new GSmallMapControl());
       // Output Longitude and Latitude to center and set initial starting point of the map
       map.setCenter(new GLatLng(-33.86678, 151.20436), 14);
       map.addOverlay(new GMarker(new GLatLng(-33.8734, 151.2085)));
       
         var icon2 = new GIcon();
                icon2.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
                icon2.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
                icon2.iconSize = new GSize(12, 20);
                icon2.shadowSize = new GSize(22, 20);
                icon2.iconAnchor = new GPoint(6, 20);
                icon2.infoWindowAnchor = new GPoint(5, 1);
          var point = new GLatLng(-33.8793, 151.22);
       //map.addOverlay(new GMarker(point, icon2));
       var texte = "281 Elizabeth St"
       function createMarker(point, texte, icon2)
                {
                 var marker = new GMarker(point, icon2);
                 map.addOverlay(marker);
                 GEvent.addListener(marker, "click", function() {
                           marker.openInfoWindowHtml(texte);
                 });
                }
       
                createMarker(point, "<img src=/image/logo.jpg>", icon2);

       //]]>
</script>
</body>
</html>









<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
 <title>Google Maps Experiences</title>
<link rel="stylesheet" type="text/css" href="css/<?php echo "style2.css"."?sc=time()" ?>" />
 
 <script src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=fr&amp;s=AARTsJpTxOO4-nAB0XjI6t62zmULyG5xZQ&amp;msa=0&amp;msid=103785996782753360112.00045d5b63bf0e037ae89&amp;ll=-33.872553,151.20801&amp;spn=0.012471,0.018239&amp;z=15&amp;output=embed"
 type="text/javascript"></script>

 <script type="text/javascript">
 /*
 function load(){
      if (GBrowserIsCompatible()) {
        var map = new GMap2(document.getElementById("MapContainer"));
        map.setCenter(new GLatLng(-33.86678, 151.20436), 8);
        map.addOverlay(new GMarker(new GLatLng(-33.8734, 151.2085)));
        map.enableScrollWheelZoom();
		map.addMapType(G_PHYSICAL_MAP);
  }
}

  <iframe width="425" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=fr&amp;s=AARTsJpTxOO4-nAB0XjI6t62zmULyG5xZQ&amp;msa=0&amp;msid=103785996782753360112.00045d5b63bf0e037ae89&amp;ll=-33.872553,151.20801&amp;spn=0.012471,0.018239&amp;z=15&amp;output=embed"></iframe>  

*/
	</script>

</head>

<body onload="load()" onunload="GUnload()">

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
	<iframe width="425" height="350" frameborder="1" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps/ms?ie=UTF8&amp;hl=fr&amp;s=AARTsJpTxOO4-nAB0XjI6t62zmULyG5xZQ&amp;msa=0&amp;msid=103785996782753360112.00045d5b63bf0e037ae89&amp;ll=-33.872553,151.20801&amp;spn=0.012471,0.018239&amp;z=15&amp;output=embed"
></iframe>  
	<div id="map" style="width: 550px; height: 450px"></div>
	<script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 

      // A function to create the marker and set up the event window
      // Dont try to unroll this function. It has to be here for the function closure
      // Each instance of the function preserves the contends of a different instance
      // of the "marker" and "html" variables which will be needed later when the event triggers.    
      function createMarker(point,html) {
        var marker = new GMarker(point);
        GEvent.addListener(marker, "click", function() {
          marker.openInfoWindowHtml(html);
        });
        return marker;
      }

      // Display the map, with some controls and set the initial location 
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GLargeMapControl());
      map.addControl(new GMapTypeControl());
      map.setCenter(new GLatLng(43.907787,-79.359741),8);
    
      // Set up three markers with info windows 
    
      var point = new GLatLng(-33.8734, 151.2085);
      var marker = createMarker(point,'<div style="width:240px">First Info Window. With a <a href="http://www.apple.com">Link<\/a><\/div>')
      map.addOverlay(marker);
    }	
    </script>	
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
