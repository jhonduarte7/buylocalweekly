<?php require_once('_connections/adm_blw.php'); ?>
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
?>
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
	
	$currentPage = $_SERVER["PHP_SELF"];

	$maxRows_generalList = 500;
	$pageNum_generalList = 0;
	if (isset($_GET['pageNum_generalList'])) {
		$pageNum_generalList = $_GET['pageNum_generalList'];
	}
	$startRow_generalList = $pageNum_generalList * $maxRows_generalList;

	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_generalList = "SELECT business.id_business, business_name, address1, address2, city, state, zip, phone, id_deals, deal_title, deal_image, deal_detail, status_deal, deal_date FROM business, deals WHERE business.city = '$citysite' AND business.id_business_status = 2 AND business.id_business = deals.id_business AND deals.status_deal = 2 ORDER BY id_deals ASC";
	$query_limit_generalList = sprintf("%s LIMIT %d, %d", $query_generalList, $startRow_generalList, $maxRows_generalList);
	$generalList = mysqli_query($admin_buy_local, $query_limit_generalList) or die(mysqli_error());
	$row_generalList = mysqli_fetch_assoc($generalList);

	if (isset($_GET['totalRows_generalList'])) {
		$totalRows_generalList = $_GET['totalRows_generalList'];
	} else {
		$all_generalList = mysqli_query($admin_buy_local, $query_generalList);
		$totalRows_generalList = mysqli_num_rows($all_generalList);
	}
	$totalPages_generalList = ceil($totalRows_generalList/$maxRows_generalList)-1;

	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_welcome = "SELECT master_admin.welcome FROM master_admin";
	$welcome = mysqli_query($admin_buy_local, $query_welcome) or die(mysqli_error());
	$row_welcome = mysqli_fetch_assoc($welcome);
	$totalRows_welcome = mysqli_num_rows($welcome);

	$queryString_generalList = "";
	if (!empty($_SERVER['QUERY_STRING'])) {
		$params = explode("&", $_SERVER['QUERY_STRING']);
		$newParams = array();
		foreach ($params as $param) {
			if (stristr($param, "pageNum_generalList") == false && 
        		stristr($param, "totalRows_generalList") == false) {
				array_push($newParams, $param);
			}
		}
		if (count($newParams) != 0) {
			$queryString_generalList = "&" . htmlentities(implode("&", $newParams));
		}
	}
	$queryString_generalList = sprintf("&totalRows_generalList=%d%s", $totalRows_generalList, $queryString_generalList);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - View Deals</title>
	<link href="_css/dealsscreen.css" rel="stylesheet" type="text/css" media="screen" />
    <link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>
	<!-- Ends META Tags -->
<!--	<script type="text/javascript">
		window.onload = function() { window.print(); }
	</script>-->
</head>

<body>
    <!-- Date expiration reminder section -->
	<?php 
		$diaActual = date("m/d/y"); 
		$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));
		if ($WednesdayNext == $diaActual) {
			$WednesdayNext = $diaActual;
		} else {
			$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));
		}
	?>
	<div id="Wrapper">
    	<!-- Site's logo & city name section -->
		<div ID="SiteLogo">
   	    	<img src="_images/sublogo.jpg" width="250" height="100" />
		</div>
		<!-- Site's Cty name section -->
		<div ID="CityName">
			<?php echo 	$citysite; ?>
		</div>
		<!-- Date expiration reminder section -->
		<div id="Reminder">The following Buy Local Weekly deals expire on <?php echo $WednesdayNext;?></div>
		<div id="PrintDealsButton">
			<script>
				var pfHeaderImgUrl = '';
				var pfHeaderTagline = '';
				var pfdisableClickToDel = 1;
				var pfHideImages = 0;
				var pfImageDisplayStyle = 'block';var pfDisablePDF = 0;var pfDisableEmail = 1;var pfDisablePrint = 0;var pfCustomCSS = '_css/dealspdf.css';var pfBtVersion='1';
				(function(){var js, pf;
				pf = document.createElement('script');
				pf.type = 'text/javascript';if('https:' == document.location.protocol){js='https://pf-cdn.printfriendly.com/ssl/main.js'}else{js='http://cdn.printfriendly.com/printfriendly.js'}pf.src=js;document.getElementsByTagName('head')[0].appendChild(pf)})();
			</script>
            <a href="http://www.printfriendly.com" style="color:#6D9F00;text-decoration:none;" class="printfriendly" onclick="window.print();return false;" title="Printer Friendly and PDF">
            	<img style="border:none;-webkit-box-shadow:none;box-shadow:none;" src="http://cdn.printfriendly.com/pf-button-big.gif" alt="Print Friendly and PDF"/>
            </a>
        </div>
		<div id="DealsMainBox">
        	<table width="800" border="0" cellspacing="0" cellpadding="0">
				<?php do { ?>
				<tr>
					<td width="795">
						<div id="MLDivSpace">
							<div id="deallistbox">
								<div id="PrintDealTitle"><?php echo $row_generalList['deal_title']; ?></div>
								<div id="PrintDealDate"><?php echo $WednesdayNext;?></div>
								<div id="DealBorders">
									<div id="PrintDealImage"><img src="_deals/<?php echo $row_generalList['deal_image']; ?>" width="110" height="110" /></div>
									<div id="PrintDealDetail"><?php echo stripslashes($row_generalList['deal_detail']); ?></div>
								</div>
								<div id="PrintDealBusiness"><?php echo $row_generalList['business_name']; ?></div>
								<div id="PrintDealAddress">
									<?php
										if ($row_generalList['address2'] == NULL) {
											echo $row_generalList['address1'].", ".$row_generalList['city'].", ".$row_generalList['state'].", ".$row_generalList['zip'];
										} else {
											echo $row_generalList['address1'].", ".$row_generalList['address2'].", ".$row_generalList['city'].", ".$row_generalList['state'].", ".$row_generalList['zip'];
										}
									?>                        
								</div>
								<div id="PrintDealPhone"><?php echo $row_generalList['phone']; ?></div>
							</div>
						</div>                       
					</td>
				</tr>
				<?php } while ($row_generalList = mysqli_fetch_assoc($generalList)); ?>  
			</table>
		</div>
	</div>
</body>
</html>
<?php
mysqli_free_result($generalList);
?>