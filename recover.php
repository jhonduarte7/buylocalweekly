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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Starts META Tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Buy Local Weekly - Recover Username/Password</title>
	<link href="_css/recover.css" rel="stylesheet" type="text/css" />
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
					<li ID="MainMenuB"><a href="search.php">List Businesses</a></li>
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
       	    	<h1>RECOVER LOGIN DETAILS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date expiration reminder section -->
		<div id="RecoverBox">
			<div id="errorcredentials">
				<?
					$sec = $_GET['sec'];
					if ($sec == "1") {
						echo ('Success! Your username and password have been sent via email.');
					}
				?>
			</div>
			<div id="errorunauthorized">
        	    <?
					if ($sec == "2") {
						echo ('Sorry! This email is not registered in our database. Try again.');
					}
				?>
            </div>
			<form id="loginform" name="loginform" method="post" action="recoverLogin.php">
				<table width="450" border="0" cellspacing="12" cellpadding="0">
					<tr>
						<td>
                        	<div align="right">
								<label for="emailaddress">Email :</label>
							</div>
						</td>
						<td>
                        	<div align="left">
								<input name="email" type="email" required="required" placeholder="user@domain.com" title="please insert your email" id="emailaddres" size="50" />
							</div>
						</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>
                        	<input type="submit" name="Enter" id="Enter" value="Send My Login Details" />
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
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>