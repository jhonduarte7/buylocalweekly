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
	<title>Buy Local Weekly - Unsubscribe Email</title>
	<link href="_css/unsubscribe.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>UNSUBSCRIBE ME</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date expiration reminder section -->
		<div id="UnsubscribeBox">
			<form action="delemail.php" method="get">
				<table width="450" border="0" cellspacing="12" cellpadding="0">
					<caption class="unsubmail">Unsubscribe me from the Buy Local Weekly deals newsletter</caption>
					<tr>
						<td height="39" colspan="2">
							<div align="center">
                            	<div id="deleteconfirmed">                      
									<?
										$elm = $_GET['elm'];
										if ($elm == "1") {
											echo ('Your email has been successfully removed from BuyLocalWeekly');
										}
									?>
								</div>
								<div id="deletenotfound">
									<?
										if ($elm == "2") {
											echo ('Incorrect email. Email not found in our Database');
										}
									?>
								</div>
							</div>
						</td>
				    </tr>
					<tr>
						<td><div align="right"><label for="Username">Email :</label></div></td>
						<td><div align="left"><input name="email" type="email" id="email" size="50" maxlength="50" /></div></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input type="submit" name="submit" id="submit" value="Unsubscribe email" /></td>
					</tr>
				</table>
				<div align="center"></div>
			</form>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>