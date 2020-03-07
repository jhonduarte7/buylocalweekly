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

	$fechaactual = date("Y-m-d");
	$horaSistema = date("H:i:s");     

	$diaActual = date("m/d/y"); 
	$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));
	if ($WednesdayNext == $diaActual){
		$WednesdayNext = $diaActual;
	}else{
		$WednesdayNext = date("m/d/y",(strtotime("next wednesday")));
	}

	require("class.phpmailer.php");
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = "admin@buylocalweekly.com";
		$mail->Password = "]GUP&&cFxdw6";		
		$mail->From = "admin@buylocalweekly.com"; 
		$mail->FromName = "BuyLocalWeekly";
		$mail->WordWrap = 50; // set word wrap 
		$mail->IsHTML(true); // send as HTML 
		$mail->Subject = "Deals of the Week"; 
		
		mysql_select_db($database_admin_buy_local, $admin_buy_local);

		$primeraConsulta = "SELECT email FROM emails WHERE id_city = '1'";
		$respuesta = mysql_query($primeraConsulta, $admin_buy_local) or die(mysql_error());
			
		while($correos=mysql_fetch_array($respuesta)){
			$mail->AddAddress($correos['email']); 
			$segundaConsulta = "SELECT business.id_business, business_name, address1, address2, city, state, zip, phone, id_deals, deal_title, status_deal, deal_date FROM business, deals WHERE business.city = '$citysite' AND business.id_business_status = 2 AND business.id_business = deals.id_business AND deals.status_deal = 2 ORDER BY id_deals ASC";
		    $respuesta2 = mysql_query($segundaConsulta, $admin_buy_local) or die(mysql_error());
			
			$cuerpo="";
			$cuerpo.='<html>';
			$cuerpo.='<body>';
			$cuerpo.='<center>';
			$cuerpo.='<div>';
			$cuerpo.='<img src="http://www.buylocalweekly.com/youngtown/_images/sublogoemail.jpg" width="194" height="78" />';
			$cuerpo.='</div>';
			$cuerpo.='<div style="font:Verdana, Geneva, sans-serif; font-size:48px; color:#84BA22; text-align:center">'.$citysite.'</div>';
			$cuerpo.='<div style="font:Verdana, Geneva, sans-serif; font-size:16px">';
			$cuerpo.='<span style="color:#ED7C10; font-weight:bold">Remember: </span><span style="color:#111">These deals expire </span><span style="font-weight:bold">'.$WednesdayNext.'</span>';
			$cuerpo.='</div>';
			$cuerpo.='<div style="height:15px"></div>';
			$cuerpo.='<div style="background-color:#FFF; border:1px solid #5E9DC8; color:#111; text-align:center; text-align: justify; width: 700px; height: auto;">';
			while($f2=mysql_fetch_array($respuesta2)){
				$cuerpo.='<table width="695" border="0" cellspacing="5" cellpadding="0">';
				$cuerpo.='<tr>';
				$cuerpo.='<td colspan="4" style="border-bottom:1px solid #CCC"></td>';
				$cuerpo.='</tr>';
				$cuerpo.='<tr>';
				$cuerpo.='<td width="10" style="color:#111; font:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">&nbsp;</td>';
				$cuerpo.='<td width="285" style="color:#111; font:Verdana, Geneva, sans-serif; font-size:16px; font-weight:bold">'.$f2['business_name'].'</td>';
				$cuerpo.='<td width="5" rowspan="3" style="border:1px solid #CCC">&nbsp;</td>';
				$cuerpo.='<td width="285" style="color:#111; font:Verdana, Geneva, sans-serif; font-size:14px; font-weight:bold">'.$f2['deal_title'].'</td>';
				$cuerpo.='</tr>';
				$cuerpo.='<tr>';
				$cuerpo.='<td>&nbsp;</td>';
				$cuerpo.='<td style="color:#111; font:Verdana, Geneva, sans-serif; font-size:12px">'.$f2['address1'].' '.$f2['address2'].', '.$f2['city'].', '.$f2['state'].', '.$f2['zip'].'</td>';
				$cuerpo.='<td>&nbsp;</td>';
				$cuerpo.='</tr>';
				$cuerpo.='<tr>';
				$cuerpo.='<td>&nbsp;</td>';
				$cuerpo.='<td style="color:#111; font:Verdana, Geneva, sans-serif; font-size:12px">'.$f2['phone'].'</td>';
				$cuerpo.='<td>';
				$cuerpo.='<a href="http://www.buylocalweekly.com/youngtown/deal.php?recordID='.$f2['id_deals'].'">';
				$cuerpo.='<img src="http://www.buylocalweekly.com/youngtown/_images/dealdetailmail.png" width="119" height="29" />';
				$cuerpo.='</a>';
				$cuerpo.='</td>';
				$cuerpo.='</tr>';
				$cuerpo.='<tr>';
				$cuerpo.='<td colspan="4" style="border-bottom:1px solid #CCC"></td>';
				$cuerpo.='</tr>';
				$cuerpo.='</table>';
			;  
		}
			$cuerpo.='</div>';
			$cuerpo.='<div style="height:15px"></div>';
			$cuerpo.='<a href="http://www.buylocalweekly.com/youngtown/unsubscribe.php">';
			$cuerpo.='<span style="color:#0066CC; text-decoration:none">Unsubscribe from BuyLocalWeekly</span>';
			$cuerpo.='</a>';
			$cuerpo.='<div style="height:15px"></div>';
			$cuerpo.='<div style="font:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold">';
			$cuerpo.='<span style="color:#111">When you buy local, you build your community</span>';
			$cuerpo.='</div>';
			$cuerpo.='</center>';
			$cuerpo.='</body>';
			$cuerpo.='</html>';

		$mail->Body = "$cuerpo";
		$mail->Send();
		$mail->ClearAddresses();
	}
?>
                                                       
                                                        
                