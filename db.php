<?php


/* Database connection settings */

$host = 'localhost';
// $user = 'phpmyadmin';
$user = 'root';
// $pass = '1234';
$pass = '';
$db = 'csv_upload';
$conn = new mysqli( $host, $user, $pass, $db ) or die($mysqli->error);


?>
