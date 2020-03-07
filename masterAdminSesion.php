<?php
	//initialize the session
	if (!isset($_SESSION)) {
		session_start();
	}
?>
<?php 
	session_start(); 
		if(isset($_SESSION['user_admin']) && (time() - $_SESSION['user_admin'] > 1800)) { 
?>
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

	$var_Recordset1 = "0";
	if (isset($_GET['recordID'])) {
		$var_Recordset1 = $_GET['recordID'];
	}
	mysql_select_db($database_admin_buy_local, $admin_buy_local);
	echo $query_Recordset1 = sprintf("SELECT * FROM business WHERE business.id_business = %s", GetSQLValueString($var_Recordset1, "int"));
	$Recordset1 = mysql_query($query_Recordset1, $admin_buy_local) or die(mysql_error());

	/*AQUI VA EL CODIGO PARA GUARDAR TODAS LAS VARIBLES EN SESION ANTES DE PASAR A LA PAGINA DEL ADMINISTRADOR*/
	if($row = mysql_fetch_array($Recordset1)){
		//primero capturo los datos del usuario y los guardo en variables de arreglo
		$id_business = $row['id_business'];
		$id_business_status = $row['id_business_status'];
		//variables de sesion para control de pantallas
		echo $_SESSION['id_business'] = $id_business;//IDENTIFICADOR UNICO DEL USUARIO
		echo $_SESSION['id_business_status'] = $id_business_status;//IDENTIFICADOR UNICO DEL USUARIO
		echo '<script language="javascript">
			location.href = "./mngbsnss.php";
			</script>
			'
			;	
	}
?>
<?php
	}else{
	    echo '<script language="javascript">
		location.href = "./master.php?sec=2";
		</script>
		'
		;	
	}
?>