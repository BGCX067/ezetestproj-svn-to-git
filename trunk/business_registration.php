<?php session_start(); include("db.php");
	$photo="image/business.jpg";
	if (isset($_SESSION["photo"])&&strlen($_SESSION["photo"])>0)
		$photo=$_SESSION["photo"];
	else
		$_SESSION["photo"]="image/business.jpg";

list($pict_width, $pict_height, $type, $attr) = getimagesize($photo);
//die($pict_width."-".$pict_height);
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
	$erreur_code="";
	
	//data sent with the form
	$post_name=isset($_SESSION["post_name"])?$_SESSION["post_name"]:stripslashes($_POST["name"]);
	$post_name=(strlen($_POST["name"])>0)?stripslashes($_POST["name"]):$_SESSION["post_name"];
	$post_email=isset($_SESSION["post_email"])?$_SESSION["post_email"]:$_POST["email"];
	$post_email=(strlen($_POST["email"])>0)?stripslashes($_POST["email"]):$_SESSION["post_email"];
	$post_website=isset($_SESSION["post_website"])?$_SESSION["post_website"]:$_POST["website"];
	$post_pwd=isset($_SESSION["post_pwd"])?$_SESSION["post_pwd"]:$_POST["pwd"];
	$post_pwd2=isset($_SESSION["post_pwd2"])?$_SESSION["post_pwd2"]:$_POST["pwd2"];
	$post_type=isset($_SESSION["post_type"])?$_SESSION["post_type"]:$_POST["type"];
	$post_type=(strlen($_POST["type"])>0)?stripslashes($_POST["type"]):$_SESSION["post_type"];
	$post_description=isset($_SESSION["post_description"])?$_SESSION["post_description"]:stripslashes($_POST["description"]);
	$post_description=(strlen($_POST["description"])>0)?stripslashes(substr($_POST["description"],0,512)):$_SESSION["post_description"];
	$post_adress1=isset($_SESSION["post_adress1"])?$_SESSION["post_adress1"]:$_POST["adress1"];
	$post_adress1=(strlen($_POST["adress1"])>0)?stripslashes($_POST["adress1"]):$_SESSION["post_adress1"];
	$post_adress2=isset($_SESSION["post_adress2"])?$_SESSION["post_adress2"]:$_POST["adress2"];
	$post_adress2=(strlen($_POST["adress2"])>0)?stripslashes($_POST["adress2"]):$_SESSION["post_adress2"];
	$post_city=isset($_SESSION["post_city"])?$_SESSION["post_city"]:$_POST["city"];
	$post_city=(strlen($_POST["city"])>0)?stripslashes($_POST["city"]):$_SESSION["post_city"];
	$post_postcode=isset($_SESSION["post_postcode"])?$_SESSION["post_postcode"]:$_POST["postcode"];
	$post_postcode=(strlen($_POST["postcode"])>0)?stripslashes($_POST["postcode"]):$_SESSION["post_postcode"];
	$post_state=isset($_SESSION["post_state"])?$_SESSION["post_state"]:$_POST["state"];
	//$post_state=(strlen($_POST["post_state"])>0)?stripslashes($_POST["state"]):$_SESSION["post_state"];
	$post_country=isset($_SESSION["post_country"])?$_SESSION["post_country"]:$_POST["country"];
	//$post_country=(strlen($_POST["post_country"])>0)?stripslashes($_POST["country"]):$_SESSION["post_country"];
	$post_securitycode=$_POST["securitycode"];
	
	if (isset($_POST["name"])) {
		if ($_POST["submit_hidden"]=="0") {
			$photo = 'uploads/'.time().'_'.$_FILES['photo']['name'];
			move_uploaded_file ($_FILES['photo'] ['tmp_name'], $photo);
			
			list($pict_width, $pict_height, $type, $attr) = getimagesize($photo);
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
			
			$_SESSION["photo"]=$photo;
		} else {
			if ($_POST["securitycode"]!=$_SESSION["security_code"])
				$erreur_code = "The security code must match the picture. Please type it again";
			else {
				$_SESSION["post_name"]=$post_name;
				$_SESSION["post_email"]=$post_email;
				$_SESSION["post_website"]=(substr($post_website,0,4)=='http'?'':'http://').$post_website;
				$_SESSION["post_pwd"]=$post_pwd;
				$_SESSION["post_pwd2"]=$post_pwd2;
				$_SESSION["post_type"]=$post_type;
				$_SESSION["post_description"]=$post_description;
				$_SESSION["post_adress1"]=$post_adress1;
				$_SESSION["post_adress2"]=$post_adress2;
				$_SESSION["post_city"]=$post_city;
				$_SESSION["post_postcode"]=$post_postcode;
				$_SESSION["post_state"]=$post_state;
				$_SESSION["post_country"]=$post_country;
				header("location: business_preview.php");	
			}
		}
		
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/<?php echo 'style2.css'.'?sc=time()'; ?>" />
 <link rel="stylesheet" type="text/css" href="css/flora/flora.all.css" media="screen" title="Flora (Default)">
 <script src="js/jquery_pack.js" type="text/javascript"></script>
 <script src="js/jquery.filestyle.js" type="text/javascript"></script>
 <script src="js/jquery-uimin.js" type="text/javascript"></script>
 <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=ABQIAAAAO3vyA9-J2HtYx8z0ijrJWRS9lLkoXtpwtfSnzgidPx_e40AwcRRR2o95tA519PUYn5UuSHDE_VlrcQ" type="text/javascript"></script>
 
 <script type="text/javascript">
 	var geocoder = null;
 	
 	// ====== Array for decoding the failure codes ======
      var reasons=[];
      reasons[G_GEO_SUCCESS]            = "Success";
      reasons[G_GEO_MISSING_ADDRESS]    = "Missing Address: The address was either missing or had no value.";
      reasons[G_GEO_UNKNOWN_ADDRESS]    = "Unknown Address:  No corresponding geographic location could be found for the specified address.";
      reasons[G_GEO_UNAVAILABLE_ADDRESS]= "Unavailable Address:  The geocode for the given address cannot be returned due to legal or contractual reasons.";
      reasons[G_GEO_BAD_KEY]            = "Bad Key: The API key is either invalid or does not match the domain for which it was given";
      reasons[G_GEO_TOO_MANY_QUERIES]   = "Too Many Queries: The daily geocoding quota for this site has been exceeded.";
      reasons[G_GEO_SERVER_ERROR]       = "Server error: The geocoding request could not be successfully processed.";
      
      // ====== Geocoding ======
      function checkAdress2(search) {
      	if (geocoder)     
        geocoder.getLocations(search, function (result)
          { 
            // If that was successful
            if (result.Status.code == G_GEO_SUCCESS) {
              // How many resuts were found
              for (var i=0; i<result.Placemark.length; i++) {
                //var p = result.Placemark[i].Point.coordinates;
                //var marker = new GMarker(new GLatLng(p[1],p[0]));
                //document.getElementById("message").innerHTML += "<br>"+(i+1)+": "+ result.Placemark[i].address + marker.getPoint();
                //map.addOverlay(marker);
              }
              // centre the map on the first result
              //var p = result.Placemark[0].Point.coordinates;
              //map.setCenter(new GLatLng(p[1],p[0]),14);
              saveGeoadressInSession(result.Placemark[0].Point.coordinates[0],result.Placemark[0].Point.coordinates[1],result.Placemark[0].adress);
              //alert(result.Placemark[0].adress);
            }
            // ====== Decode the error status ======
            else {
              var reason="Code "+result.Status.code;
              if (reasons[result.Status.code]) {
                reason = reasons[result.Status.code]
              } 
              alert('Could not find "'+search+ '" ' + reason);
            }
          }
        );
      }
 	
    $(document).ready(function(){
    	$("input[type=file]").filestyle({ 
    		image: "image/choose_file.gif",
    		imageheight : 22,
    		imagewidth : 82,
    		width : 116
		});
		if (''!='<?php echo $erreur_code; ?>') $('#example').tabs().tabs('select', 1);
		
		$("input[@type=file]").change(function(){
			/*
			var s = $("#photo").val();
			$("#photo").val = s;
			*/
			$("#submit_hidden").val('0');
			$("#businessform").submit();
		});
		$("#example > ul").tabs();
		
		$("#next_btn").click(function(){
    		return false;
		});
		
		$('#example').tabs({
    	select: function(e, ui) {
    		var error='';
        	if (ui.panel.id == 'step2') {
        		error = checkStep1();
        	}
        	displayError(error);
        	return (error=='');
    	}
		});
		
		$("#btn_preview").click(function(){
    		var error='';
        	error = checkStep2();
        	displayError2(error);
        	if (error=='') {
        		$("#submit_hidden").val('1');
        		checkAdress2($("#adress1").val()+' '+$("#postcode").val()+' '+$("#city").val());
        		//$("#businessform").submit();
        	}
		});
		
		initialize();

 	});
 	
 	function initialize() {
      if (GBrowserIsCompatible()) {  
        geocoder = new GClientGeocoder();
      }
    }
    
    function checkAdress(address) {
      if (geocoder) {
        geocoder.getLatLng(
          address,
          function(point) {
            if (!point) {
              alert('the adress you entered: '+address + " was not found");
            } else {
            	saveGeoadressInSession(point.lng,point.lat);	
            }
          }
        );
      }
    }
    
    function saveGeoadressInSession(x,y,a) {
    	$.ajax({
   		type: "POST",
   		url: "ajax/save_geoadress_insession.php",
   		data: "x="+x+"&y="+y+'&a='+a,
   		success: function(msg){
   			//alert('x,y: '+x+','+y);
   			$("#submit_hidden").val('1');
            $("#businessform").submit();
   		}
 		});
    }
 	
 	function checkStep1() {
 		var error='';
 		if ($("#email").val()=='') error='Please enter your email adress';
 		else if (!checkEmail($("#email").val())) error='The email you entered is incorrect (should be like name@example.com)';
 		else if ($("#pwd").val()=='') error='Please enter your password';
 		else if ($("#pwd2").val()=='') error='Please confirm your password';
 		else if ($("#pwd2").val()!=$("#pwd").val()) error='Your password and your confirmation password are not the same';
 		else if ($("#name").val()=='') error='Please enter your business name';
 		return error;
 	}
 	function checkStep2() {
 		var error='';
 		if ($("#adress1").val()=='') error='Please enter your adress in line 1';
 		else if ($("#city").val()=='') error='Please enter your city';
 		else if ($("#postcode").val()=='') error='Please enter your post code';
 		else if ($("#securitycode").val()=='') error='Please enter the security code';
 		return error;
 	}
 	
 	function displayError(msg) {
     	$("#error_step1").html('<span style="color:red">'+msg+'</span>');
 	}
 	function displayError2(msg) {
     	$("#error_step2").html('<span style="color:red">'+msg+'</span>');
 	}
 	
 	function checkEmail(email) {
   		var reg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]{2,}[.][a-z]{2,3}$/
   		return (reg.exec(email)!=null)
	}
 	
 </script>
 
