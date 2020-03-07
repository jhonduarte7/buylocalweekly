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
	<title>Buy Local Weekly - How It Works</title>
	<link href="_css/how.css" rel="stylesheet" type="text/css" />
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
					<li ID="MainMenuC"><a href="#">How It Works</a></li>
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
       	    	<h1>HOW IT WORKS</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Date expiration reminder section -->
		<div id="HowBox">
	       	<div id="AboutText">
	        	<p class="GeneralText">Its simple. Residents can view the weekly deals in their community in one of three ways:</p>
				<p class="GeneralText">. Visiting the community's <span class="GeneralTextItalic">BuyLocalWeekly</span> website</p>
				<p class="GeneralText">. Signing up for the <span class="GeneralTextItalic">BuyLocalWeekly</span> email</p>
				<p class="GeneralText">. Picking up the printed version of the <span class="GeneralTextItalic">BuyLocalWeekly</span> deal sheet at one of various drop points</p>
				<p class="GeneralText">How do the deals get there? Businesses that meet the criteria determined by the local municipality or chamber of commerce click the "Add My Business" link, review the eligibility criteria, then complete the short form. Once they're approved they can begin posting deals and steals.  Each Wednesday at midnight, the website is updated with the new weekly deals posted by businesses throughout the last week, and the <span class="GeneralTextItalic">BuyLocalWeekly</span> e-blast goes out the next morning to those residents that have signed up.</p>
			</div>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>