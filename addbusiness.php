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

		mysqli_select_db($admin_buy_local, $database_admin_buy_local);
		$query_cityName = sprintf("SELECT elegibility FROM master_admin WHERE city_name = '$citysite'"); 
		$cityName = mysqli_query($admin_buy_local, $query_cityName) or die(mysqli_error());
		$row_cityName = mysqli_fetch_assoc($cityName);
		$totalRows_cityName = mysqli_num_rows($cityName);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Add New Business</title>
	<link href="_css/addbusiness.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>ADD NEW BUSINESS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- New Business registration welcome message section -->
		<div id="BssnWelcome">
        	<p class="GeneralText">Residents want to support "Buy Local", you just need to give them a reason to do so.</p>
			<p class="GeneralText">In order to be eligible to enroll your business in the Buy Local Weekly program for your town or city, you must meet the eligibility criteria below.</p>
		</div>
		<!-- New Business eligibility message section -->
		<div id="BssnEligible">
        	<p class="EligibilityText"><?php echo $row_cityName['elegibility']; ?></p>
		</div>
		<!-- New Business registration steps message section -->
		<div id="BssnSteps">
			<div class="GeneralText">If you meet the above eligibility criteria, complete the form below and then click submit. Once your request is approved, you will receive an email notifying you that you can now log in and begin posting deals.</div>
		</div>
		<!-- New business regstration area section -->
		<div id="AddBssnBox">
			<!-- New business regstration form section -->
		<!-- 	<?
				$sec = $_GET['sec'];
				if ($sec == "1") {
					echo ('<span class="fail">Sorry! Your Business Profile has not been registered in BuyLocalWeekly. Please, ensure you have filled in the form correctly.</span>');
				} else if ($sec == "2") {
						echo ('<span class="fail">Sorry! Your password should contain more than 4 characters.</span>');
				} else if ($sec == "3") {
						echo ('<span class="fail">Sorry! Your passwords do not match.</span>');
				}
			?>  -->
			<div id="BssnForm">
				<form action="addbssn.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
					<table width="760" border="0" align="center" cellpadding="0" cellspacing="8">
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Business Name<span class="redasterisk">*</span>:</div>
							</td>
							<td colspan="3">
								<input name="business_name" type="text" value="" size="26" maxlength="25" />
							</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Address 1<span class="redasterisk">*</span>:</div>
							</td>
							<td><input name="address1" type="text" value="" size="26" maxlength="25" /></td>
							<td>Address 2:</td>
							<td><input name="address2" type="text" value="" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">City<span class="redasterisk">*</span>:</div>
							</td>
							<td>
								<div align="left">
									Youngtown
								</div>
							</td>
							<td>State<span class="redasterisk">*</span>:</td>
							<td>
								<div align="left">
									<select name="state" id="state">
										<option>Alabama</option>
										<option>Alaska</option>
										<option>Arizona</option>
										<option>Arkansas</option>
										<option>California</option>
										<option>Colorado</option>
										<option>Connecticut</option>
										<option>Delaware</option>
										<option>Florida</option>
										<option>Georgia</option>
										<option>Hawaii</option>
										<option>Idaho</option>
										<option>Illinois</option>
										<option>Indiana</option>
										<option>Iowa</option>
										<option>Kansas</option>
										<option>Kentucky</option>
										<option>Louisiana</option>
										<option>Maine</option>
										<option>Maryland</option>
										<option>Massachussetts</option>
										<option>Michigan</option>
										<option>Minessota</option>
										<option>Mississippi</option>
										<option>Misouri</option>
										<option>Montana</option>
										<option>Nebraska</option>
										<option>Nevada</option>
										<option>New Hamshire</option>
										<option>New Jersey</option>
										<option>New Mexico</option>
										<option>New York</option>
										<option>North Carolina</option>
										<option>North Dakota</option>
										<option>Ohio</option>
										<option>Oklahoma</option>
										<option>Oregon</option>
										<option>Pennsylvania</option>
										<option>Rhode Island</option>
										<option>South Carolina</option>
										<option>South Dakota</option>
										<option>Tennessee</option>
										<option>Texas</option>
										<option>Utah</option>
										<option>Vermont</option>
										<option>Virginia</option>
										<option>Washington</option>
										<option>West Virginia</option>
										<option>Wisconsin</option>
										<option>Wyoming</option>
									</select>
								</div>
							</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Zip<span class="redasterisk">*</span>:</div>
							</td>
							<td><input name="zip" type="text" value="" size="11" maxlength="10" /></td>
							<td>Phone:</td>
							<td><input name="phone" type="text" value="" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Email<span class="redasterisk">*</span>:</div>
							</td>
							<td colspan="3"><input placeholder="user@domain.com" name="email" type="email" value="" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Username<span class="redasterisk">*</span>:</div>
							</td>
							<td><input name="username" type="text" value="" size="26" maxlength="25" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Password<span class="redasterisk">*</span>:</div>
							</td>
							<td><input name="password" type="password" value="" size="26" maxlength="25" /><span class="psswrd"> min. 4 characters</span></td>
							<td>Re-Type Password<span class="redasterisk">*</span>:</td>
							<td><input name="verifypsswrd" type="password" value="" size="26" maxlength="25" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Logo:</div>
							</td>
							<td><input type="file" name="logo" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Facebook:</div>
							</td>
							<td colspan="3"><input placeholder="http://www.facebook.com/username" name="facebook" type="url" value="" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Twitter:</div>
							</td>
							<td colspan="3"><input placeholder="http://www.twitter.com/username" name="twitter" type="url" value="" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Youtube:</div>
							</td>
							<td colspan="3"><input placeholder="http://www.youtube.com/username" name="youtube" type="url" value="" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Business Website:</div>
							</td>
							<td colspan="3"><input placeholder="http://www.domain.com" name="business_website" type="url" value="" size="51" maxlength="50" /></td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">Photo:</div>
							</td>
							<td><input type="file" name="photo" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">
								<div align="right">About Us<span class="redasterisk">*</span>:</div>
							</td>
							<td><textarea name="about_us" type="text" value="" size="25" maxlength="250"></textarea></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr valign="baseline">
							<td nowrap="nowrap" align="right">&nbsp;</td>
							<td><input type="submit" value="Add My Business" /></td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
	   				<input type="hidden" name="city" value="Youngtown" />
					<input type="hidden" name="MM_insert" value="form1" />
				</form>
				<p>&nbsp;</p>
			</div>
		</div>
	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="#">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>