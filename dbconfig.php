<?php

$host = "mysql-abidgurbanov0.alwaysdata.net"; /* Host name */
$user = "283706"; /* User */
$password = "abid2004"; /* Password */
$dbname = "abidgurbanov0_5"; /* Database name */

$conn = mysqli_connect($host, $user, $password, $dbname);

/* Check connection */
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