</head>

<body>

<div id="content">

<div id="header">
	<?php include("page/header.php"); ?>
</div>

<div id="menu">
	<?php include("page/menubar.php"); ?>
</div>

<div id="body">
<div id="body_content">

<div style="text-align:left;margin-bottom:14px;margin-top:10px;">Business registration :</div>
<form name="businessform" id="businessform" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">
<input type="hidden" id="submit_hidden" name="submit_hidden">

<div id="example" class="flora">
            <ul>
                <li><a href="#step1"><span>Step 1</span></a></li>
                <li><a href="#step2"><span>Step 2</span></a></li>
            </ul>
<div id="step1" style="border:1px solid black;background-color:#f9f9f9;min-height:330px;">

<div style="height:26px;text-align:center;" id="error_step1">
</div>
<div class="form" style="margin-right:1px;margin-left:18px;width:214px;margin-top:10px;">
	<div class="form_row" >
		<div style="width:200px;height:200px;">
			<img width="<?php echo $pict_width?>" height="<?php echo $pict_height?>" src="<?php echo $photo ?>"></img>
		</div>
	</div>

	<div class="form_row" style="padding-bottom:0px">
		<div class="form_tdlabel" style="text-align:left;">
			<input id="photo" name="photo" type="file" style="width:70px;border:1px solid pink;border-style:none;" size="15">
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<br><br><br>
</div>

