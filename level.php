<?php
ob_start();
session_start();

if($_SESSION['level'] >= 5)
{


	echo "toegang verleend";
	//code

















}
else
{
	echo "verboden toegang";
	header('refresh:5;url=15nov2022.php');
}

?>