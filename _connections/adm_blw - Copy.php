<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_admin_buy_local = "localhost";
$database_admin_buy_local = "luisdeba_buylocalweekly";
$username_admin_buy_local = "luisdeba_blwmstr";
$password_admin_buy_local = "CofCYtAz0109_BLW";
$admin_buy_local = mysql_pconnect($hostname_admin_buy_local, $username_admin_buy_local, $password_admin_buy_local) or trigger_error(mysql_error(),E_USER_ERROR);
?>