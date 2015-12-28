<?php session_start(); include("db.php");
	$photo="image/avatar_profile.jpg";
	$erreur_code="";
	
	//data sent with the form
	$post_name=$_POST["name"];
	$post_email=$_POST["email"];
	$post_website=$_POST["website"];
	$post_pwd=$_POST["pwd"];
	$post_type=$_POST["type"];
	$post_description=$_POST["description"];
	$post_adress1=$_POST["adress1"];
	$post_adress2=$_POST["adress2"];
	$post_city=$_POST["city"];
	$post_postcode=$_POST["postcode"];
	$post_state=$_POST["state"];
	$post_country=$_POST["country"];
	$post_securitycode=$_POST["securitycode"];
	
	if (isset($_POST["name"])) {
		if ($_POST["submit_hidden"]=="0") {
			move_uploaded_file ($_FILES['photo'] ['tmp_name'], "uploads/{$_FILES['photo'] ['name']}");
			$photo = "uploads/{$_FILES['photo'] ['name']}";
		} else {
			if ($_POST["securitycode"]!=$_SESSION["security_code"])
				$erreur_code = "The security code must match the picture. Please type it again";
			else
				header("location: business_preview.php");
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
 <script src="js/jquery_ui.js" type="text/javascript"></script>
 
 <script type="text/javascript">
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
        		$("#businessform").submit();
        	}
		});

 	});
 	
 	function checkStep1() {
 		var error='';
 		if ($("#name").val()=='') error='Please enter your business name';
 		else if ($("#email").val()=='') error='Please enter your business email';
 		else if (!checkEmail($("#email").val())) error='The email you entered is incorrect (should be like name@example.com)';
 		else if ($("#pwd").val()=='') error='Please enter your password';
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
   		var reg = /^[a-z0-9._-]+@[a-z0-9.-]{2,}[.][a-z]{2,3}$/
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
		<div style="width:200px;height:200px;border:1px solid black;">
			<img width="200" height="200" src="<?php echo $photo ?>"></img>
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
	<div class="form_row" style="padding-top:20px;margin-top:20px;">
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
			<label>Email address :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" id="email" name="email" value="<?php echo $post_email?>">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Website :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text" id="website" name="website" value="<?php echo $post_website?>">
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
			<label>Business type :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="type" id="type">
			<?php
				$t=getTypes();
				foreach($t as $k=>$v)
					echo "<option value=$k ".((($post_type==''&&$v=='Restaurant')||(("'".$post_type."'"==$k)))?"selected":"").">".$v."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div>
</div>


<div class="form" style="margin-right:0px;margin-left:50px;width:212px;margin-top:82px;">
	<div style="height:140px;">
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
			<select class="form_input" style="width: 140px;" name="text">
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
			<select class="form_input" style="width: 140px;" name="text">
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

</html>
</body>