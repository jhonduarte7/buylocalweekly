<?php 
	session_start(); 
	if(isset($_SESSION['id_business']) && (time() - $_SESSION['id_business'] > 1800)) { 
?>
<?php require_once('_connections/adm_blw.php'); ?>
<?php
	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	}

	$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

	switch ($theType) {
    	case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
    	break;    
    	case "long":
    		case "int":
    			$theValue = ($theValue != "") ? intval($theValue) : "NULL";
    		break;
    		case "double":
    	    	$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
    		break;
    	    case "date":
    			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
    		break;
    		case "defined":
    			$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
    		break;
    		}
    	return $theValue;
		}
	}

	//$citysite = "Any Town";
	$citysite = "Youngtown";
	//$citysite = "El Mirage";
	//$citysite = "Surprise";
	//$citysite = "Buckeye";
	//$citysite = "Goodyear";
	//$citysite = "Avondale";
	//$citysite = "Maricopa";
	//$citysite = "Peoria";
	//$citysite = "Sun City";
	//$citysite = "Sun City West";
	//$citysite = "Glendale";
	//$citysite = "Phoenix";
	//$citysite = "Paradise Valley";
	//$citysite = "Scottdale";
	//$citysite = "Tempe";
	//$citysite = "Mesa";
	//$citysite = "Chandler";
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form2")) {
		$location = $_FILES['logo'];
		$image = rand(1,2);
		$image = $image * time();
		$image = $image.".jpg";
		$filename=$image;
		$path="./_logos/".$filename;
		$tempname=$location['tmp_name'];
		copy($tempname,$path);
		if ($location['name'] == "") {
			$_POST['logo'] = $_POST['logo'];
		} else {
		   $_POST['logo'] = $image;
		}

		$location = $_FILES['photo'];
		$image = rand(1,2);
		$image = $image * time();
		$image = $image."-p".".jpg";
		$filename=$image;
		$path="./_logos/".$filename;
		$tempname=$location['tmp_name'];
		copy($tempname,$path);
		if ($location['name'] == "") {
			$_POST['photo'] = $_POST['photo'];
		} else {
		   $_POST['photo'] = $image;
		}

		mysql_select_db($database_admin_buy_local, $admin_buy_local);
		global $verdadero;
		$firstConsult = sprintf("SELECT business_name FROM `business` WHERE `business_name` = %s ",GetSQLValueString($_POST['business_name'], "text"));
		$LoginRS = mysql_query($firstConsult, $admin_buy_local) or die(mysql_error());
		if($row = mysql_fetch_array($LoginRS)){
			$verdadero = $row['business_name'];
		}
		
		$updateSQL = sprintf("UPDATE business SET business_name=%s, address1=%s, address2=%s, city=%s, `state`=%s, zip=%s, phone=%s, email=%s, username=%s, password=%s, logo=%s, facebook=%s, twitter=%s, youtube=%s, business_website=%s, photo=%s, about_us=%s, id_business_status=%s, date_created=%s, date_actvated=%s, date_deactivated=%s WHERE id_business=%s",
    		GetSQLValueString($_POST['business_name'], "text"),
    		GetSQLValueString($_POST['address1'], "text"),
    		GetSQLValueString($_POST['address2'], "text"),
    		GetSQLValueString($_POST['city'], "text"),
    		GetSQLValueString($_POST['state'], "text"),
    		GetSQLValueString($_POST['zip'], "text"),
    		GetSQLValueString($_POST['phone'], "text"),
    		GetSQLValueString($_POST['email'], "text"),
    		GetSQLValueString($_POST['username'], "text"),
    		GetSQLValueString($_POST['password'], "text"),
    		GetSQLValueString($_POST['logo'], "text"),
    		GetSQLValueString($_POST['facebook'], "text"),
    		GetSQLValueString($_POST['twitter'], "text"),
    		GetSQLValueString($_POST['youtube'], "text"),
    		GetSQLValueString($_POST['business_website'], "text"),
    		GetSQLValueString($_POST['photo'], "text"),
    		GetSQLValueString($_POST['about_us'], "text"),
    		GetSQLValueString($_POST['id_business_status'], "int"),
    		GetSQLValueString($_POST['date_created'], "text"),
    		GetSQLValueString($_POST['date_actvated'], "text"),
    		GetSQLValueString($_POST['date_deactivated'], "text"),
    		GetSQLValueString($_POST['id_business'], "int"));

    	mysql_select_db($database_admin_buy_local, $admin_buy_local);
    	$Result1 = mysql_query($updateSQL, $admin_buy_local) or die(mysql_error());
		

		if ($verdadero == ''){
			//echo "entro aqui en falso";
			
			$secondConsult = sprintf("UPDATE business SET id_business_status = 1 WHERE `id_business` = %s ",GetSQLValueString($_POST['id_business'], "int"));
		$LoginRS = mysql_query($secondConsult, $admin_buy_local) or die(mysql_error());
			
			
		}

		$name = $_POST['business_name'];
		$email = $_POST['email'];

		$to = "admin@buylocalweekly.com";
		$subject = "Business Profile Modified";
		$message = "One of the Business members of BuyLocalWeekly.com/$citysite has updated its information:\n\nBusiness Name: $name\n\nEmail: $email\n\nLog on the Master Area to verify and re-activate the business profile.\n\nBest Regards,\nThe BuyLocalWeekly Web Team";

		$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
		$headers .= "\r\nX-Mailer: PHP/".phpversion();

		mail($to,$subject,$message, $headers);
	}

	$sec =  $_SESSION['id_business'];
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_RecordsetBssn = "SELECT * FROM business WHERE business.id_business = '$sec'";
	$RecordsetBssn = mysql_query($query_RecordsetBssn, $admin_buy_local) or die(mysql_error());
	$row_RecordsetBssn = mysql_fetch_assoc($RecordsetBssn);
	$totalRows_RecordsetBssn = mysql_num_rows($RecordsetBssn);

	$business = $row_RecordsetBssn['id_business'];

	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_cityName = sprintf("SELECT admin_notice FROM master_admin WHERE city_name = '$citysite'"); 
	$cityName = mysql_query($query_cityName, $admin_buy_local) or die(mysql_error());
	$row_cityName = mysql_fetch_assoc($cityName);
	$totalRows_cityName = mysql_num_rows($cityName);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Manage Business Profile</title>
	<link href="_css/mngbsnss.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>
	<!-- Ends META Tags -->
