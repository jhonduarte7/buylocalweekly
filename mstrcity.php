<?php
session_start();
require("./_connections/adm_blw.php");
if(isset($_SESSION['user_admin'])){

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

///////////////////////////////////////////////
	


	$editFormAction = $_SERVER['PHP_SELF'];

	if (isset($_SERVER['QUERY_STRING'])) {

		$editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);

	}



	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

		$updateSQL = sprintf("UPDATE master_admin SET user_admin=%s, password=%s, city_name=%s, logo=%s, welcome=%s, disclaimer=%s, admin_notice=%s, elegibility=%s WHERE id_city=%s",

		GetSQLValueString($_POST['user_admin'], "text"),

		GetSQLValueString($_POST['password'], "text"),

		GetSQLValueString($_POST['city_name'], "text"),

		GetSQLValueString($_POST['logo'], "text"),

		GetSQLValueString($_POST['welcome'], "text"),

		GetSQLValueString($_POST['disclaimer'], "text"),

		GetSQLValueString($_POST['admin_notice'], "text"),

		GetSQLValueString($_POST['elegibility'], "text"),

		GetSQLValueString($_POST['id_city'], "int"));



		mysql_select_db($database_admin_buy_local, $admin_buy_local);

		$Result1 = mysql_query($updateSQL, $admin_buy_local) or die(mysql_error());

	}



	$sec = $_SESSION['id_city'];

	mysqli_select_db($admin_buy_local, $database_admin_buy_local);

	$query_RecordsetCity = "SELECT * FROM master_admin WHERE master_admin.id_city = '$sec'";

	$RecordsetCity = mysqli_query($admin_buy_local, $query_RecordsetCity) or die(mysqli_error());

	$row_RecordsetCity = mysqli_fetch_assoc($RecordsetCity);

	$totalRows_RecordsetCity = mysqli_num_rows($RecordsetCity);

?>

<!DOCTYPE html>


<head>

	<!-- Starts META Tags -->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>Buy Local Weekly - Master City Area</title>

	<link href="_css/mstrcity.css" rel="stylesheet" type="text/css" />

	<link href='http://fonts.googleapis.com/css?family=Oswald|Six+Caps|Fjalla+One|Roboto+Condensed' rel='stylesheet' type='text/css'>

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

   		   	<? echo $location['name'] ?>

		</div>

		<!-- Ribbon & welcome message section -->

		<div class="ribbon">

   	    	<div class="ribbon-stitches-top">

       	    </div>

       		<div class="ribbon-stitches-left">

            </div>

   	        <strong class="ribbon-content">

       	    	<h1>MASTER CITY ADMIN</h1>

			</strong>

            <div class="ribbon-stitches-bottom">

        	</div>

		</div>

		<!-- New business regstration section -->

		<div id="AddBssnBox">

			<div id="BssnForm">

              <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">

					<table width="765" border="0" cellspacing="8" cellpadding="0">

						<tr valign="baseline">

							<td width="259" align="right" nowrap="nowrap">Username:</td>

							<td colspan="2"><input name="user_admin" type="text" value="<?php echo htmlentities($row_RecordsetCity['user_admin'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">Password:</td>

							<td colspan="2"><input name="password" type="password" value="<?php echo htmlentities($row_RecordsetCity['password'], ENT_COMPAT, 'utf-8'); ?>" size="26" maxlength="25" /></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">City Name:</td>

							<td colspan="2"><?php echo $row_RecordsetCity['city_name']?><input type="hidden" name="city_name" value="<?php echo $row_RecordsetCity['city_name']; ?>" /></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">&nbsp;</td>

							<td colspan="2"><img src="<?php echo "_cities/".$row_RecordsetCity['logo']; ?>" width="150" height="150" border="0" />

							</td>

						</tr>

						<tr>

							<td>

                            	<div align="right">

                            	  <label for="CityLogo">Logo:</label></div>

							</td>

							<td colspan="2">

                            	<div align="left">

									<input type="file" name="citylogo" id="citylogo" />

								</div>

							</td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">Welcome Text:</td>

							<td colspan="2"><textarea name="welcome" cols="45" rows="5"><?php echo htmlentities($row_RecordsetCity['welcome'], ENT_COMPAT, 'utf-8'); ?></textarea></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">Disclaimer Text:</td>

							<td colspan="2"><textarea name="disclaimer" cols="45" rows="5"><?php echo htmlentities($row_RecordsetCity['disclaimer'], ENT_COMPAT, 'utf-8'); ?></textarea></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">Administrative Notice Text:</td>

							<td colspan="2"><textarea name="admin_notice" cols="45" rows="5"><?php echo htmlentities($row_RecordsetCity['admin_notice'], ENT_COMPAT, 'utf-8'); ?></textarea></td>

					  </tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">Elegibility Text:</td>

							<td colspan="2"><textarea type="text" name="elegibility" cols="45" rows="5"><?php echo htmlentities($row_RecordsetCity['elegibility'], ENT_COMPAT, 'utf-8'); ?></textarea></td>

						</tr>

						<tr valign="baseline">

							<td nowrap="nowrap" align="right">&nbsp;</td>

							<td width="201"><input type="submit" value="Update / Save Changes" /></td>

							<td width="273"><input type="button" name="cancel" id="cancel" value="Cancel" /></td>

						</tr>

					</table>

					<input type="hidden" name="MM_update" value="form1" />

					<input type="hidden" name="id_city" value="<?php echo $row_RecordsetCity['id_city']; ?>" />

                    <input type="hidden" name="logo" value="<?php echo $row_RecordsetCity['logo']; ?>" />

			  </form>

            </div>

			<div id="ViewBusiness">

				<a href="mngstatus.php">View Businesses</a>

			</div>

			<div id="BlastForm">

				<form id="form2" name="form2" method="post" action="infoblstall.php">

					<table width="765" border="0" cellspacing="8" cellpadding="0">

						<tr valign="baseline">

							<td colspan="4" align="right" nowrap="nowrap">

                            	<div align="center">

                          			<div id="infoblstmssg">

		                    			<?

											$sec = $_GET['sec'];

											if ($sec == "1") {

												echo ('Your message to ALL Businesses has been sent.');

											} else if ($sec == "2") {

												echo ('Your message to ACTIVE Businesses has been sent.');

											} else if ($sec == "3") {

												echo ('Your message to INACTIVE Businesses has been sent.');

											}

										?>

									</div>

								</div>

							</td>

						</tr>

						<tr valign="baseline">

							<td width="259" align="right" nowrap="nowrap">Infoblast to Businesses:</td>

							<td colspan="3"><label for="infoblast"></label>

							<textarea name="infoblast" id="infoblast" cols="45" rows="5"></textarea></td>

						</tr>

						<tr>

							<td>&nbsp;</td>

							<td width="92"><input type="submit" name="all" id="all" value="Send to All" /></td>

							<td width="113"><input type="submit" name="active" id="active" value="Send to Active"  /></td>

							<td width="261"><input type="submit" name="inactive" id="inactive" value="Send to Inactive"  /></td>

						</tr>

					</table>

				</form>

        	</div>

			<div id="logmeout">

	            <span class="getmeout">

                	<a href="closesession.php">Log out</a>

				</span>

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

mysql_free_result($RecordsetCity);

    }else{

	    echo '<script language="javascript">

		location.href = "./master.php?sec=2";

		</script>

		'

		;	

	}

?>