<div class="form" style="margin-right:1px;margin-left:0px;">
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;padding-top:20px;">
		<div class="form_tdlabel">
			<label>Email address (will&nbsp;be&nbsp;your&nbsp;login)&nbsp;:</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" id="email" name="email" value="<?php echo $post_email?>">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Password :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="password" id="pwd" name="pwd" value="<?php echo $post_pwd?>" autocomplete="off">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Confirm password :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="password" id="pwd2" name="pwd2" value="<?php echo $post_pwd?>" autocomplete="off">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Business name :</label>
		</div>
		<div class="form_tdinput">	
			<input class="form_input" type="text" name="name" id="name" value="<?php echo $post_name?>">
		</div>
		<div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Website :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" id="website" name="website" value="<?php echo $post_website?>">
		</div>
	</div>
	
	<div style="clear: right;"></div>
</div>


<div class="form" style="margin-right:0px;margin-left:50px;width:212px;margin-top:22px;">
	<div style="height:140px;">
	<div style="clear: right;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel" style="text-align:left;">
			<label>Business type :</label>
		</div>
		<div style="clear: right;"></div><div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:10px;margin-bottom:0px;">
		<div style="text-align:left;">
			<select class="form_input" style="width: 140px;float:left" name="type" id="type">
			<?php
				$t=getTypes();
				foreach($t as $k=>$v)
					echo "<option value=$k ".((($post_type==''&&$v=='Restaurant')||(("'".$post_type."'"==$k)))?"selected":"").">".$v."</option>";
			?>
			</select>
		</div>
		<div style="clear: right;"></div><div style="clear: left;"></div>
	</div>
	<div class="form_row" style="padding-bottom:0px">
		<div class="form_tdlabel" style="text-align:left;">
			<label>Business description :</label>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<br>
	<div class="form_row" style="padding-bottom:0px">
		<div class="form_tdlabel" style="text-align:left;">
			<textarea rows="6" cols="26" name="description" id="description"><?php echo $post_description?></textarea>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	</div>
	<div style="text-align:right;">

		

	</div>
