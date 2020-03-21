<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_admin_buy_local = "localhost";
$database_admin_buy_local = "buyloca6_buylocalblast";
$username_admin_buy_local = "buyloca6_blbadm";
$password_admin_buy_local = "BLBhPctDAzjPC06";
$admin_buy_local = mysqli_connect($hostname_admin_buy_local, $username_admin_buy_local, $password_admin_buy_local) or trigger_error(mysql_error(),E_USER_ERROR);
?>