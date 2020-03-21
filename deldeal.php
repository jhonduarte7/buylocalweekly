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



if ((isset($_GET['dlt'])) && ($_GET['dlt'] != "")) {

  $deleteSQL = sprintf("DELETE FROM deals WHERE id_deals=%s",

                       GetSQLValueString($_GET['dlt'], "int"));



  mysql_select_db($database_admin_buy_local, $admin_buy_local);

  $Result1 = mysql_query($deleteSQL, $admin_buy_local) or die(mysql_error());



  $deleteGoTo = "status.php";

  if (isset($_SERVER['QUERY_STRING'])) {

    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";

    $deleteGoTo .= $_SERVER['QUERY_STRING'];

  }

  header(sprintf("Location: %s", $deleteGoTo));

}

?>