</head>

<body>
	<!-- Site's Top section -->
	<div id="TopBorder">
    </div>
	<!-- Site's external borders -->
	<div id="Wrapper">
		<!-- Site's logo & city name section -->
		<div ID="SiteLogo">
   	    	<a href="index.php"><img src="_images/sublogo.jpg" width="250" height="100" /></a>
		</div>
		<!-- Site's Cty name section -->
		<div ID="CityName">
			<?php echo 	$citysite; ?>
		</div>
		<!-- Ribbon & welcome message section -->
		<div class="ribbon">
   	    	<div class="ribbon-stitches-top">
       	    </div>
       		<div class="ribbon-stitches-left">
            </div>
   	        <strong class="ribbon-content">
       	    	<h1>MANAGE BUSINESS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New business regstration section -->
		<div id="ChangeReminder">
        	<span class="RedNote">Important: Changing your business name will result in your account going in to pending status and will require approval</span>
		</div>
		<div id="AddBssnBox">
    	    <div id="BssnForm">
            	<?php $BsnssName = $row_RecordsetBssn['business_name']; ?>
				<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2">
					<table width="570" align="center">
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Business Name:</td>
							<td><input type="text" name="business_name" value="<?php echo htmlentities($row_RecordsetBssn['business_name'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Address 1:</td>
							<td><input type="text" name="address1" value="<?php echo htmlentities($row_RecordsetBssn['address1'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Address 2:</td>
							<td><input type="text" name="address2" value="<?php echo htmlentities($row_RecordsetBssn['address2'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">City:</td>
							<td><?php echo $row_RecordsetBssn['city']?><input type="hidden" name="city" value="<?php echo $row_RecordsetBssn['city']; ?>" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">State:</td>
							<td><input type="text" name="state" value="<?php echo htmlentities($row_RecordsetBssn['state'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Zip:</td>
							<td><input type="ZipCode" name="zip" value="<?php echo htmlentities($row_RecordsetBssn['zip'], ENT_COMPAT, 'utf-8'); ?>"  size="26" maxlength="10" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Phone:</td>
							<td><input type="text" name="phone" value="<?php echo htmlentities($row_RecordsetBssn['phone'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="15" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Email:</td>
							<td><input type="email" name="email" value="<?php echo htmlentities($row_RecordsetBssn['email'], ENT_COMPAT, 'utf-8'); ?>" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Username:</td>
							<td><input type="text" name="username" value="<?php echo htmlentities($row_RecordsetBssn['username'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Password:</td>
							<td><input type="password" name="password" value="<?php echo htmlentities($row_RecordsetBssn['password'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Logo:</td>
							<td><img src="<?php echo "_logos/".$row_RecordsetBssn['logo']; ?>" width="150" height="150" border="0" /><?php $logobssn = $row_RecordsetBssn['logo'] ?></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Logo:</td>
							<td><input type="file" name="logo" id="logo" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Facebook:</td>
							<td><input type="text" name="facebook" value="<?php echo htmlentities($row_RecordsetBssn['facebook'], ENT_COMPAT, 'utf-8'); ?>" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Twitter:</td>
							<td><input type="text" name="twitter" value="<?php echo htmlentities($row_RecordsetBssn['twitter'], ENT_COMPAT, 'utf-8'); ?>" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Youtube:</td>
							<td><input type="text" name="youtube" value="<?php echo htmlentities($row_RecordsetBssn['youtube'], ENT_COMPAT, 'utf-8'); ?>" size="51" maxlength="75" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Business_website:</td>
							<td><input type="text" name="business_website" value="<?php echo htmlentities($row_RecordsetBssn['business_website'], ENT_COMPAT, 'utf-8'); ?>" size="51" maxlength="75" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Photo:</td>
							<td><img src="<?php echo "_logos/".$row_RecordsetBssn['photo']; ?>" width="150" height="150" border="0" /><?php $photobssn = $row_RecordsetBssn['photo'] ?></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">Photo:</td>
							<td><input type="file" name="photo" id="photo" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">About_us:</td>
							<td><textarea name="about_us" cols="25" rows="2" id="about_us"><?php echo htmlentities($row_RecordsetBssn['about_us'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">&nbsp;</td>
							<td><input type="submit" value="Update record" /></td>
						</tr>
					</table>
					<input type="hidden" name="MM_update" value="form2" />
					<input type="hidden" name="id_business" value="<?php echo $row_RecordsetBssn['id_business']; ?>" />
					<input type="hidden" name="id_business_status" value="2" />
					<input type="hidden" name="date_created" value="<?php echo $row_RecordsetBssn['date_created']; ?>" />
					<input type="hidden" name="date_actvated" value="<?php echo $row_RecordsetBssn['date_actvated']; ?>" />
					<input type="hidden" name="date_deactivated" value="<?php echo $row_RecordsetBssn['date_deactivated']; ?>" />
					<input type="hidden" name="logo" value="<?php echo $row_RecordsetBssn['logo']; ?>" />
					<input type="hidden" name="photo" value="<?php echo $row_RecordsetBssn['photo']; ?>" />
				</form>
			</div>
    	</div>
		<!-- Top right menu options -->
		<div id="TopMenu">
			<div id="MenuLocation">
				<ul>
    				<li ID="MainMenuA"><a href="<?php echo "adddeal.php" ?>" >Add Buy Local Deal</a></li>
    	    		<li ID="MainMenuA"><a href="<?php echo "status.php" ?>">View Active|Inactive Deals</a></li>
    	    		<li ID="MainMenuA"><a href="#">View|Edit Business Profile</a></li>
	    	    	<li ID="MainMenuA"><a href="closesession.php">Log Out</a></li>
    			</ul>
    		</div>
		</div>
		<!-- Administrative notice section -->
		<div id="AdminNotice">
			<div id="AdminNoticeTitle">Administrative Notice</div>
			<div id="AdminNote"><?php echo $row_cityName['admin_notice']; ?></div>
		</div>
	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>
<?php
	mysql_free_result($RecordsetBssn);
	}else{
		echo '<script language="javascript">
		location.href = "./admin.php?sec=2";
		</script>
		'
		;
	}
?>