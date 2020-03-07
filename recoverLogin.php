<?php
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

	$email = $_POST['email'];
	mysql_select_db($database_admin_buy_local, $admin_buy_local);

	$first = " select business_name, city, email, username, password  from  business where email = '".$email."' ";
	//echo $first;

	$second = mysql_query($first, $admin_buy_local);
	if($answer = mysql_fetch_array($second)) {
		$business_name = $answer['business_name'];
		$city = $answer['city'];
		$email = $answer['email'];
		$username = $answer['username'];
		$password = $answer['password'];
	}

	if (mysql_num_rows($second)==0){ 

		header('Location:./recover.php?sec=2');
	} else { 
		$to = "$email";
		$subject = "BuyLocalWeekly Login Details";
		$message = "Thank you for contacting BuyLocalWeekly.com/$citysite. Your login details have been retrieved from our systems:\n\nUsername: $username\n\nPassword: $password\n\nBest Regards,\nThe BuyLocalWeekly Web Team";
	
		$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
		$headers .= "\r\nX-Mailer: PHP/".phpversion();

		header('Location:./recover.php?sec=1');

	} 
?>

