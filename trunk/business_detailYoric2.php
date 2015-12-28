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
<link rel="stylesheet" type="text/css" href="css/<?php echo "jqModal.css"."?sc=time()" ?>" />
<link rel="stylesheet" type="text/css" href="css/<?php echo "galleria.css"."?sc=time()" ?>" />
<script src="js/jquery_pack.js" type="text/javascript"></script>
<script src="js/jquery.jqModal.js" type="text/javascript"></script>
<script src="js/jquery.galleria.js" type="text/javascript"></script>

<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ"
            type="text/javascript"></script>
    <script type="text/javascript">



 $(document).ready(function(){
 	
 	var html='<div style="padding:5px;width:750;height:500;">tadada tada<br>tadada tadatadada tada<br><img width="700" height="438" src="http://monc.se/galleria/demo/img/sea-mist.jpg"><br>tadada tadatadada tada<br></div>';
 	
 	$('.gallery_demo_unstyled').addClass('gallery_demo'); // adds new class name to maintain degradability
		
		$('ul.gallery_demo').galleria({
			history   : true, // activates the history object for bookmarking, back-button etc.
			clickNext : true, // helper for making the image clickable
			insert    : '#main_image', // the containing selector for our main image
			onImage   : function(image,caption,thumb) { // let's add some image effects for demonstration purposes
				
				// fade in the image & caption
				if(! ($.browser.mozilla && navigator.appVersion.indexOf("Win")!=-1) ) { // FF/Win fades large images terribly slow
					image.css('display','none').fadeIn(1000);
				}
				caption.css('display','none').fadeIn(1000);
				
				// fetch the thumbnail container
				var _li = thumb.parents('li');
				
				// fade out inactive thumbnail
				_li.siblings().children('img.selected').fadeTo(500,0.3);
				
				// fade in active thumbnail
				thumb.fadeTo('fast',1).addClass('selected');
				
				// add a title for the clickable image
				image.attr('title','Next image >>');
			},
			onThumb : function(thumb) { // thumbnail effects goes here
				
				// fetch the thumbnail container
				var _li = thumb.parents('li');
				
				// if thumbnail is active, fade all the way.
				var _fadeTo = _li.is('.active') ? '1' : '0.3';
				
				// fade in the thumbnail when finnished loading
				thumb.css({display:'none',opacity:_fadeTo}).fadeIn(1500);
				
				// hover effects
				thumb.hover(
					function() { thumb.fadeTo('fast',1); },
					function() { _li.not('.active').children('img').fadeTo('fast',0.3); } // don't fade out if the parent is active
				)
			}
		});
		
 	
 	});

    </script>
    
    <style media="screen,projection" type="text/css">
	
	/* BEGIN DEMO STYLE */
	*{margin:0;padding:0}
	//body{padding:20px;background:white;text-align:center;background:black;color:#bba;font:80%/140% georgia,serif;}
	h1,h2{font:bold 80% 'helvetica neue',sans-serif;letter-spacing:3px;text-transform:uppercase;}
	a{color:#348;text-decoration:none;outline:none;}
	a:hover{color:#67a;}
	.caption{font-style:italic;color:#887;}
	.demo{position:relative;margin-top:2em;}
	.gallery_demo{width:702px;margin:0 auto;}
	.gallery_demo li{width:68px;height:50px;border:3px double #111;margin: 0 2px;background:#000;}
	.gallery_demo li div{left:240px}
	.gallery_demo li div .caption{font:italic 0.7em/1.4 georgia,serif;}
	
	#main_image{margin:0 auto 60px auto;height:438px;width:700px;background:black;}
	#main_image img{margin-bottom:10px;}
	
	.nav{padding-top:15px;clear:both;font:80% 'helvetica neue',sans-serif;letter-spacing:3px;text-transform:uppercase;}
	
	.info{text-align:left;width:700px;margin:30px auto;border-top:1px dotted #221;padding-top:30px;}
	.info p{margin-top:1.6em;}
	
    </style>
    
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
<div id="body_content" style="background-color:black;">

<ul class="gallery_demo_unstyled">

    <li><img src="image/galleria/1.jpg" alt="Flowing Rock" title="Flowing Rock Caption"></li>
    <li><img src="image/galleria/2.jpg" alt="Stones" title="Stones - from Apple images"></li>
    <li class="active"><img src="image/galleria/3.jpg" alt="Grass Blades" title="Apple nature desktop images"></li>
    <li><img src="image/galleria/4.jpg" alt="Ladybug" title="Ut rutrum, lectus eu pulvinar elementum, lacus urna vestibulum ipsum"></li>
    <li><img src="image/galleria/5.jpg" alt="Lightning" title="Black &amp; White"></li>
    <li><img src="image/galleria/6.jpg" alt="Lotus" title="Fusce quam mi, sagittis nec, adipiscing at, sodales quis"></li>
    <li><img src="image/galleria/7.jpg" alt="Mojave" title="Suspendisse volutpat posuere dui. Suspendisse sit amet lorem et risus faucibus pellentesque."></li>
    <li><img src="image/galleria/8.jpg" alt="Pier" title="Proin erat nisi"></li>
    <li><img src="image/galleria/9.jpg" alt="Sea Mist" title="Caption text from title"></li>

</ul>
<p class="nav"><a href="#" onclick="$.galleria.prev(); return false;">&laquo; previous</a> | <a href="#" onclick="$.galleria.next(); return false;">next &raquo;</a></p>

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

