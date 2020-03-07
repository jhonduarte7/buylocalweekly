<?php require_once('_connections/adm_blw.php'); ?>
<?php
	if (!function_exists("GetSQLValueString")) {
		function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
	if (PHP_VERSION < 6) {
		$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
	}

	$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($theValue) : mysqli_escape_string($theValue);

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

	$recordID_recordID = "0";
	if (isset($_GET['recordID'])) {
		$recordID_recordID = $_GET['recordID'];
	}
	mysqli_select_db($admin_buy_local, $database_admin_buy_local);
	$query_recordID = sprintf("SELECT id_business, address1, address2, city, state, zip FROM business WHERE id_business = '$recordID_recordID'");
	$recordID = mysqli_query($admin_buy_local, $query_recordID) or die(mysqli_error());
	$row_recordID = mysqli_fetch_assoc($recordID);
	$totalRows_recordID = mysqli_num_rows($recordID);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Buy Local Weekly - View Business on Map</title>
</head>

<body>
	<div align="center">
		<iframe width="800" height="600" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=<?php 
		if ($row_recordID['address2'] == NULL) {
			echo $row_recordID['address1'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];
		} else {
			echo $row_recordID['address1'].", ".$row_recordID['address2'].", ".$row_recordID['city'].", ".$row_recordID['state'].", ".$row_recordID['zip'];
		} ?>&key=AIzaSyAM6dS0-Pdd1Ttoy_9EBM0KFBB1ZwBbRUU"></iframe>
	</div>
</body>
</html>