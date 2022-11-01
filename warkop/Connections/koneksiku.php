<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_koneksiku = "localhost";
$database_koneksiku = "warkop";
$username_koneksiku = "root";
$password_koneksiku = "";
$koneksiku = mysql_pconnect($hostname_koneksiku, $username_koneksiku, $password_koneksiku) or trigger_error(mysql_error(),E_USER_ERROR);
?>
