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
?>
<?php
	// *** Validate request to login to this site.
	//if (!isset($_SESSION)) {
	//	session_start();
	//}

	$loginFormAction = $_SERVER['PHP_SELF'];
	if (isset($_GET['accesscheck'])) {
		$_SESSION['PrevUrl'] = $_GET['accesscheck'];
	}

	if (isset($_POST['Username'])) {
		$loginUsername=$_POST['Username'];
		$password=$_POST['Password'];
		$MM_fldUserAuthorization = "";
		$MM_redirectLoginSuccess = "mngbsnss.php";
		$MM_redirectLoginFailed = "admin.php";
		$MM_redirecttoReferrer = false;
		mysqli_select_db($admin_buy_local, $database_admin_buy_local);
  
		$LoginRS__query=sprintf("SELECT id_business, username, password FROM business WHERE username=%s AND password=%s AND id_business_status = '2'",
			GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
		$LoginRS = mysqli_query($admin_buy_local, $LoginRS__query) or die(mysqli_error());
  
		if($row = mysqli_fetch_array($LoginRS)){
				$id_business = $row['id_business'];
				$id_business_status = $row['id_business_status'];

				$_SESSION['id_business'] = $id_business;
				$_SESSION['id_business_status'] = $id_business_status;
		}
  
		/*////////////////////////////////////////////////////////////////////*/
  
		$loginFoundUser = mysqli_num_rows($LoginRS);

		if($row_business = mysqli_fetch_array($LoginRS)){
			$business = $row_business['id_business'];
		}
		if ($loginFoundUser) {
			$loginStrGroup = "";
			if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
				//declare two session variables and assign them
				$_SESSION['MM_Username'] = $loginUsername;
				$_SESSION['MM_UserGroup'] = $loginStrGroup;	      
			if ((isset($_SESSION['PrevUrl']) && false) || ($id_business_status == 2))  {
				$MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
			}
			header("Location: " . $MM_redirectLoginSuccess);
		} else {
			header("Location: ". $MM_redirectLoginFailed . "?sec=1");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Admin Login Area</title>
	<link href="_css/admin.css" rel="stylesheet" type="text/css" />
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
					<li ID="MainMenuD"><a href="#">Business Admin</a></li>
					<li ID="MainMenuC"><a href="how.php">How It Works</a></li>
					<li ID="MainMenuB"><a href="search.php">List Businesses</a></li>
					<li ID="MainMenuA"><a href="index.php">Home</a></li>
				</ul>
			</div>
		</div>
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
       	    	<h1>ADMIN LOGIN AREA</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date admin loging section -->
		<div id="AdminBox">
			<div id="errorcredentials">
				<?
					$sec = $_GET['sec'];
					if ($sec == "1") {
						echo ('Sorry! Incorrect username and/or password.');
					}
				?>
			</div>
			<div id="errorunauthorized">
        	    <?
					if ($sec == "2") {
						echo ('You are not authorised to access this page. Please, validate your username and password.');
					}
				?>
            </div>
			<form id="loginform" name="loginform" method="POST" action="<?php echo $loginFormAction; ?>">
				<table width="450" border="0" cellspacing="8" cellpadding="0">
					<tr>
				        <td>
        		        	<div align="right">
								<label for="Username">Username :</label>
							</div>
						</td>
				        <td>
        		        	<div align="left">
								<input name="Username" type="text" id="Username" size="25" />
							</div>
						</td>
					</tr>
					<tr>
				        <td>
            	        	<div align="right">
								<label for="Password">Password :</label>
							</div>
						</td>
						<td>
        	            	<div align="left">
								<input name="Password" type="password" id="Password" size="25" />
							</div>
						</td>
					</tr>
					<tr>
				        <td>&nbsp;</td>
				        <td>
        	    	    	<input type="submit" name="Enter" id="Enter" value="Acess Admin Area" />
						</td>
					</tr>
					<tr>
				        <td>
            	        	<div align="right"></div>
						</td>
						<td>
                    		<div align="left">
	                        	<span class="RecoverID"><a href="recover.php">Forgot Username and/or Password</a></span>
							</div>
						</td>
					</tr>
				</table>
			    <div align="center"></div>
			</form>
			<div align="center"></div>
		</div>
	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="#">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>