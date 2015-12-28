<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
<link rel="stylesheet" type="text/css" href="css/<?php echo "style2.css"."?sc=time()" ?>" />
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
		Business registration :<br><br>
<form>

<div class="form" style="margin-left:100px;">
	<div class="form_row">
		<div class="form_tdlabel">
			<label>business name :</label>
		</div>
		<div class="form_tdinput">	
			<input class="form_input" type="text">
		</div>
		<div style="clear: left;"></div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>business type :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text"><option>restaurant</option></select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>adresse line 1 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>adresse line 2 :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>country :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text"><option>Australia</option></select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>state :</label>
		</div>
		<div class="form_tdinput">
			<select class="form_input" style="width: 140px;" name="text"><option>new south wales</option></select>
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>city :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>post code :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>website :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>email adress :</label>
		</div>
		<div class="form_tdinput">
			<input class="form_input" type="text">
		</div>
	</div>
	<div style="clear: right;"></div>
	<div class="form_row">
		<div class="form_tdlabel">
			<label>business description :</label>
		</div>
		<div class="form_tdinput">
			<textarea class="form_input" cols="19" rows="2"></textarea>
		</div>
	</div>
</div>
<div class="form">
	<div class="form_row" style="padding-bottom:12px">
		<div class="form_tdlabel">
			<label>load picture :</label>
		</div>
		<div class="form_tdinput">
			&nbsp;
		</div>
	</div>
	<div class="form_row" style="padding-bottom:42px">
		<div class="form_tdlabel">
			<input type="file" style="width:70px;border:1px solid pink;border-style:none;" size="15">
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div class="form_row" style="padding-bottom:10px">
		<div class="form_tdlabel">
			<label>Security Code:</label>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div class="form_row" style="padding-bottom:38px">
		<div class="form_tdlabel" style="margin-left:44px;">
			<img src="CaptchaSecurityImages.php"/>
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
	<div class="form_row" >
		<div class="form_tdlabel">
			<input id="security_code" name="security_code" type="text" size="8" />
		</div>
		<div class="form_tdinput">
			
		</div>
	</div>
</div>
</form>	
		
		
		
	</div>
	<div id="body_right">
		<?php include("page/body_right.php"); ?>
	</div>
</div>

<div style="clear: left;">
</div>

<div id="footer">
	<?php include("page/footer.php"); ?>
</div>

</div>

</html>
</body>