</div>

<div style="clear: left;"></div>


<div style="height:30px;">
	<div style="float:left">
		
	</div>
	<div style="float:right">
		<img onclick="$('#example').tabs().tabs('select', 1);return false;" style="border:0;cursor:pointer" id="btn_next" style="cursor:pointer" src="image/button_1.gif" onmouseover="getElementById('btn_next').src='image/button_0.gif';" onmouseout="getElementById('btn_next').src='image/button_1.gif';"></img>
	</div>
	<div style="clear: left;"></div>
	<div style="clear: right;"></div>
</div>
                             
</div>




<div id="step2" style="border:1px solid black;background-color:#f9f9f9;margin-bottom:60px;min-height:330px;">


<div style="height:26px;" id="error_step2">
<span style="color:red"><?php echo $erreur_code; ?></span>
</div>



<div class="form" style="margin-right:0px;margin-left:90px;width:300px;margin-top:0px;">
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Address line 1 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" name="adress1" id="adress1" value="<?php echo $post_adress1?>">
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Address line 2 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" name="adress2" id="adress2" value="<?php echo $post_adress2?>">
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>City :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" name="city" id="city" value="<?php echo $post_city?>">
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Post code :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" name="postcode" id="postcode" value="<?php echo $post_postcode?>">
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>State :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="state" id="state">
			<?php
				$t=getStates();
				foreach($t as $k=>$v)
					echo "<option value=$k ".((($post_state==''&&$v=='New South Wales')||(("'".$post_state."'"==$k)))?"selected":"").">".$v."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
	<div class="form_row" style="margin-top:20px;">
		<div class="form_tdlabel">
			<label>Country :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="country" id="country">
			<?php
				$t=getCountries();
				foreach($t as $k=>$v)
					echo "<option value=$k ".((($post_country==''&&$v=='Australia')||(("'".$post_country."'"==$k)))?"selected":"").">".$v."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div><div style="clear: left;"></div>
</div>

<div class="form" style="margin-right:0px;margin-left:100px;width:222px;margin-top:20px;">
	
	<div class="form_row" style="padding-bottom:10px">
		<br><br><br><br><br><br><br><br><br>
		<div class="form_tdlabel" style="font-size:11px;text-align:left;">
			<label>Security Code:</label>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" style="padding-bottom:38px">
		<div class="form_tdlabel" style="text-align:left;">
			<img src="CaptchaSecurityImages.php"/>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row" >
		<div class="form_tdlabel" style="text-align:left;">
			<input type="text" size="8" name="securitycode" id="securitycode" value="<?php echo $post_securitycode?>"/>
		</div>
		<div class="form_tdinput">
			
		</div>	
	</div>
	<div style="clear: left;"></div>
	<div style="clear: right;"></div>
</div>


<div style="clear: left;"></div>

<div style="height:30px;margin-top:22px;">
	<div style="float:left">
		<img onclick="$('#example').tabs().tabs('select', 0);return false;" style="border:0;cursor:pointer" id="btn_back" src="image/btn_back_1.gif" onmouseover="getElementById('btn_back').src='image/btn_back_0.gif';" onmouseout="getElementById('btn_back').src='image/btn_back_1.gif';"></img>
	</div>
	<div style="float:right">
		<img style="border:0;cursor:pointer" id="btn_preview" src="image/btn_preview_1.gif" onmouseover="getElementById('btn_preview').src='image/btn_preview_0.gif';" onmouseout="getElementById('btn_preview').src='image/btn_preview_1.gif';"></img>
	</div>
	<div style="clear: left;"></div>
	<div style="clear: right;"></div>
</div>

</div>





</div>

</form>	
		
		
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
