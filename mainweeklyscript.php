<?php require_once('_connections/adm_blw.php'); ?>
<?php
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	$expirarActivas = "update deals set status_deal = 3, renov = 0 where status_deal = 2";
	$respuesta1 = mysql_query($expirarActivas, $admin_buy_local) or die(mysql_error());
	$activarPendientes = "update deals set status_deal = 2 where status_deal = 1";
	$respuesta1 = mysql_query($activarPendientes, $admin_buy_local) or die(mysql_error());
?>
<?php require ('invitation.php');  ?>