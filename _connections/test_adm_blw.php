<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_admin_buy_local = "localhost";
$database_admin_buy_local = "id12634020_buylocalweekly";
$username_admin_buy_local = "id12634020_blw";
$password_admin_buy_local = "Blw2020";
$admin_buy_local = mysql_pconnect($hostname_admin_buy_local, $username_admin_buy_local, $password_admin_buy_local) or trigger_error(mysql_error(),E_USER_ERROR);
?>