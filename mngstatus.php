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

	$currentPage = $_SERVER["PHP_SELF"];

	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	$maxRows_Recordset1 = 10;
	$pageNum_Recordset1 = 0;
	if (isset($_GET['pageNum_Recordset1'])) {
		$pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
	}
	$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_Recordset1 = "SELECT * FROM business WHERE business.city = '$citysite' ORDER BY business.id_business DESC";
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

	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_otherQuery = "SELECT * FROM business_status ORDER BY business_status.id_business_status DESC";
	$otherQuery = mysql_query($query_otherQuery, $admin_buy_local) or die(mysql_error());
	$row_otherQuery = mysql_fetch_assoc($otherQuery);
	$totalRows_otherQuery = mysql_num_rows($otherQuery);

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
	<title>Buy Local Weekly - Manage Businesses</title>
	<link href="_css/mngstatus.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Raleway' rel='stylesheet' type='text/css'>
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
		<div ID="CityName">
   		   	<? echo $location['name'] ?>
		</div>
		<!-- Ribbon & welcome message section -->
		<div class="ribbon">
   	    	<div class="ribbon-stitches-top">
       	    </div>
       		<div class="ribbon-stitches-left">
            </div>
   	        <strong class="ribbon-content">
       	    	<h1>BUSINESSES STATUS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New business regstration section -->
		<div id="AddMngBssnBox">
        <form method="post" name="form1" action="mngstatusRec.php">
			<div id="BssnForm">
				<div id="BusinessTitle">Participating Businesses</div>
				<div id="BusinessStatus">Status</div>
				<div id="StatusActInact">Date Activated | Deactivated</div>
                <?php $i=0; //INICIO UN CONTADOR PARA TENER CONTROL EN EL ARREGLO ?>
				<?php do {  $i++; ?>
				<div id="MiniBssnList">
					<table border="0">
						<tr height="28">
							<td width="265"><span class="mngdeal"><a href="masterAdminSesion.php?recordID=<?php echo $row_Recordset1['id_business']; ?>" style="text-decoration:none" ><?php echo $row_Recordset1['business_name']; ?></a></span></td>
							<td width="100">
                            	<input type="hidden" name="status_<?php echo $i; ?>" value="<?php echo $row_Recordset1['id_business_status']; ?>">	
                            	<select name="id_business_status_<?php echo $i; ?>" >
									<?php do { ?>								
									<option value="<?php echo $row_otherQuery['id_business_status'] ?>"<?php if (!(strcmp($row_otherQuery['id_business_status'], htmlentities($row_Recordset1['id_business_status'], ENT_COMPAT, '')))) {echo "selected=\"selected\"";} ?>><?php echo $row_otherQuery['status']?>
									</option>
                                    
									<?php } while ($row_otherQuery = mysql_fetch_assoc($otherQuery));
									$rows = mysql_num_rows($otherQuery);
									if($rows > 0) {
										mysql_data_seek($otherQuery, 0);
										$row_otherQuery = mysql_fetch_assoc($otherQuery);
									}
									?>
								</select>
							</td>
							<td width="120"><?php echo $row_Recordset1['date_actvated']; ?></td>
							<td width="105"><?php echo $row_Recordset1['date_deactivated']; ?></td>
						</tr>
						<input type="hidden" name="id_business_<?php echo $i; ?>" value="<?php echo $row_Recordset1['id_business']; ?>">
                        <input type="hidden" name="business_<?php echo $i; ?>" value="<?php echo $row_Recordset1['business_name']; ?>">
                        <input type="hidden" name="email_<?php echo $i; ?>" value="<?php echo $row_Recordset1['email']; ?>">
						<?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));  ?>
					</table>
				</div>
				<div id="ListIndicators">
					<table border="0" cellspacing="5">
						<tr>
							<td>
                		       	<div align="center">
									<?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
									<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, 0, $queryString_Recordset1); ?>">First</a>
									<?php } // Show if not first page ?>
								</div>
							</td>
							<td>
            		           	<div align="center">
									<?php if ($pageNum_Recordset1 > 0) { // Show if not first page ?>
									<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, max(0, $pageNum_Recordset1 - 1), $queryString_Recordset1); ?>">Previous</a>
									<?php } // Show if not first page ?>
								</div>
							</td>
							<td>
    	        	           	<div align="center">
									<?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
									<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, min($totalPages_Recordset1, $pageNum_Recordset1 + 1), $queryString_Recordset1); ?>">Next</a>
									<?php } // Show if not last page ?>
								</div>
							</td>
							<td>
    	        	           	<div align="center">
									<?php if ($pageNum_Recordset1 < $totalPages_Recordset1) { // Show if not last page ?>
									<a href="<?php printf("%s?pageNum_Recordset1=%d%s", $currentPage, $totalPages_Recordset1, $queryString_Recordset1); ?>">Last</a>
									<?php } // Show if not last page ?>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div id="UpdateDealsStatus">
					<table width="350" border="0" cellspacing="8" cellpadding="0">
						<tr>
							<td width="285">
								<div align="right">
									<input type="submit" name="UpdateDeals" id="UpdateDeals" value="Update Business Status" />
								</div>
							</td>
							<td width="41"></td>
						</tr>
					</table>
				</div>
			</div>
			<input type="hidden" name="MM_update" value="form1">
			<input type="hidden" name="ciclosTotal"  value="<?php echo $i ?>">
		</form>
		</div>
		<div id="TopMenu">
			<div id="MenuLocation">
    	       	<ul>
					<li ID="MainMenuA"><a href="<?php echo "mstrcity.php" ?>">Manage City</a></li>
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
	mysql_free_result($otherQuery);
?>
