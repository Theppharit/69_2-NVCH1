<?php

error_reporting(1);

date_default_timezone_set('asia/bangkok');

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'nvc';

$conn = mysqli_connect($host, $user, $pass, $dbname);

$conn -> set_charset("utf8");


?>