<?php include("db.php");
	$photo="image/avatar_profile.jpg";
	if (isset($_POST["name"])) {
		move_uploaded_file ($_FILES['photo'] ['tmp_name'], "uploads/{$_FILES['photo'] ['name']}");
		$photo = "uploads/{$_FILES['photo'] ['name']}";
    }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
 <link rel="stylesheet" type="text/css" href="css/<?php echo 'style2.css'.'?sc=time()'; ?>" />
 <script src="js/jquery_pack.js" type="text/javascript"></script>
 <script src="js/jquery.filestyle.js" type="text/javascript"></script>
 
 <script type="text/javascript">
    $(document).ready(function(){
    	$("input[type=file]").filestyle({ 
    		image: "image/choose_file.gif",
    		imageheight : 22,
    		imagewidth : 82,
    		width : 116
		});
		$("input[@type=file]").change(function(){
			/*
			var s = $("#photo").val();
			$("#photo").val = s;
			*/
			$("#businessform").submit();
		});
 	});
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
	<br>
<form name="businessform" id="businessform" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" enctype="multipart/form-data">

<div style="width:854px;margin-left:auto;margin-right:auto;">
<div style="float:left;width:8px;height:400px;">
	<div style="width:8px;height:36px;">
		<img src="http://ezemeet.copops.com/image/corner_topleft.gif">
	</div>
	<div style="width:8px;height:356px;border-left:1px solid #b3b3b3">
		
	</div>
	<div style="width:8px;height:8px;">
		<img src="http://ezemeet.copops.com/image/corner_bottomleft.gif">
	</div>
</div>

<div style="float:left;width:824px;height:400px;">
<div style="width:824px;height:34px;background-color: #fed8e9;border-top: 1px solid #b3b3b3;border-bottom: 1px solid #b3b3b3;">
	<div style="margin-top:2px;">
		<span style="font-size:13px;color:#333;">Business registration</span>
	</div>
	<div style="text-align:center;color:red">
		<span style="font-size:12px;">Please fill in all the fields below, then click "Preview" button.</span>
	</div>
</div>
	
<div style="width:824px;height:347px;">
<div class="form" style="margin-right:1px;">
	<div class="form_row" style="padding-top:20px">
		<div class="form_tdlabel">
			<label>Business name :</label>
		</div>
		<div class="form_tdinput">	
			<input class="form_input" type="text" name="name">
		</div>
		<div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Business type :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text">
			<?php
				$t=getTypes();
				foreach($t as $e)
					echo "<option ".(($e=="Restaurant")?"selected":"").">".$e."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Address line 1 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Address line 2 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Country :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text">
			<?php
				$t=getCountries();
				foreach($t as $e)
					echo "<option>".$e."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>State :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text">
			<?php
				$t=getStates();
				foreach($t as $e)
					echo "<option ".(($e=="New south wales")?"selected":"").">".$e."</option>";
			?>
			</select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>City :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Post code :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Website :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>Email address :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
</div>
<div class="form" style="margin-right:1px;margin-left:58px;width:214px">
	<div class="form_row" >
		<div style="width:200px;height:200px;border:1px solid black;">
			<img width="200" height="200" src="<?php echo $photo ?>"></img>
		</div>
	</div>
	<div class="form_row" style="padding-bottom:12px" style="padding-top:0px">
		<div class="form_tdinput">
			&nbsp;
		</div>
	</div>
	<br>
	<div class="form_row" style="padding-bottom:42px">
		<div class="form_tdlabel" style="text-align:left;">
			<input id="photo" name="photo" type="file" style="width:70px;border:1px solid pink;border-style:none;" size="15">
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	
	
	
</div>
<div class="form" style="margin-right:0px;margin-left:50px;width:222px">
	<div style="height:320px;">
		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<div class="form_row" style="padding-bottom:10px">
		<div class="form_tdlabel" style="font-size:11px;text-align:left;">
			<label>Security Code:</label>
		</div>
		<div class="form_tdinput">
			
		</div>
		</div>
	
		<div class="form_row" style="padding-bottom:38px">
		<div class="form_tdlabel" style="text-align:left;">
			<img src="CaptchaSecurityImages.php"/>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div class="form_row" >
		<div class="form_tdlabel" style="text-align:left;">
			<input id="security_code" name="security_code" type="text" size="8" />
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
		
	</div>
	<div style="text-align:right;">
		<img id="btn_preview" style="cursor:pointer" src="image/preview_off.gif" onmouseover="getElementById('btn_preview').src='image/preview_on.gif';" onmouseout="getElementById('btn_preview').src='image/preview_off.gif';"></img>
	</div>
</div>

</div>
<div style="width:824px;height:8px;border-bottom: 1px solid #b3b3b3;padding-top:9px;">
</div>

</div>



</div>

<div style="float:left;width:8px;height:400px;">
	<div style="width:8px;height:36px;">
		<img src="http://ezemeet.copops.com/image/corner_topright.gif">
	</div>
	<div style="width:7px;height:356px;border-right:1px solid #b3b3b3">
		
	</div>
	<div style="width:8px;height:8px;">
		<img src="http://ezemeet.copops.com/image/corner_bottomright.gif">
	</div>
</div>

<div style="clear: left;">
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