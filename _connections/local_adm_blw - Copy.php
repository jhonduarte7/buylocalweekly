<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_admin_buy_local = "localhost";
$database_admin_buy_local = "blwdb";
$username_admin_buy_local = "masterblw";
$password_admin_buy_local = "Blw2014";
$admin_buy_local = mysql_pconnect($hostname_admin_buy_local, $username_admin_buy_local, $password_admin_buy_local) or trigger_error(mysql_error(),E_USER_ERROR);
?>