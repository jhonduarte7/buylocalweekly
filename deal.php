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

   mysqli_select_db($admin_buy_local, $database_admin_buy_local);


	$recordID_recordID = "0";

	if (isset($_GET['recordID'])) {

		$recordID_recordID = $_GET['recordID'];

	}



	$query_recordID = "
	SELECT business.id_business, business_name, address1, address2, city, state, zip, phone, email, facebook, twitter, youtube, business_website, id_deals, deal_title, deal_detail, deal_image, status_deal, deal_date FROM business, deals WHERE business.id_business = deals.id_business and deals.id_deals = '".$recordID_recordID."' ";

	$recordID = mysqli_query($admin_buy_local, $query_recordID) or die(mysqli_error());

	$row_recordID = mysqli_fetch_assoc($recordID);

	$totalRows_recordID = mysqli_num_rows($recordID);

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

	<!-- Starts META Tags -->

	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

	<title>Buy Local Weekly - View Deal</title>

	<link href="_css/deal.css" rel="stylesheet" type="text/css" />

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

       	    	<h1>DEALS OF THE WEEK</h1>

			</strong>

            <div class="ribbon-stitches-bottom">

        	</div>

		</div>

		<!-- Date expiration reminder section -->

		<div id="DealBox">

			<div id="BssnProfileBox">

				<div id="DealBusinessProfile">

                	<a href="business.php?recordID=<?php echo $row_recordID['id_business']; ?>" style="text-decoration:none" target="_blank" ><?php echo $row_recordID['business_name']; ?></a>

				</div>

				<div id="DealAddressProfile">

					<?php

                    	if ($row_recordID['address2'] == NULL) {

							echo $row_recordID['address1'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];

						} else {

							echo $row_recordID['address1'].", ".$row_recordID['address2'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];

						} ?>

                </div>

				<div id="DealPhoneProfile"><?php echo $row_recordID['phone']; ?></div>

				<div id="DealWebsiteProfile">

                	<?php if ($row_recordID['business_website'] == NULL) { ?>

					<a href="#"></a>

                   	<?php } else { ?>

					<a href="<?php echo $row_recordID['business_website']; ?>" target="_blank"></a>

                    <?php } ?>  

                </div>

				<div id="DealemailProfile"><?php echo $row_recordID['email']; ?></div>

				<div id="DealSocialMedia">

		   			<table width="auto" border="0" cellspacing="0" cellpadding="4">

						<tr>

						   	<td>

								<?php if ($row_recordID['facebook'] == NULL) { ?>

								<a href="#"><img src="_images/facebook.png" width="32" height="32" /></a>

            	                <?php } else { ?>

								<a href="<?php echo $row_recordID['facebook']; ?>" target="_blank"><img src="_images/facebook.png" width="32" height="32" /></a>

                    	        <?php } ?>

                        	</td>

						   	<td>

								<?php if ($row_recordID['twitter'] == NULL) { ?>

								<a href="#"><img src="_images/twitter.png" width="32" height="32" /></a>

        	                    <?php } else { ?>

								<a href="<?php echo $row_recordID['twitter']; ?>" target="_blank"><img src="_images/twitter.png" width="32" height="32" /></a>

            	                <?php } ?>

                	        </td>

						   	<td>

								<?php if ($row_recordID['youtube'] == NULL) { ?>

								<a href="#"><img src="_images/youtube.png" width="32" height="32" /></a>

                            	<?php } else { ?>

								<a href="<?php echo $row_recordID['youtube']; ?>" target="_blank"><img src="_images/youtube.png" width="32" height="32" /></a>

	                            <?php } ?>

    	                    </td>

						</tr>

					</table>

				</div>

			</div>

			<!-- Individual deal box section -->

            <?php $WednesdayNext = date("m/d/y",(strtotime("next wednesday"))); ?>

			<div id="deallistbox">

				<div id="PrintDealTitle"><?php echo $row_recordID['deal_title']; ?></div>

				<div id="PrintDealDate">expires on <?php echo $WednesdayNext;?></div>

				<div id="DealBorders">

					<div id="PrintDealImage"><img src="_deals/<?php echo $row_recordID['deal_image']; ?>" width="165" height="165" /></div>

					<div id="PrintDealDetail"><?php echo stripslashes($row_recordID['deal_detail']); ?></div>

				</div>

			</div>

			<div id="PrintDeals">

				<a href="coupon.php?recordID=<?php echo $row_recordID['id_deals']; ?>_blank">Print This Deal</a>

			</div>

			<div id="ViewAllDeals">

				<a href="index.php">View All Deals</a>

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

	mysqli_free_result($recordID);

?>