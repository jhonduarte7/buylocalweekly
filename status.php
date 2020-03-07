<?php 
	session_start(); 
	if(isset($_SESSION['id_business']) && (time() - $_SESSION['id_business'] > 1800)) { 
?>
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

	$maxRows_Recordset1 = 10;
	$pageNum_Recordset1 = 0;
	if (isset($_GET['pageNum_Recordset1'])) {
		$pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
	}
	$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

	$var_Recordset1 = "0";
	if (isset($_SESSION['id_business'])) {
		$var_Recordset1 = $_SESSION['id_business'];
	}
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_Recordset1 = sprintf("SELECT deals.id_deals, deals.deal_title, deals.deal_last_date_posted, deals.status_deal, deal_status.status FROM deals, deal_status WHERE deals.id_business = %s and deals.status_deal = deal_status.id_status ORDER BY deals.id_deals DESC", GetSQLValueString($var_Recordset1, "int"));
	$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
	$Recordset1 = mysql_query($query_limit_Recordset1, $admin_buy_local) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);

	if (isset($_GET['totalRows_Recordset1'])) {
		$totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
	} else {
		$all_Recordset1 = mysql_query($query_Recordset1);
		$totalRows_Recordset1 = mysql_num_rows($all_Recordset1);
	}
	$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Deals Status</title>
	<link href="_css/status.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>DEALS STATUS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New business regstration section -->
		<div id="StatusDealBox">
			<div id="DealForm">
				<div id="StatusTitle">Deal Title</div>
				<div id="StatusDate">Last Date Posted</div>
				<div id="StatusType">Status</div>
				<?php do { ?>
			    <div id="MiniDealList">
					<table border="0">
						<tr height="26">
							<td width="300">
                            	<span class="mngdeal">
                                	<a href="mngdeal.php?recordID=<?php echo $row_Recordset1['id_deals']; ?>" ><?php echo $row_Recordset1['deal_title']; ?></a>
                                </span>
                            </td>
							<td width="115"><?php echo $row_Recordset1['deal_last_date_posted']; ?></td>
                            <td width="100"><div align="right"><span class="mngdeal"><?php echo $row_Recordset1['status']; ?> | <a href="mngdeal.php?recordID=<?php echo $row_Recordset1['id_deals']; ?>" style="text-decoration:none">Edit</a></span></div></td>
						</tr>
						<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
					</table>
				</div>
				<div id="ListIndicators">
					<table border="0" cellspacing="5">
						<tr>
							<td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
								<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
								<?php } // Show if not first page ?></td>
							<td><?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
								<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
								<?php } // Show if not first page ?></td>
							<td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
								<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
								<?php } // Show if not last page ?></td>
							<td><?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
								<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
								<?php } // Show if not last page ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div id="TopMenu">
			<div id="MenuLocation">
				<ul>
					<li ID="MainMenuA"><a href="adddeal.php">Add Buy Local Deal</a></li>
					<li ID="MainMenuA"><a href="#">View Active|Inactive Deals</a></li>
					<li ID="MainMenuA"><a href="mngbsnss.php">View|Edit Business Profile</a></li>
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
	mysql_free_result($Recordset1);
	}else{
		echo '<script language="javascript">
		location.href = "./admin.php?sec=2";
		</script>
		'
		;
	}
?>