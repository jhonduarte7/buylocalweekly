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
	<title>Buy Local Weekly - About Us</title>
	<link href="_css/about.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>ABOUT US</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- About Us section -->
		<div id="AboutBox">
	       	<div id="AboutText">
	        	<p class="GeneralText">Most will agree that when residents <span class="GeneralTextUnderline">buy local</span>, they <span class="GeneralTextUnderline">build local</span> and support the institutions that serve both them and their neighbors.</p>
				<p class="GeneralText">The problem is that while most communities promote the "Buy Local" notion, few provide a financial incentive to do so.  And while <span class="GeneralTextItalic">guilting</span> residents in to buying local might work some of the time, it rarely changes behavior permanently.  While heavy "Buy Local" promotions focus on helping residents feel the impact of their shopping decisions, the individual benefits of buying local are either indirect or longer-term (supporting quality of life municipal projects, supporting a more intimate/organic business community, etc) while the benefits of buying elsewhere are usually more direct and immediate (more convenient, less expensive, etc).</p>
				<p class="GeneralText">In our modern culture <span class="GeneralTextItalic">direct & immediate</span> benefits usually trump <span class="GeneralTextItalic">indirect & longer term</span> benefits and hold greater sway over residents' behavior than window clings, brochures, directories or billboards. We can bemoan that reality all we want and try to preach and guilt residents into changing shopping attitudes and behaviors or we can provide residents a more <span class="GeneralTextItalic">direct & immediate</span> benefit of buying local.</p>
				<p class="GeneralText"><span class="GeneralTextItalic">BuyLocalWeekly</span> gives municipalities and chambers of commerce a mechanism to create sustainable awareness of the local business community and provides a way to incentivize residents to give local businesses a try.  The program allows approved businesses to post a weekly deal that shows up on the <span class="GeneralTextItalic">BuyLocalWeekly</span> website and the next <span class="GeneralTextItalic">BuyLocalWeekly</span> email that goes out to residents.  The <span class="GeneralTextItalic">BuyLocalWeekly</span> also has a printable format that can sit at various drop points throughout the community until the next one comes out.</p>
				<p class="GeneralText">The municipality or chamber of commerce determines the eligibility criteria to participate in the program and any other requirements as to the level of discount a business must offer.  Businesses pay nothing to participate in the <span class="GeneralTextItalic">BuyLocalWeekly</span> program.  The municipality, the businesses and the residents all win!</p>
				<p class="GeneralText">Once the <span class="GeneralTextItalic">BuyLocalWeekly</span> program is in place, as a municipality or chamber of commerce screams "Buy Local!" from the roof tops, it now has a place to direct those residents that would legitimately like to give a local business a try but trip over their understandable self-interest (of convenience or cost-savings) on their way.  Residents click on the <span class="GeneralTextItalic">BuyLocalWeekly</span> link on the municipality's or chamber's website then either reviews the weekly deals or signs up for the <span class="GeneralTextItalic">BuyLocalWeekly</span> (never needing to go to the website again).</p>
				<p class="GeneralText"><span class="GeneralTextItalic">BuyLocalWeekly</span> is the missing piece to your community's Buy Local promotion efforts.</p>
				<p class="GeneralText">It's time to give residents a <span class="GeneralTextItalicBold">direct</span> and <span class="GeneralTextItalicBold">immediate</span> benefit for buying local.  And it's time to make it easy and convenient to do so!</p>
				<p class="GeneralText"><span class="GeneralTextItalic">BuyLocalWeekly</span> is a service of Expansion Dynamics International, LLC based in Arizona.</p>
			</div>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="#">About BuyLocalWeekly</a>   |   <a href="contact.php">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>