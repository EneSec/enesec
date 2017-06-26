<?php

$servername = "localhost";
$username = "root";
$password = "cgdl17PT01.@";
$dbname = "enesecof";

$con = mysqli_connect($servername, $username, $password, $dbname) or die(mysql_error());
mysqli_select_db($con,$dbname) or die(mysql_error());
?>
