<?php require_once('_connections/adm_blw.php'); ?>
<?php
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
?>
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

	$recordID_recordID = "0";
	if (isset($_GET['recordID'])) {
		$recordID_recordID = $_GET['recordID'];
	}
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_recordID = sprintf("SELECT business.id_business, business_name, address1, address2, city, state, zip, phone, email, facebook, twitter, youtube, business_website, id_deals, deal_title, deal_detail, deal_image, status_deal, deal_date FROM business, deals WHERE business.id_business = deals.id_business and deals.id_deals = %s", GetSQLValueString($recordID_recordID, "int"));
	$recordID = mysql_query($query_recordID, $admin_buy_local) or die(mysql_error());
	$row_recordID = mysql_fetch_assoc($recordID);
	$totalRows_recordID = mysql_num_rows($recordID);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Print Deal</title>
	<link href="_css/coupon.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>
	<!-- Ends META Tags -->
	<script type="text/javascript">
		window.onload = function() { window.print(); }
	</script>
</head>

<body>
	<!-- Site's external borders -->
	<div id="Wrapper">
		<!-- Site's logo section -->
		<div ID="SiteLogo">
   	    	<a href="index.php"><img src="_images/sublogo.jpg" width="250" height="100" /></a>
		</div>
		<!-- Site's city name section -->
		<div ID="CityName">
			<?php echo 	$citysite; ?>
		</div>
		<!-- Date expiration reminder section -->
		<?php $WednesdayNext = date("m/d/y",(strtotime("next wednesday"))); ?>
		<div id="Reminder">The following Buy Local Weekly deal expires on <?php echo $WednesdayNext;?></div>
		<div id="DealsMainBox">
			<!-- Individual deal box section -->
			<div id="deallistbox">
				<div id="PrintDealTitle"><?php echo $row_recordID['deal_title']; ?></div>
                <div id="PrintDealDate">expires on <?php echo $WednesdayNext;?></div>
				<div id="DealBorders">
					<div id="PrintDealImage"><img src="_deals/<?php echo $row_recordID['deal_image']; ?>" width="165" height="165" /></div>
					<div id="PrintDealDetail"><?php echo $row_recordID['deal_detail']; ?></div>
				</div>
				<div id="PrintDealBusiness">
				<?php echo $row_recordID['business_name']; ?></a></div>
				<div id="PrintDealAddress">
					<?php
                    	if ($row_recordID['address2'] == NULL) {
							echo $row_recordID['address1'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];
						} else {
							echo $row_recordID['address1'].", ".$row_recordID['address2'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];
						} ?>				
                </div>
				<div id="PrintDealPhone"><?php echo $row_recordID['phone']; ?></div>
			</div>
			<div id="BottomMssg">When you buy local, you build your community</div>
		</div>
    </div>
</body>
</html>
<?php
	mysql_free_result($recordID);
?>