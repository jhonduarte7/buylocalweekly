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
	<title>Buy Local Weekly - Contact Us</title>
	<link href="_css/contact.css" rel="stylesheet" type="text/css" />
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
       	    	<h1>CONTACT US</h1>
			</strong>
            <div class="ribbon-stitches-bottom">
        	</div>
		</div>
		<!-- Contact box section -->
		<div id="ContactBox">
	       	<div id="AboutText">
	        	<p class="GeneralText">When contacting <span class="GeneralTextItalic">BuyLocalWeekly</span>, you have two options:</p>
                <p class="GeneralText">1. If you would like to contact the individuals that oversee the <span class="GeneralTextItalic">BuyLocalWeekly</span> program for <span class="GeneralTextUnderline">THIS</span> particular community, select 'THIS COMMUNITY' in the drop-down below.</p>
                <p class="GeneralText">2. If you would like to contact the <span class="GeneralTextItalic">BuyLocalWeekly</span> Corporate Office (to learn about how your community can have its own <span class="GeneralTextItalic">BuyLocalWeekly</span> program etc), please select 'CORPORATE OFFICE' in the drop-down below.</p>
            <!--    <?
					$sec = $_GET['sec'];
					if ($sec == "1") {
						echo ('<span class="success">Success! Your message has been sent to our BuyLocalWeekly Web Team. Please, allow 24-48 hours for a response.</span>');
					} else if ($sec == "2") {
						echo ('<span class="fail">Sorry! Your message has not been sent to our BuyLocalWeekly Web Team. Please, ensure you have filled in the form correctly.</span>');
					}
				?>  -->
				<div id="ContactSiteForm">
					<form action="cntmssg.php" method="post" enctype="multipart/form-data" name="formcontactsite" id="formcontactsite">
						<table width="700" border="0" cellspacing="8" cellpadding="0">
							<tr>
								<td width="185">
									<label for="ContactSiteName">
										<div align="right">Name<span class="redasterisk">*</span> :</div>
									</label>
								</td>
				                <td colspan="2">
									<div align="left"><input name="ContactSiteName" type="text" id="ContactSiteName" size="50" maxlength="50" /></div>
									<div align="right"></div>
									<div align="left"></div>
								</td>
							</tr>
							<tr>
								<td width="183">
									<label for="ContactSiteEmail">
										<div align="right">Email<span class="redasterisk">*</span> :</div>
									</label>
								</td>
				                <td colspan="2">
									<div align="left">
										<input placeholder="user@domain.com" name="ContactSiteEmail" type="email" id="ContactSiteEmail" size="50" maxlength="50" required title="Email" >
									</div>
									<div align="right"></div>
									<div align="left"></div>
								</td>
							</tr>
							<tr>
								<td width="183">
									<label for="ContactSiteTlf">
										<div align="right">Phone Number :</div>
									</label>
								</td>
				                <td colspan="2">
									<div align="left"><input name="ContactSiteTlf" type="text" id="ContactSiteTlf" size="41" maxlength="40" /></div>
									<div align="right"></div>
									<div align="left"></div>
								</td>
							</tr>
							<tr>
								<td width="183">
									<label for="ContactSiteAbout">
										<div align="right">About<span class="redasterisk">*</span> :</div>
									</label>
								</td>
				                <td colspan="2">
									<div align="left">
									<select name="ContactSiteAbout" id="ContactSiteAbout">
										<option>THIS COMMUNITY - Buy Local Weekly</option>
									    <option>CORPORATE OFFICE - Buy Local Weekly</option>
									</select>
									</div>
									<div align="right"></div>
									<div align="left"></div>
								</td>
							</tr>
                            <tr>
								<td>
									<div align="right">
										<label for="ContactSiteMssg">Message :</label>
									</div>
								</td>
	    		        	    <td colspan="2">
									<textarea name="ContactSiteMssg" cols="31" rows="2" id="ContactSiteMssg"></textarea>
									<div align="right"></div>
									<div align="left"></div>
								</td>
        	    		    </tr>
							<tr>
								<td width="183">
									<label for="ContactSiteVerify">
										<div align="right">8 + 3 :</div>
									</label>
								</td>
				                <td colspan="2">
									<div align="left"><input name="ContactSiteVerify" type="text" id="ContactSiteVerify" size="5" maxlength="4" /></div>
									<div align="right"></div>
									<div align="left"></div>
								</td>
							</tr>
							<tr>
	            			    <td>
                                	<div align="right"></div>
                    	        </td>
	            			    <td width="80">
                                	<div align="left">
	            			    		<input type="submit" name="SendContactSite" id="SendContactSite" value="Send Message" />
	            			    	</div>
	            			    </td>
							</tr>
						</table>
					</form>
				</div>
			</div>
		</div>
 	</div>
	<!-- Site's bottom section -->
	<div id="BottomWrapper">
		<a href="about.php">About BuyLocalWeekly</a>   |   <a href="#">Contact Us</a>   |   <a href="addbusiness.php">Add My Business</a>   |   <a href="admin.php">Business Admin</a>   |   <a href="master.php">Master Admin</a>
	</div>
</body>
</html>