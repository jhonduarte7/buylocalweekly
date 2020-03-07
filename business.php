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

	$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

	$maxRows_recordID = 3;
	$pageNum_recordID = 0;
	if (isset($_GET['pageNum_recordID'])) {
		$pageNum_recordID = $_GET['pageNum_recordID'];
	}
	$startRow_recordID = $pageNum_recordID * $maxRows_recordID;

	$recordID_recordID = "0";
	if (isset($_GET['recordID'])) {
		$recordID_recordID = $_GET['recordID'];
	}
	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_recordID = sprintf("SELECT business.id_business, id_deals, deal_title, deal_detail, deal_image, status_deal, deal_date, deal_status.status FROM business, deals, deal_status WHERE business.id_business = deals.id_business and deals.status_deal = deal_status.id_status and deals.status_deal = 2 and business.id_business = %s", GetSQLValueString($recordID_recordID, "int"));
	$query_limit_recordID = sprintf("%s LIMIT %d, %d", $query_recordID, $startRow_recordID, $maxRows_recordID);
	$recordID = mysqli_query($admin_buy_local, $query_limit_recordID) or die(mysqli_error());
	$row_recordID = mysqli_fetch_assoc($recordID);

	if (isset($_GET['totalRows_recordID'])) {
		$totalRows_recordID = $_GET['totalRows_recordID'];
	} else {
		$all_recordID = mysqli_query($admin_buy_local, $query_recordID);
		$totalRows_recordID = mysqli_num_rows($all_recordID);
	}
	$totalPages_recordID = ceil($totalRows_recordID/$maxRows_recordID)-1;

	$businessID_businessID = "0";
	if (isset($_GET['recordID'])) {
		$businessID_businessID = $_GET['recordID'];
	}
	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_businessID = sprintf("SELECT id_business, business_name, address1, address2, city, state, zip, phone, email, logo, photo, facebook, twitter, youtube, business_website, about_us FROM business WHERE city = '$citysite' and id_business = '$recordID_recordID'");
	$businessID = mysqli_query($admin_buy_local, $query_businessID) or die(mysqli_error());
	$row_businessID = mysqli_fetch_assoc($businessID);
	$totalRows_businessID = mysqli_num_rows($businessID);

	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_disclaimer = "SELECT master_admin.disclaimer FROM master_admin WHERE city_name = '$citysite'";
	$disclaimer = mysqli_query($admin_buy_local, $query_disclaimer) or die(mysqli_error());
	$row_disclaimer = mysqli_fetch_assoc($disclaimer);
	$totalRows_disclaimer = mysqli_num_rows($disclaimer);

	global $image, $about; $image = $row_businessID['logo']; 

	$about = $row_businessID['about_us']; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Business Profile</title>
	<link href="_css/business.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>BUSINESS PROFILE</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date expiration reminder section -->
		<div id="BusinessBox">
			<div id="BssnProfileBox">
				<div id="BusinessProfile"><?php echo $row_businessID['business_name']; ?></div>
                <div id="PhoneProfile"><?php echo $row_businessID['phone']; ?></div>
				<div id="AddressProfile"><?php
                    	if ($row_businessID['address2'] == NULL) {
							echo $row_businessID['address1'].", ".$row_businessID['city'].", ".$row_businessID['state'].", ".$row_businessID['zip'];
						} else {
							echo $row_businessID['address1'].", ".$row_businessID['address2'].", ".$row_businessID['city'].", ".$row_businessID['state'].", ".$row_businessID['zip'];
						} ?>
                </div>
				<div id="SocialMedia">
		   			<table width="auto" border="0" cellspacing="0" cellpadding="4">
						<tr>
						   	<td>
								<?php if ($row_businessID['facebook'] == NULL) { ?>
								<img src="_images/facebook.png" width="32" height="32" />
            	                <?php } else { ?>
								<a href="<?php echo $row_businessID['facebook']; ?>" target="_blank"><img src="_images/facebook.png" width="32" height="32" /></a>
                    	        <?php } ?>
                        	</td>
						   	<td>
								<?php if ($row_businessID['twitter'] == NULL) { ?>
								<img src="_images/twitter.png" width="32" height="32" />
        	                    <?php } else { ?>
								<a href="<?php echo $row_businessID['twitter']; ?>" target="_blank"><img src="_images/twitter.png" width="32" height="32" /></a>
            	                <?php } ?>
                	        </td>
						   	<td>
								<?php if ($row_businessID['youtube'] == NULL) { ?>
								<img src="_images/youtube.png" width="32" height="32" />
                            	<?php } else { ?>
								<a href="<?php echo $row_businessID['youtube']; ?>" target="_blank"><img src="_images/youtube.png" width="32" height="32" /></a>
	                            <?php } ?>
    	                    </td>
						</tr>
					</table>
				</div>
                <div id="WebsiteProfile">
					<?php if ($row_businessID['business_website'] == NULL) { ?>
						<a href="#"></a>
                   	<?php } else { ?>
						<a href="<?php echo $row_businessID['business_website']; ?>" target="_blank"></a>
                    <?php } ?>                
				</div>
                <div id="emailProfile"><?php echo $row_businessID['email']; ?></div> 
			</div>
			<div id="BssnLogoImg">
				<img src="_logos/<?php echo $row_businessID['logo']; ?>" width="205" height="205" />
			</div>
			<!-- Mini deals list section -->
			<div id="BssnDealList">
				<div id="BssnDealTitle">BUY LOCAL DEALS</div>
				<?php do { ?>
				<div id="MLDivSpace">
					<div id="MiniDealList">
					    <div id="BssnDealHLine">
                        	<a href="deal.php?recordID=<?php echo $row_recordID['id_deals']; ?>" target="_blank" ><?php echo $row_recordID['deal_title'] ?></a>
						</div>
					    <div id="BssnDealDetail"><?php echo substr($row_recordID['deal_detail'], 0,60).'...'; ?></div>
					    <div id="BssnDealStatus"><?php echo $row_recordID['status']; ?></div>
					</div>
                </div>
				<?php } while ($row_recordID = mysqli_fetch_assoc($recordID)); ?>
			</div>
 			<div id="BssnMapImg">
            	<a href="map.php?recordID=<?php echo $recordID_recordID; ?>" target="_blank"><img src="_images/map.jpg" width="205" height="205" /></a>
            </div>
			<div id="BussAbout">
				<div id="BssnAboutTtl">ABOUT US</div>
                <?php ?>
				<div id="BssnPhoto"><img src="_logos/<?php echo $row_businessID['photo']; ?>" width="150" height="145" /></div>
        	    <div id="BussAboutTxt"><?php echo $about ?></div>
			</div>
			<div id="BssnDisclaimer">
				<p class="GeneralText"><span class="Disclaimer">Important Disclaimer:</span> <?php echo $row_disclaimer['disclaimer']; ?></p>
            </div>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyWeeklyLocal</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>
<?php
mysqli_free_result($recordID);

mysqli_free_result($disclaimer);
?>