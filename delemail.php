<?php require_once('_connections/adm_blw.php'); ?>
<?php
	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	}

	$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

	switch ($theType) {
		case "text":
			$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
		break;    
		case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
			break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
			break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
			break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
			break;
			}
		return $theValue;
		}
	}

	if ((isset($_GET['email'])) && ($_GET['email'] != "")) {
		mysql_select_db($database_admin_buy_local, $admin_buy_local);
		global $verdadero;
		$firstConsult = sprintf("SELECT email FROM `emails` WHERE `email` = %s ",GetSQLValueString($_GET['email'], "text"));
		$LoginRS = mysql_query($firstConsult, $admin_buy_local) or die(mysql_error());
		if($row = mysql_fetch_array($LoginRS)){
			$verdadero = $row['email'];
		}
		$deleteSQL = sprintf("DELETE FROM emails WHERE email=%s",
				GetSQLValueString($_GET['email'], "text"));   

		$Result1 = mysql_query($deleteSQL, $admin_buy_local) or die(mysql_error());
  
		if ($verdadero!=''){
			//echo "entro aqui en verdadero";
			header('Location:./unsubscribe.php?elm=1');
		}
		if ($verdadero == ''){
			//echo "entro aqui en falso";
			header('Location:./unsubscribe.php?elm=2');
		}
	}
?>
