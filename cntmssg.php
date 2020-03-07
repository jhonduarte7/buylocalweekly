<?
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

	$name = $_POST['ContactSiteName'];
	$email = $_POST['ContactSiteEmail'];
	$tlf = $_POST['ContactSiteTlf'];
	$about = $_POST['ContactSiteAbout'];
	$mssg = $_POST['ContactSiteMssg'];
	$security = $_POST['ContactSiteVerify'];

	$to = "admin@buylocalweekly.com";
	$subject = "Contact Message";
	$message = "A visitor from BuyLocalWeekly.com/$citysite has submitted the following message:\n\nName: $name\n\nEmail: $email\n\nPhone Number: $tlf\n\nAbout: $about\n\nMessage: $mssg\n\nBest Regards,\nThe BuyLocalWeekly Web Team";
	
	$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
	$headers .= "\r\nX-Mailer: PHP/".phpversion();

	if (empty($name) || empty($email) || empty($about) || empty($mssg) || $security != "11") {
		header("Location:contact.php?sec=2");	
	} else {
		mail($to,$subject,$message, $headers);
		header("Location:contact.php?sec=1");	
	}
?>