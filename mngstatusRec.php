<?php require_once('_connections/adm_blw.php'); ?>
<?php
	if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {

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
	
		//CODIGO PRINCIPAL DEL SCRIPT************************************************************************************************
		$totalCiclos=$_POST['ciclosTotal'];
		$i=1;
	
		for ($i=1; $i<=$totalCiclos; $i++){//FOR DE RECIBIMIENTO DE LAS VARIABLES DEL FORMULARIO
			$id_business[$i] = $_POST['id_business_'.$i.''];
			$id_business_status[$i] = $_POST['id_business_status_'.$i.''];
			$business[$i] = $_POST['business_'.$i.''];
			$id_mailbusiness[$i] = $_POST['email_'.$i.''];
			$initialstatus[$i] = $_POST['status_'.$i.''];
			switch ($id_business_status[$i]) {
				case 1:
					if (($id_business_status[$i] != $initialstatus[$i]) && ($id_business_status[$i] == 1)) { 
						$consulta= "UPDATE business SET id_business_status = '".$id_business_status[$i]."'  WHERE id_business= '".$id_business[$i]."'";
						mysql_select_db($database_admin_buy_local, $admin_buy_local);
						mysql_query($consulta, $admin_buy_local) or die(mysql_error());
					}
				break;
				case 2:
					if (($id_business_status[$i] != $initialstatus[$i]) && ($id_business_status[$i] == 2)) { 
						$consulta= "UPDATE business SET id_business_status = '".$id_business_status[$i]."',  date_actvated = '".date("M d, Y")."' WHERE id_business= '".$id_business[$i]."'";                   
						mysql_select_db($database_admin_buy_local, $admin_buy_local);
						mysql_query($consulta, $admin_buy_local) or die(mysql_error());

						$to = $id_mailbusiness[$i];
						$subject = "Business Approved";
						$message = "Congratulations,\n\nYour Business $business[$i] has been approved by the BuyLocalWeekly.com/$citysite Master Admin and has become active.\n\nYou can now log on the Admin Area and start including your weekly deals.\n\nBest Regards,\n\nThe BuyLocalWeekly Web Team";

						$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
						$headers .= "\r\nX-Mailer: PHP/".phpversion();

						mail($to,$subject,$message, $headers);
					}
				break;
				case 3:
					if (($id_business_status[$i] != $initialstatus[$i]) && ($id_business_status[$i] == 3)) { 
						$consulta= "UPDATE business SET id_business_status = '".$id_business_status[$i]."', date_deactivated = '".date("M d, Y")."' WHERE id_business= '".$id_business[$i]."'";                   
						mysql_select_db($database_admin_buy_local, $admin_buy_local);
						mysql_query($consulta, $admin_buy_local) or die(mysql_error());

						$to = $id_mailbusiness[$i];
						$subject = "Business Inactive";
						$message = "Attention,\n\nYour Business $business[$i] has been flagged as 'Inactive' by the BuyLocalWeekly.com/$citysite Master Admin.\n\nPlease, contact the Master Admin for more information.\n\nBest Regards,\n\nThe BuyLocalWeekly Web Team";

						$headers = "From: BuyLocalWeekly <info@buylocalweekly.com>";
						$headers .= "\r\nX-Mailer: PHP/".phpversion();

						mail($to,$subject,$message, $headers);
					}
				break;
				}
			}

		$updateGoTo = "mngstatus.php";
		if (isset($_SERVER['QUERY_STRING'])) {
			$updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
			$updateGoTo .= $_SERVER['QUERY_STRING'];
		}
	}
	header(sprintf("Location: %s", $updateGoTo));
?>