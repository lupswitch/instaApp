<?php
session_start();
if (isset($_SESSION['cart']))
	$_SESSION['cart'] = NULL;
if (isset($_SESSION['loggued_on_user']))
	$_SESSION['loggued_on_user'] = "";
$HOST = "127.0.0.1";
$LOGIN = "root";
$PASSWD = "totitu";

$mysqli = mysqli_connect($HOST, $LOGIN, $PASSWD);
if (mysqli_query($mysqli, "drop database if exists myApp;") == FALSE)
	echo "KO0\n";
if (mysqli_query($mysqli, "create database if not exists myApp;") == FALSE)
	echo "KO\n";
if (mysqli_query($mysqli, "USE myApp;") == FALSE)
	echo "KO2\n";
if (mysqli_query($mysqli, "create table if not exists user (
	u_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	ig_id VARCHAR(255),
	ig_login VARCHAR(255)
);") == FALSE)
	echo "KO3<BR />";

if (mysqli_query($mysqli, "create table if not exists logs (
	l_id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	u_id INT,
	l_date INT DEFAULT 0,
	l_latitude INT DEFAULT 0,
	l_longitude INT DEFAULT 0
);") == FALSE)
	echo "KO4<BR />";

header('Location: index.php');

mysqli_close($mysqli);

?>
