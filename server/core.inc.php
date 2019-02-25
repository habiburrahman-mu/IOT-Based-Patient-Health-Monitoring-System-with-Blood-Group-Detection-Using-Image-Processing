<?php
$host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database='medical';

$mysql_con = mysqli_connect($host, $mysql_username, $mysql_password, $mysql_database);

if (!$mysql_con) {
    die(mysqli_error($mysql_con));
}
else {
	
}