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



		/*************************************************///

		$editFormAction = $_SERVER['PHP_SELF'];

		if (isset($_SERVER['QUERY_STRING'])) {

			$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

		}



		if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "emailForm")) {

			$insertSQL = sprintf("INSERT INTO emails (email, id_city) VALUES (%s, %s)",

				GetSQLValueString($_POST['email'], "text"),

				GetSQLValueString($_POST['city'], "int"));



			mysqli_select_db($admin_buy_local, $database_admin_buy_local);

			$Result1 = mysqli_query($insertSQL, $admin_buy_local) or die(mysqli_error());

  

			$insertGoTo = "index.php";

			if (isset($_SERVER['QUERY_STRING'])) {

				$insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";

				$insertGoTo .= $_SERVER['QUERY_STRING'];

			}

			header(sprintf("Location: %s", $insertGoTo)); 

		}  



		//*********************************************////



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



		//*********************************************////



		$currentPage = $_SERVER["PHP_SELF"];



		$maxRows_generalList = 500;

		$pageNum_generalList = 0;

		if (isset($_GET['pageNum_generalList'])) {

			$pageNum_generalList = $_GET['pageNum_generalList'];

		}

		$startRow_generalList = $pageNum_generalList * $maxRows_generalList;



		mysqli_select_db($admin_buy_local, $database_admin_buy_local);

		$query_generalList = "SELECT business.id_business, business_name, address1, address2, city, state, zip, phone, id_deals, deal_title, status_deal, deal_date FROM business, deals WHERE business.city = '$citysite' AND business.id_business_status = 2 AND business.id_business = deals.id_business AND deals.status_deal = 2 ORDER BY id_deals ASC";

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

		$query_welcome = "SELECT master_admin.welcome FROM master_admin WHERE  master_admin.city_name = '$citysite'";

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

	<title>Welcome to Buy Local Weekly - Youngtown</title>

	<link href="_css/main.css" rel="stylesheet" type="text/css" />

	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>

	<!-- Ends META Tags -->

</head>

<body>

	<!-- Site's Top section -->

	<div id="TopBorder">

    </div>

	<!-- Site's external borders -->

	<div id="Wrapper">

		<div id="TopContainer">

	    	<div id="TopHangers">

    	    </div>

    		<div id="TopBox">

        		<div id="BssName">BUY LOCAL WEEKLY</div>

	        </div>

			<div id="TopMenu">

				<div id="MenuLocation">

            		<ul>

						<li ID="MainMenuD"><a href="admin.php">Business Admin</a></li>

						<li ID="MainMenuC"><a href="how.php">How It Works</a></li>

						<li ID="MainMenuB"><a href="search.php">List Businesses</a></li>

						<li ID="MainMenuA"><a href="#">Home</a></li>

					</ul>

				</div>

			</div>

			<!-- Site's logo & city name section -->

			<div ID="SiteLogo">

   	    		<img src="_images/logo.png" width="250" height="100" />

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

       	    		<h1><?php echo $row_welcome['welcome']; ?></h1>

				</strong>

    	        <div class="ribbon-stitches-bottom">

        		</div>

			</div>

			<!-- Email registration section -->

			<div ID="Newsletter">

				<div id="NewsTitle">To receive the BuyLocalWeekly in your mailbox each Thursday morning, enter your email address here:</div>

				<div id="NewsEmail">

					<form name="emailForm" action="<?php echo $editFormAction; ?>" method="post">

						<table width="720" border="0" cellpadding="8" cellspacing="5">

							<tr>

								<td width="500">

                                	<div align="right">

										<input placeholder="user@domain.com" name="email" type="email" id="email" size="50" maxlength="50" required title="Email" >

									</div>

                                </td>

								<td width="90"><input type="submit" name="submit" id="submit" value="Submit email"></td>

								<td width="130" class="Privacy"><a href="privacy.php" target="_blank">Privacy Policy</a></td>

							</tr>

						</table>

           				<input type="hidden" name="city" value="1" />

						<input type="hidden" name="MM_insert" value="emailForm">

					</form>

				</div>

        	</div>

			<!-- Date expiration reminder section -->

    	    <?php 

				$diaActual = date("m/d/y"); 

				$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));

				if ($WednesdayNext == $diaActual){

					$WednesdayNext = $diaActual;

				}else{

					$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));

				}

			?>

			<div id="Reminder"> <span class="RedNote">Remember:</span> These deals expire <?php echo $WednesdayNext;?></div>

		</div>

		<div id="BottomContainer">

			<div id="DealsMainBox">

				<!-- Individual deal box section -->

				<?php do { ?>

					<div id="MLDivSpace">

						<div id="deallistbox">

			    			<table width="720" border="0" cellspacing="0" cellpadding="2">

								<tr>

									<td width="90"><div align="center"><a href="map.php?recordID=<?php echo $row_generalList['id_business']; ?>" target="_blank"><img src="_images/mapidx.jpg" width="90" height="90" /></a></div></td>

									<td width="280">

										<div id="MLBnssProfile"><a href="business.php?recordID=<?php echo $row_generalList['id_business']; ?>" style="text-decoration:none" target="_blank" ><?php echo $row_generalList['business_name']; ?></a></div>

										<div id="MLAddressProfile"><?php

					                    	if ($row_generalList['address2'] == NULL) {

												echo $row_generalList['address1'].", ".$row_generalList['city'].", ".$row_generalList['state'].", ".$row_generalList['zip'];

											} else {

												echo $row_generalList['address1'].", ".$row_generalList['address2'].", ".$row_generalList['city'].", ".$row_generalList['state'].", ".$row_generalList['zip'];

											} ?>

										</div>

										<div id="MLPhoneProfile"><?php echo $row_generalList['phone']; ?></div>

									</td>           

									<td width="340">

										<div id="MLDivList"></div>

										<div id="MLDealProfile"><?php echo $row_generalList['deal_title']; ?></div>

										<div id="DealDetails">

                	                		<a href="deal.php?recordID=<?php echo $row_generalList['id_deals']; ?>" target="_blank" >View Details</a>

										</div>

									</td>

								</tr>

							</table>

						</div>

        	        </div>

					<?php } while ($row_generalList = mysqli_fetch_assoc($generalList)); ?>

					<div id="ButtonContainer">

						<div id="PrintDeals">

							<a href="deals.php" target="_blank">Print BuyLocalWeekly</a>

						</div>

					</div>

				</div>

			</div>

 		</div>

		<div id="BottomSpace"></div>

    </div>

	<!-- Site's bottom section -->

	<div id="BottomWrapper">

		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>

	</div>

</body>

</html>

<?php

mysqli_free_result($generalList);

mysqli_free_result($welcome);

?>