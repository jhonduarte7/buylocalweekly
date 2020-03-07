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

	$currentPage = $_SERVER["PHP_SELF"];

	$maxRows_Recordset1 = 10;
	$pageNum_Recordset1 = 0;
	if (isset($_GET['pageNum_Recordset1'])) {
		$pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
	}
	$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_Recordset1 = "SELECT * FROM business WHERE business.id_business_status = 2 AND business.city = '$citysite' ORDER BY business.business_name";
	$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
	$Recordset1 = mysqli_query($admin_buy_local, $query_limit_Recordset1) or die(mysqli_error());
	$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

	if (isset($_GET['totalRows_Recordset1'])) {
		$totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
	} else {
		$all_Recordset1 = mysqli_query($admin_buy_local, $query_Recordset1);
		$totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
	}
	$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;

	$queryString_Recordset1 = "";
	if (!empty($_SERVER['QUERY_STRING'])) {
		$params = explode("&", $_SERVER['QUERY_STRING']);
		$newParams = array();
		foreach ($params as $param) {
			if (stristr($param, "pageNum_Recordset1") == false && 
				stristr($param, "totalRows_Recordset1") == false) {
				array_push($newParams, $param);
			}
		}
		if (count($newParams) != 0) {
			$queryString_Recordset1 = "&" . htmlentities(implode("&", $newParams));
		}
	}
	$queryString_Recordset1 = sprintf("&totalRows_Recordset1=%d%s", $totalRows_Recordset1, $queryString_Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - List of Businesses</title>
	<link href="_css/search.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>
	<!-- Ends META Tags -->
</head>

<body>
	<!-- Site's Top section -->
	<div id="TopBorder">
    </div>
	<!-- Site's external borders -->
	<div id="Wrapper">
		<!-- Site's Top & menu section -->
    	<div id="TopHangers">
        </div>
		<!-- Site's Top & menu box name section -->
    	<div id="TopBox">
        	<div id="BssName">BUY LOCAL WEEKLY</div>
        </div>
		<!-- Site's Top & menu options section -->
		<div id="TopMenu">
			<div id="MenuLocation">
            	<ul>
					<li ID="MainMenuD"><a href="admin.php">Business Admin</a></li>
					<li ID="MainMenuC"><a href="how.php">How It Works</a></li>
					<li ID="MainMenuB"><a href="#">List Businesses</a></li>
					<li ID="MainMenuA"><a href="index.php">Home</a></li>
				</ul>
			</div>
		</div>
		<!-- Site's logo & city name section -->
		<div ID="SiteLogo">
   	    	<img src="_images/sublogo.jpg" width="250" height="100" />
		</div>
		<!-- Site's logo & city name section -->
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
       	    	<h1>LIST OF BUSINESSES</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date expiration reminder section -->
		<div id="SearchBox">
			<table width="700" border="0" cellpadding="0" cellspacing="8">
				<tr>
					<td width="461" height="25" class="TitleSearch">Business Name</td>
					<td height="25" colspan="2" class="TitleSearch"><div align="center">Visit Business Profile</div></td>
				</tr>
				<?php do { ?>
					<tr>
						<td height="25">
							<span class="mngdeal"><a href="business.php?recordID=<?php echo $row_Recordset1['id_business']; ?>" style="text-decoration:none" target="_blank" ><?php echo $row_Recordset1['business_name']; ?></a></span>
						</td>
						<td width="42">&nbsp;</td>
						<td width="165">
							<a href="business.php?recordID=<?php echo $row_Recordset1['id_business']; ?>" style="text-decoration:none" target="_blank" ><div id="DealDetails">View Details</div></a>
						</td>  
					</tr>
				<?php } while ($row_Recordset1 = mysqli_fetch_assoc($Recordset1)); ?>
				<tr>
					<td height="50" colspan="3">
                    	<div align="center">
							<table border="0" cellpadding="0" cellspacing="5">
								<tr>
									<td class="ListIndicators"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
										<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
										<?php } // Show if not first page ?></td>
									<td class="ListIndicators"><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
										<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>	
										<?php } // Show if not first page ?></td>
									<td class="ListIndicators"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
										<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
										<?php } // Show if not last page ?></td>
									<td class="ListIndicators"><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
										<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
										<?php } // Show if not last page ?></td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			</table>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
