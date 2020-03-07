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

	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	$sec = $_GET['sec'];
	if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {

		$location = $_FILES['deal_image'];
		$image = rand(1,2);
		$image = $image * time();
		$image = $image.".jpg";
		$filename=$image;
		$path="./_deals/".$filename;
		$tempname=$location['tmp_name'];
		copy($tempname,$path);
		if ($location['name'] == "") {
			$_POST['deal_image'] = "deal.jpg";
		} else {
		   $_POST['deal_image'] = $image;
		}
		
	/*$dealdetail = mysql_real_escape_string($admin_buy_local, $_POST['deal_detail']);*/
	$insertSQL = sprintf("INSERT INTO deals (deal_title, deal_detail, deal_image, status_deal, deal_date, deal_last_date_posted, id_business, renov) VALUES (%s, %s, %s, %s, %s, %s, %s, %s)",
				GetSQLValueString($_POST['deal_title'], "text"),
				GetSQLValueString($_POST['deal_detail'], "text"),
				GetSQLValueString($_POST['deal_image'], "text"),
				GetSQLValueString($_POST['status_deal'], "int"),
				GetSQLValueString($_POST['deal_date'], "text"),
				GetSQLValueString($_POST['deal_last_date_posted'], "text"),
				GetSQLValueString($_POST['id_business'], "int"),
				GetSQLValueString($_POST['renov'], "int"));

		mysql_select_db($database_admin_buy_local, $admin_buy_local);
		$Result1 = mysql_query($insertSQL, $admin_buy_local) or die(mysql_error());
  
		$insertGoTo = "newdeal.php";
		if (isset($_SERVER['QUERY_STRING'])) {
			$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
			$insertGoTo .= $_SERVER['QUERY_STRING'];
		}
		echo "This is the Post";
		echo $_POST['deal_detail'];
		echo "this is the variable";
		echo $dealdetail;
		header(sprintf("Location: %s", $insertGoTo));
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

	$sec = $_SESSION['id_business'];
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_RecordsetBssn = "SELECT * FROM business WHERE business.id_business = '$sec'";
	$RecordsetBssn = mysql_query($query_RecordsetBssn, $admin_buy_local) or die(mysql_error());
	$row_RecordsetBssn = mysql_fetch_assoc($RecordsetBssn);
	$totalRows_RecordsetBssn = mysql_num_rows($RecordsetBssn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Buy Local Weekly - Add New Deal</title>
	<link href="_css/adddeal.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>ADD NEW DEAL</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New deal regstration section -->
		<div id="AddDealBox">
		<!-- New deal regstration form section -->
			<div id="DealForm">
              <form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form2" id="form2">
                <table width="540" border="0" align="center" cellpadding="0" cellspacing="8">
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Deal Title :</td>
                    <td colspan="2"><input name="deal_title" type="text" value="" size="41" maxlength="40" /></td>
                  </tr>
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Deal Details :</td>
                    <td colspan="2"><textarea name="deal_detail" cols="31" rows="2"></textarea></td>
                  </tr>
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Deal Image :</td>
                    <td colspan="2"><input type="file" name="deal_image" id="deal_image" /></td>
                  </tr>
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">Status :</td>
                    <td colspan="2"><div align="left"><span class="addstatus">Pending</span></div></td>
                  </tr>
                  <tr valign="baseline">
                    <td nowrap="nowrap" align="right">&nbsp;</td>
                    <td><input type="submit" value="Submit" /></td>
                    <td><input type="reset" name="Cancel" id="Cancel" value="Cancel" /></td>
                  </tr>
                </table>
                <input type="hidden" name="MM_insert" value="form2" />
   				<input type="hidden" name="status_deal" value="1" />
   				<input type="hidden" name="deal_date" value="<?php echo date("m/d/y"); ?>" />
   				<input type="hidden" name="deal_last_date_posted" value="<?php echo date("m/d/y"); ?>" />
   				<input type="hidden" name="id_business" value="<?php echo $sec; ?>" />
   				<input type="hidden" name="renov" value="0" />
              </form>
            </div>
		</div>
		<!-- Right menu options section -->
		<div id="TopMenu">
			<div id="MenuLocation">
    	       	<ul>
					<li ID="MainMenuA"><a href="#">Add Buy Local Deal</a></li>
					<li ID="MainMenuA"><a href="<?php echo "status.php" ?>">View Active|Inactive Deals</a></li>
					<li ID="MainMenuA"><a href="<?php echo "mngbsnss.php" ?>">View|Edit Business Profile</a></li>
                    <li ID="MainMenuA"><a href="closesession.php">Log Out</a></li>
				</ul>
			</div>
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