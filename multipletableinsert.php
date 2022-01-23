<?php
ob_start();
session_start();
/*
if(isset($_SESSION['winkelwagen']))
{
	$snacks = $_SESSION['winkelwagen'];
}
else
{
	$snacks = array();
}
*/


try
	{
		$pdo = new PDO("mysql:host=localhost;dbname=fastfood;","root","");
	}
	catch(PDOException $e)
	{
		echo $e->getMessage();
	}


	//fictieve winkelwagen aanmaken
	$snack = array(2,"Rundvleeskroket",2);
	$snack2 = array(6,"Saterol",1);
	$snack3 = array(9,"Big Mac",5);

	$snacks = array($snack,$snack2,$snack3);

	//bestelgegevens aanmaken
	$parameters = array(':Datum' => date("Y-m-d"),
						':Tijd' => date("H:i:s"),
						':GebruikersID' => $_SESSION['user_id']);

	$sth = $pdo->prepare('INSERT INTO bestellingen (Datum,Tijd,GebruikersID) VALUES (:Datum,:Tijd,:GebruikersID)');

	$sth->execute($parameters);

	//opvragen welk bestelID er is aangemaakt
	$BestelID = $pdo->lastInsertId();

	//hier wordt de koppeltabel gevuld met de snacks die we hebben besteld
	for($i=0;$i < count($snacks);$i++)
	{
		$parameters = array(':BestelID' => $BestelID,
						':SnackID' => $snacks[$i][0],
						':aantal' => $snacks[$i][2]);

		$sth = $pdo->prepare('INSERT INTO bestellingen_snacks (BestelID,SnackID,aantal) VALUES (:BestelID,:SnackID,:aantal)');

		$sth->execute($parameters);
	}




	$_SESSION['Winkelwagen'] = $snacks;
?>