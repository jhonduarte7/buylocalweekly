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

	$_POST['id_business_status'] = "1";
	$_POST['date_created'] = date("M d, Y");

	if (strlen($_POST['password']) < 4) {
		header("Location:addbusiness.php?sec=2");
	} else if ($_POST['password'] !== $_POST['verifypsswrd']) {
		header("Location:addbusiness.php?sec=3");
	} else if (empty($_POST['business_name']) || empty($_POST['address1']) || empty($_POST['city']) || empty($_POST['state']) || empty($_POST['zip']) || empty($_POST['email']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['verifypsswrd']) || empty($_POST['about_us'])) {
		header("Location:addbusiness.php?sec=1");	
	} else {
		
		if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
			$location = $_FILES['logo'];
			$image = rand(1,2);
			$image = $image * time();
			$image = $image.".jpg";
			$filename=$image;
			$path="./_logos/".$filename;
			$tempname=$location['tmp_name'];
			copy($tempname,$path);
			if ($location['name'] == "") {
				$_POST['logo'] = "bssnlogo.jpg";
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
				$_POST['photo'] = "bssnphoto.jpg";
			} else {
				$_POST['photo'] = $image;
			}

			$insertSQL = sprintf("INSERT INTO business (business_name, address1, address2, city, `state`, zip, phone, email, username, password, logo, facebook, twitter, youtube, business_website, photo, about_us, id_business_status, date_created) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
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
			GetSQLValueString($_POST['date_created'], "text"));

			mysql_select_db($database_admin_buy_local, $admin_buy_local);
			$Result1 = mysql_query($insertSQL, $admin_buy_local) or die(mysql_error());

			$insertGoTo = "newbsnss.php";
			if (isset($_SERVER['QUERY_STRING'])) {
				$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
				$insertGoTo .= $_SERVER['QUERY_STRING'];
			}

			$name = $_POST['business_name'];
			$email = $_POST['email'];

			$to = "admin@buylocalweekly.com";
			$subject = "New Business Added";
			$message = "A new Business has been registed in BuyLocalWeekly.com/$citysite:\n\nNew Business Name: $name\n\nEmail: $email\n\nLog on the Master Area to verify and activate the new business profile.\n\nBest Regards,\nThe BuyLocalWeekly Web Team";

			$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
			$headers .= "\r\nX-Mailer: PHP/".phpversion();

			mail($to,$subject,$message, $headers);
		
			header(sprintf("Location: %s", $insertGoTo));
		}
	}
?>