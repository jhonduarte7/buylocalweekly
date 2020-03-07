<?
	include ("./_connections/adm_blw.php"); 

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

	$all=0;
	$active=0;
	$inactive=0;

	$all = isset($_POST['all']);
	$active = isset($_POST['active']);
	$inactive = isset($_POST['inactive']);
	$infoblast = $_POST['infoblast'];

	mysql_select_db($database_admin_buy_local, $admin_buy_local);

	if($all==1) {
		$first = " SELECT `email` FROM `business` ";
		$second = mysql_query($first, $admin_buy_local);
		$cuerpo = "$infoblast"; 

		while($answer = mysql_fetch_array($second)) {		

			$name = $_POST['ContactSiteName'];
			$email = $_POST['ContactSiteEmail'];
			$mssg = $cuerpo;

			$to = $answer['email'];
			$subject = "Important Message from BuyLocalWeekly";
			$message = "The BuyLocalWeekly.com/$citysite Master Administrator has submitted the following message:\n\n$mssg\n\nBest Regards,\nThe BuyLocalWeekly Web Team";
	
			$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
			$headers .= "\r\nX-Mailer: PHP/".phpversion();

			mail($to,$subject,$message, $headers);
		}

		header('Location: mstrcity.php?sec=1');

	}
	
	if($active==1) {
		$first = " SELECT `email` FROM `business` WHERE `id_business_status` = 2 ";
		$second = mysql_query($first, $admin_buy_local);
		$cuerpo = "Dear user: $infoblast"; 
		while($answer = mysql_fetch_array($second)) {		
			$name = $_POST['ContactSiteName'];
			$email = $_POST['ContactSiteEmail'];
			$mssg = $cuerpo;

			$to = $answer['email'];
			$subject = "Important Message from BuyLocalWeekly";
			$message = "The BuyLocalWeekly.com/$citysite Master Administrator has submitted the following message:\n\n$mssg\n\nBest Regards,\nThe BuyLocalWeekly Web Team";
	
			$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
			$headers .= "\r\nX-Mailer: PHP/".phpversion();

			mail($to,$subject,$message, $headers);
		}

		header('Location: mstrcity.php?sec=2');
	}
	
	if($inactive==1){
	    $first = " SELECT `email` FROM `business` WHERE `id_business_status` = 3 ";
		$second = mysql_query($first, $admin_buy_local);
		$cuerpo = "Dear user: $infoblast"; 
		while($answer = mysql_fetch_array($second)) {		
			$name = $_POST['ContactSiteName'];
			$email = $_POST['ContactSiteEmail'];
			$mssg = $cuerpo;

			$to = $answer['email'];
			$subject = "Important Message from BuyLocalWeekly";
			$message = "The BuyLocalWeekly.com/$citysite Master Administrator has submitted the following message:\n\n$mssg\n\nBest Regards,\nThe BuyLocalWeekly Web Team";
	
			$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
			$headers .= "\r\nX-Mailer: PHP/".phpversion();

			mail($to,$subject,$message, $headers);
		}

		header('Location: mstrcity.php?sec=3');
	}
?>