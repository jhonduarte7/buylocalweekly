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

	function safe($admin_buy_local) {
		return mysql_real_escape_string($admin_buy_local);
	}
	
	$editFormAction = $_SERVER['PHP_SELF'];
	if (isset($_SERVER['QUERY_STRING'])) {
		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
	}

	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

		$location = $_FILES['deal_image'];
		$image = rand(1,2);
		$image = $image * time();
		$image = $image.".jpg";
		$filename=$image;
		$path="./_deals/".$filename;
		$tempname=$location['tmp_name'];
		copy($tempname,$path);
		if ($location['name'] == "") {
			$_POST['deal_image'] = $_POST['deal_image'];
		} else {
			$_POST['deal_image'] = $image;
		}	
	
		if($_POST['id_status'] == 2 OR $_POST['id_status'] == 3) {
		
		   global $renov;
		   
		   $renov = 1;
		   
		   $status_deal_new = 1;
		   
		   $fecha = date("M d, Y");
		   
		   //$negocio = $_SESSION['id_business'];
		   
		   //'".$var."'
		   
		   $deal_title=$_POST['deal_title'];
           $deal_detail=safe($_POST['deal_detail']);
		   $imageform=$_POST['deal_image'];
           $status_deal_new;
  
		   $insertSQL = "INSERT INTO deals (deal_title, deal_detail, deal_image, status_deal, deal_date, deal_last_date_posted, id_business, renov) values ('".$deal_title."', '".$deal_detail."' , '".$imageform."', '".$status_deal_new."', '".$fecha."', '".$fecha."', '".$_SESSION['id_business']."', '".$renov."')";
           		   
			// GetSQLValueString($negocio, "int")

		   mysql_select_db($database_admin_buy_local, $admin_buy_local);
		   $Result1 = mysql_query($insertSQL, $admin_buy_local) or die(mysql_error());
		  
		} else {
			$renov = 0;
		}
	   	
		$deal_detail=safe($_POST['deal_detail']);
		$updateSQL = sprintf("UPDATE deals SET deal_title=%s, deal_detail=%s, deal_image=%s, renov=%s  WHERE id_deals=%s",
				GetSQLValueString($_POST['deal_title'], "text"),
				GetSQLValueString($deal_detail, "text"),
				GetSQLValueString($_POST['deal_image'], "text"),
				GetSQLValueString($renov, "int"),
				GetSQLValueString($_POST['id_deals'], "int"));

		mysql_select_db($database_admin_buy_local, $admin_buy_local);
		$Result1 = mysql_query($updateSQL, $admin_buy_local) or die(mysql_error());

		$updateGoTo = "status.php";
		if (isset($_SERVER['QUERY_STRING'])) {
			$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
		header(sprintf("Location: %s", $updateGoTo));
	}

	$var_Recordset1 = "0";
	if (isset($_GET['recordID'])) {
		$var_Recordset1 = $_GET['recordID'];
	}

	$var_Recordset1 = "0";
	if (isset($_GET['recordID'])) {
		$var_Recordset1 = $_GET['recordID'];
	}
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$query_Recordset1 = sprintf("SELECT * FROM deals, deal_status WHERE deals.id_deals = %s and status_deal = id_status and deals.status_deal = deal_status.id_status ", GetSQLValueString($var_Recordset1, "int"));
	$Recordset1 = mysql_query($query_Recordset1, $admin_buy_local) or die(mysql_error());
	$row_Recordset1 = mysql_fetch_assoc($Recordset1);
	$totalRows_Recordset1 = mysql_num_rows($Recordset1);
	global $renov;
	$renov = $row_Recordset1['renov'];

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

	$activemssg = "Because this is an active deal, clicking the 'Submit' button below will renew this deal for next week's BuyLocalWeekly. If you want to end the deal with this week's BuyLocalWeekly just click 'Cancel' and it will expire as planned at the end of this week.";
	$inactivemssg = "Because this is an expired deal, clicking the 'Submit' button below will reactivate the deal at the begining of the coming week. You might choose to edit the deal before reposting. If you want the deal to remain inactive, click 'Cancel' below.";
	$pendingmssg = "";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
	<title>Buy Local Weekly - Manage Deals</title>
	<link href="_css/mngdeal.css" rel="stylesheet" type="text/css" />
	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Raleway' rel='stylesheet' type='text/css'>
	<!-- Ends META Tags -->
    <script>
		function canceldealupdate() {
			document.forms['form1'].action="status.php";
			document.forms['form1'].submit();
		}
		function deletedeal() {
			document.forms['form1'].action="deldeal.php?dlt=<?php echo $var_Recordset1?>";
			document.forms['form1'].submit();
		}
	</script>
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
			<?php echo 	$citysite; ?>
		</div>
		<!-- Ribbon & welcome message section -->
		<div class="ribbon">
   	    	<div class="ribbon-stitches-top">
       	    </div>
       		<div class="ribbon-stitches-left">
            </div>
   	        <strong class="ribbon-content">
       	    	<h1>MANAGE DEAL</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New business regstration section -->
		<div id="AddDealBox">
			<div id="DealForm">
				<?php  if (($renov)==0) { ?>
					<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<table width="539" border="0" cellspacing="8" cellpadding="0">
							<tr>
								<td width="67">
									<label for="BssnsName">
										<div align="right">Deal Title :</div>
									</label>
								</td>
								<td colspan="3">
									<div align="left">
										<input name="deal_title" value="<?php echo htmlentities($row_Recordset1['deal_title'], ENT_COMPAT, ''); ?>" type="text" id="BssnsName" size="41" maxlength="40" /></div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right">
										<label for="AboutUs">About Us :</label>
									</div>
								</td>
								<td colspan="3">
									<textarea name="deal_detail" cols="31" rows="2" id="AboutUs"><?php echo stripslashes(htmlentities($row_Recordset1['deal_detail'], ENT_COMPAT, '')); ?></textarea>
								</td>
							</tr>
							<tr>
								<td>&nbsp;</td>
								<td colspan="3"><img src="_deals/<?php echo $row_Recordset1['deal_image']?>" width="100" height="100" /><?php $dealimage = $row_Recordset1['deal_image'] ?></td>
							</tr>
							<tr>
								<td>
									<div align="right">
										<label for="PhotoBssn">Deal Image :</label>
									</div>
								</td>
								<td colspan="3">
									<div align="left">
										<input type="file" name="deal_image" id="deal_image" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
                                	<div align="right">Status:</div>
								</td>
								<td colspan="3">
									<div align="left"><span class="addstatus"><?php echo htmlentities($row_Recordset1['status'], ENT_COMPAT, ''); ?></span></div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right"><span class="RedNote">Note:</span></div>
								</td>
								<td colspan="3">
                                <?php if ($row_Recordset1['status'] == "Active") {
										echo $activemssg;
								} else if ($row_Recordset1['status'] == "Expired") {
										echo $inactivemssg;
								} else if ($row_Recordset1['status'] == "Pending") {
										echo $pendingmssg;
								}
								?>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right"></div>
								</td>
								<td colspan="3">
									<div align="left"></div>
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<div align="right">
										<input type="submit" name="NewBusiness" id="NewBusiness" value="Submit" />
									</div>
								</td>
								<?php if ($row_Recordset1['status'] == "Pending") { ?>
									<td width="69">
                                    	<div align="center">
											<input type="submit" name="Delete" id="Delete" value="Delete" onclick="deletedeal()" />
										</div>
									</td>
                              	<?php } ?>
								<td width="213">
									<div align="left">
										<input type="reset" name="CancelDeal" id="CancelDeal" value="Cancel" onclick="canceldealupdate()" />
									</div>
								</td>
							</tr>
						</table>
						<input type="hidden" name="id_status" value="<?php echo $row_Recordset1['id_status']; ?>">
						<input type="hidden" name="MM_update" value="form1">
						<input type="hidden" name="id_deals" value="<?php echo $row_Recordset1['id_deals']; ?>">
						<input type="hidden" name="deal_image" value="<?php echo $row_Recordset1['deal_image']; ?>" />                        
                    </form>
				<?php }?>
              
				<?php  if (($renov)==1) { ?>
					<form action="<?php echo $editFormAction; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
						<table width="539" border="0" cellspacing="8" cellpadding="0">
							<tr>
								<td width="183">
									<label for="BssnsName">
										<div align="right">Deal Title :</div>
									</label>
								</td>
								<td colspan="2">
									<div align="left"><input readonly="readonly" name="deal_title" value="<?php echo htmlentities($row_Recordset1['deal_title'], ENT_COMPAT, ''); ?>" type="text" id="BssnsName" size="41" maxlength="40" /></div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right">
										<label for="AboutUs">About Us :</label>
									</div>
								</td>
								<td colspan="2">
									<textarea readonly="readonly" name="deal_detail" cols="31" rows="2" id="AboutUs"><?php echo htmlentities($row_Recordset1['deal_detail'], ENT_COMPAT, ''); ?></textarea>
								</td>
							</tr>
							<tr>
								<td>
                                	<div align="right">
										<label for="PhotoBssn">Deal Image :</label>
									</div>
								</td>
								<td colspan="2">
									<div align="left">
										<img src="_deals/<?php echo $row_Recordset1['deal_image']?>" width="100" height="100" />
									</div>
								</td>
							</tr>
							<tr>
								<td>
                                	<div align="right">Status:</div>
								</td>
								<td colspan="2">
									<div align="left">
										<span class="addstatus">Deal ACTIVE and already modified</span>
									</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right">
										<span class="RedNote">Note:</span>
									</div>
								</td>
								<td colspan="2" width="120px;">
                                	<div align="justify">You've already modified this active deal. If you need to make further changes or updates on this deal, please, work on the pending version from the deals list.</div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right"></div>
								</td>
								<td colspan="2">
									<div align="left"></div>
								</td>
							</tr>
							<tr>
								<td>
									<div align="right"></div>
								</td>
								<td width="244">
									<div align="left">
										<input type="submit" name="CancelDeal" id="CancelDeal" value="Cancel" onclick="canceldealupdate()" />
									</div>
								</td>
							</tr>
						</table>
					</form>
				<?php } ?>
			</div>
		</div>
		<div id="TopMenu">
<div id="MenuLocation">
    	       	<ul>
					<li ID="MainMenuA"><a href="<?php echo "adddeal.php" ?>" >Add Buy Local Deal</a></li>
					<li ID="MainMenuA"><a href="<?php echo "status.php" ?>">View Active|Inactive Deals</a></li>
					<li ID="MainMenuA"><a href="<?php echo "mngbsnss.php" ?>">Modify Business Details</a></li>
                    <li ID="MainMenuA"><a href="closesession.php">Log Out</a></li>
				</ul>
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
	mysql_free_result($Recordset1);
	}else{
		echo '<script language="javascript">
		location.href = "./admin.php?sec=2";
		</script>
		'
		;
	}
?>